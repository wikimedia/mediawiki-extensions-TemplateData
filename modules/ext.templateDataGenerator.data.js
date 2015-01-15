( function ( $ ) {
	/**
	 * TemplateData Dialog
	 * @param {Object} config Dialog configuration object
	 */
	TemplateDataModel = function TemplateDataModel( config ) {
		config = config || {};

		// Mixin constructors
		OO.EventEmitter.call( this );

		// Config
		this.setParentPage( config.parentPage );
		this.setPageSubLevel( config.isPageSubLevel );

		// Properties
		this.params = {};
		this.description = {};
		this.paramOrder = [];
		this.paramIdentifierCounter = 0;
		this.setPageSubLevel( !!config.isPageSubLevel );
		this.setFullPageName( config.fullPageName || '' );

		this.originalTemplateDataObject = null;
		this.sourceCodeParameters = [];
		this.templateSourceCodePromise = null;
	};

	/* Setup */
	OO.initClass( TemplateDataModel );
	OO.mixinClass( TemplateDataModel, OO.EventEmitter );

	/* Events */

	/**
	 * @event add-param
	 * @param {string} key Parameter key
	 * @param {Object} data Parameter data
	 */

	/**
	 * @event change-description
	 * @param {string} description New template description
	 * @param {Object} [language] Description language, if supplied
	 */

	/**
	 * @event change-paramOrder
	 * @param {string[]} orderArray Parameter key array in order
	 */

	/**
	 * @event change-property
	 * @param {string} paramKey Parameter key
	 * @param {string} prop Property name
	 * @param {Mixed...} value Property value
	 */

	/* Static Methods */

	/**
	 * Get information from the mediaWiki API
	 * @param {string} page Page name
	 * @return {jQuery.Promise} API promise
	 */
	TemplateDataModel.static.getApi = function ( page ) {
		var api = new mediaWiki.Api();
		return api.get( {
			action: 'query',
			prop: 'revisions',
			rvprop: 'content',
			indexpageids: '1',
			titles: page
		} );
	};

	/**
	 * Compare two objects or strings
	 * @param {Object|string} obj1 Base object
	 * @param {Object|string} obj2 Compared object
	 * @param {boolean} [allowSubset] Allow the second object to be a
	 *  partial object (or a subset) of the first.
	 * @return {boolean} Objects have equal values
	 */
	TemplateDataModel.static.compare = function ( obj1, obj2, allowSubset ) {
		if ( allowSubset && obj2 === undefined ) {
			return true;
		}

		// Make sure the objects are of the same type
		if ( $.type( obj1 ) !== $.type( obj2 ) ) {
			return false;
		}

		// Comparing objects or arrays
		if ( typeof obj1 === 'object' ) {
			return OO.compare( obj2, obj1, allowSubset );
		}

		// Everything else (primitive types, functions, etc)
		return obj1 === obj2;
	};

	/**
	 * Translate obsolete parameter types into the new types
	 * @param {string} paramType Given type
	 * @return {string} Normalized non-obsolete type
	 */
	TemplateDataModel.static.translateObsoleteParamTypes = function ( paramType ) {
		switch ( paramType ) {
			case 'string/wiki-page-name':
				return 'wiki-page-name';
			case 'string/wiki-file-name':
				return 'wiki-file-name';
			case 'string/wiki-user-name':
				return 'wiki-user-name';
			default:
				return paramType;
		}
	};

	/**
	 * Retrieve information about all legal properties for a parameter.
	 * @param {boolean} getFullData Retrieve full information about each
	 *  parameter. If false, the method will return an array of property
	 *  names only.
	 * @return {Object|string[]} Legal property names with or without their
	 *  definition data
	 */
	TemplateDataModel.static.getAllProperties = function ( getFullData ) {
		var properties = {
			name: {
				type: 'string',
				// Validation regex
				restrict: /[\|=]|}}/
			},
			aliases: {
				type: 'array',
				delimiter: mw.msg( 'comma-separator' )
			},
			label: {
				type: 'string',
				allowLanguages: true
			},
			description: {
				type: 'string',
				allowLanguages: true
			},
			type: {
				type: 'select',
				children: [
					'boolean',
					'content',
					'wiki-file-name',
					'line',
					'number',
					'date',
					'wiki-page-name',
					'string',
					'unbalanced-wikitext',
					'undefined',
					'wiki-user-name'
				],
				'default': 'undefined'
			},
			'default': {
				type: 'string',
				multiline: true
			},
			autovalue: {
				type: 'string'
			},
			required: {
				type: 'boolean'
			},
			suggested: {
				type: 'boolean'
			}
		};

		if ( !getFullData ) {
			return Object.keys( properties );
		} else {
			return properties;
		}
	};

	/**
	 * Retrieve the list of property names that allow for multiple languages.
	 * @return {string[]} Property names
	 */
	TemplateDataModel.static.getPropertiesWithLanguage = function () {
		var prop,
			result = [],
			propDefinitions = this.getAllProperties( true );

		for ( prop in propDefinitions ) {
			if ( propDefinitions[prop].allowLanguages ) {
				result.push( prop );
			}
		}
		return result;
	};

	/**
	 * Split a string into an array and clean/trim the values
	 * @param {string} str String to split
	 * @param {string} [delim] Delimeter
	 * @return {string[]} Clean array
	 */
	TemplateDataModel.static.splitAndTrimArray = function ( str, delim ) {
		var arr = [];
			delim = delim || mw.msg( 'comma-separator' );

		$.each( str.split( delim ), function () {
			var trimmed = $.trim( this );
			if ( trimmed ) {
				arr.push( trimmed );
			}
		} );

		return arr;
	};

	/**
	 * This is an adjustment of OO.simpleArrayUnion that ignores
	 * empty values when inserting into the unified array.
	 * @param {Array...} arrays Arrays to union
	 * @return {Array} Union of the arrays
	 */
	TemplateDataModel.static.arrayUnionWithoutEmpty = function () {
		var result = OO.simpleArrayUnion.apply( this, arguments );

		// Trim and filter empty strings
		return result.filter( function ( i ) {
			return $.trim( i );
		} );
	};

	/* Methods */

	/**
	 * Load the model from the template data string. If no templatedata tags
	 * are available, the model will be initialized empty.
	 *
	 * After loading the model itself, fetch the parameter list from the template
	 * source code and update existing parameters in the model.
	 *
	 * @param {string} templateDataString Current page wikitext
	 */
	TemplateDataModel.prototype.loadModel = function ( tdString ) {
		var original = {},
			deferred = $.Deferred();

		// Store existing templatedata into the model
		this.setOriginalTemplateDataObject( this.getModelFromString( tdString ) );
		original = this.getOriginalTemplateDataObject();

		// Initialize model
		this.params = {};

		if ( original ) {
			// Get parameter list from the template source code
			this.getParametersFromTemplateSource( tdString ).done( $.proxy( function ( params ) {
				this.sourceCodeParameters = params;
				this.setTemplateDescription( original.description );
				this.setTemplateParamOrder( original.paramOrder );

				// Mark existing parameters in the model
				if ( original.params ) {
					for ( var param in original.params ) {
						this.addParam( param, original.params[param] );
					}
				}
				deferred.resolve();
			}, this ) );
		} else {
			// Bad syntax for JSON
			deferred.reject();
		}
		return deferred.promise();
	};

	/**
	 * Go over the importable parameters and check if they are
	 * included in the parameter model. Return the parameter names
	 * that are not included yet.
	 * @return {string[]} Parameters that are not yet included in
	 *  the model
	 */
	TemplateDataModel.prototype.getMissingParams = function () {
		var i,
			result = [],
			allParamNames = this.getAllParamNames();

		// Check source code params
		for ( i = 0; i < this.sourceCodeParameters.length; i++ ) {
			if ( $.inArray( this.sourceCodeParameters[i], allParamNames ) === -1 ) {
				result.push( this.sourceCodeParameters[i] );
			}
		}
		return result;
	};

	/**
	 * Add imported parameters into the model
	 * @return {Object} Parameters added. -1 for failure.
	 */
	TemplateDataModel.prototype.importSourceCodeParameters = function () {
		var i, paramKey,
			allParamNames = this.getAllParamNames(),
			existingArray = [],
			importedArray = [],
			skippedArray = [];

		// Check existing params
		for ( i = 0; i < allParamNames.length; i++ ) {
			paramKey = allParamNames[i];
			if ( $.inArray( paramKey, this.sourceCodeParameters ) !== -1 ) {
				existingArray.push( paramKey );
			}
		}

		// Add sourceCodeParameters to the model
		for ( i = 0; i < this.sourceCodeParameters.length; i++ ) {
			if (
				$.inArray( this.sourceCodeParameters[i], existingArray ) === -1 &&
				this.addParam( this.sourceCodeParameters[i] )
			) {
				importedArray.push( this.sourceCodeParameters[i]);
			} else {
				skippedArray.push( this.sourceCodeParameters[i]);
			}
		}

		return {
			imported: importedArray,
			skipped: skippedArray,
			existing: existingArray
		};
	};

	/**
	 * Look for a templatedata json string and convert it into
	 * the and object, if it exists.
	 * @param {string} templateDataString Wikitext templatedata string
	 * @return {Object|null} The parsed json string. Empty if no
	 * templatedata string was found. Null if the json string
	 * failed to parse.
	 */
	TemplateDataModel.prototype.getModelFromString = function ( templateDataString ) {
		var parts;

		parts = templateDataString.match(
			/<templatedata>([\s\S]*?)<\/templatedata>/i
		);

		// Check if <templatedata> exists
		if ( parts && parts[1] && $.trim( parts[1] ).length > 0 ) {
			// Parse the json string
			try {
				return $.parseJSON( $.trim( parts[1] ) );
			} catch ( err ) {
				return null;
			}
		} else {
			// Return empty model
			return { params: {} };
		}
	};

	/**
	 * Retrieve all existing language codes in the current templatedata model
	 * @return {string[]} Language codes in use
	 */
	TemplateDataModel.prototype.getExistingLanguageCodes = function () {
		var param, prop, lang,
			result = [],
			languageProps = this.constructor.static.getPropertiesWithLanguage();

		// Take languages from the template description
		if ( $.isPlainObject( this.description ) ) {
			result.concat( Object.keys( this.description ) );
		}

		// Go over description
		if ( $.type( this.description ) ) {
			for ( lang in this.description ) {
				result.push( lang );
			}
		}

		// Go over the parameters
		for ( param in this.params ) {
			// Go over the properties
			for ( prop in this.params[param] ) {
				if ( $.inArray( prop, languageProps ) !== -1 ) {
					result = this.constructor.static.arrayUnionWithoutEmpty( result, Object.keys( this.params[param][prop] ) );
				}
			}
		}

		return result;
	};

	/**
	 * Retrieve parameters from the template code from source in this order:
	 *
	 * 1. Check if there's a template in the given 'wikitext' parameter. If not,
	 * 2. Check if there's a template in the current page. If not,
	 * 3. Check if the page is a subpage and go up a level to check for template code. If none found,
	 * 4. Repeat until we are in the root of the template
	 * 5. Save the name of the page where the template is taken from
	 *
	 * Cache the templateCodePromise so we don't have to do this all over again on each
	 * template code request.
	 *
	 * @param {string} [wikitext] Optional. Source of the template.
	 * @returns {jQuery.Promise} Promise resolving into template parameter array
	 */
	TemplateDataModel.prototype.getParametersFromTemplateSource = function ( templateDataString ) {
		var params = [];

		if ( !this.templateSourceCodePromise ) {
			// Check given page text first
			if ( templateDataString ) {
				params = this.extractParametersFromTemplateCode( templateDataString );
			}

			if ( params.length > 0 ) {
				// Cache list of parameters found in template source
				this.sourceCodeParameters = params;
				// There are parameters found; Resolve.
				this.templateSourceCodePromise = $.Deferred().resolve( params );
			} else {
				// Try to find the template code
				this.templateSourceCodePromise = $.Deferred();
				if ( this.isPageSubLevel() && this.getParentPage() ) {
					// Get the content of the parent
					this.constructor.static.getApi( this.getParentPage() )
						.done( $.proxy( function ( resp ) {
							var pageContent = '';

							// Verify that we have a sane response from the API.
							// This is particularly important for unit tests, since the
							// requested page from the API is the Qunit module and has no content
							if (
								resp.query.pages[resp.query.pageids[0]].revisions &&
								resp.query.pages[resp.query.pageids[0]].revisions[0]
							) {
								pageContent = resp.query.pages[resp.query.pageids[0]].revisions[0]['*'];
								// Get the parameters from the code
								this.sourceCodeParameters = this.extractParametersFromTemplateCode( pageContent );
							}
							this.templateSourceCodePromise.resolve( this.sourceCodeParameters );
						}, this ) )
						.fail( $.proxy( function () {
							// Resolve an empty parameters array
							return this.templateSourceCodePromise.resolve( [] );
						}, this ) );
				} else {
					// No template found. Resolve to empty array of parameters
					this.templateSourceCodePromise.resolve( [] );
				}
			}
		}

		return this.templateSourceCodePromise;
	};

	/**
	 * Retrieve template parameters from the template code.
	 *
	 * Adapted from https://he.wikipedia.org/wiki/MediaWiki:Gadget-TemplateParamWizard.js
	 *
	 * @param {string} templateSource Source of the template.
	 * @returns {jQuery.Promise} A promise that resolves into an
	 *  array of parameters that appear in the template code
	 */
	TemplateDataModel.prototype.extractParametersFromTemplateCode = function ( templateCode ) {
		var matches,
		paramNames = [],
		paramExtractor = /{{3,}(.*?)[<|}]/mg;

		while ( ( matches = paramExtractor.exec( templateCode ) ) !== null ) {
			if ( $.inArray( matches[1], paramNames ) === -1 ) {
				paramNames.push( $.trim( matches[1] ) );
			}
		}

		return paramNames;
	};

	/**
	 * Add parameter to the model
	 * @param {string} key Parameter key
	 * @param {Object} [data] Parameter data
	 * @return {boolean} Parameter was added successfully
	 */
	TemplateDataModel.prototype.addParam = function ( key, paramData ) {
		var prop, name, lang,
			existingNames = this.getAllParamNames(),
			data = $.extend( true, {}, paramData ),
			language = this.getDefaultLanguage(),
			propertiesWithLanguage = this.constructor.static.getPropertiesWithLanguage();

		name = key;
		// Check that the parameter is not already in the model
		if ( this.params[key] || $.inArray( key, existingNames ) !== -1 ) {
			// Change parameter key
			key = this.getNewValidParameterKey( key );
		}

		// Initialize
		this.params[key] = {};

		// Store the key
		this.params[key].name = name;

		// Mark the parameter if it is in the template source
		if ( $.inArray( key, this.sourceCodeParameters ) !== -1 ) {
			this.params[key].inSource = true;
		}

		// Translate types
		if ( this.params[key].type !== undefined ) {
			this.params[key].normalizedType = this.constructor.static.translateObsoleteParamTypes( this.params[key].type );
		}

		// Go over the rest of the data
		if ( data ) {
			for ( prop in data ) {
				if (
					$.inArray( prop, propertiesWithLanguage ) !== -1 &&
					$.isPlainObject( data[prop] )
				) {
					// Add all language properties
					for ( lang in data[prop] ) {
						this.setParamProperty( key, prop, data[prop], lang );
					}
				} else {
					this.setParamProperty( key, prop, data[prop], language );
				}
			}
		}

		// Trigger the add parameter event
		this.emit( 'add-param', key, this.params[key] );
		return true;
	};

	/**
	 * Retrieve an array of all used parameter names. Note that parameter
	 * names can be different than their stored keys.
	 * @return {string[]} Used parameter names
	 */
	TemplateDataModel.prototype.getAllParamNames = function () {
		var param,
			result = [];
		for ( param in this.params ) {
			result.push( this.params[param].name );
		}

		return result;
	};

	/**
	 * Set the template description
	 * @param {string} description New template description
	 * @param {Object} [language] Description language, if supplied. If not given,
	 *  will default to the wiki language.
	 * @fires change-description
	 */
	TemplateDataModel.prototype.setTemplateDescription = function ( desc, language ) {
		language = language || this.getDefaultLanguage();

		if ( !this.constructor.static.compare( this.description[language], desc ) ) {
			if ( $.type( desc ) === 'object' ) {
				$.extend( this.description, desc );
				this.emit( 'change-description', desc[language], language );
			} else {
				this.description[language] = desc;
				this.emit( 'change-description', desc, language );
			}
		}
	};

	/**
	 * Get the template description.
	 * @param {string} [language] Optional language key
	 * @return {string|Object} The template description. If it is set
	 *  as multilanguage object and no language is set, the whole object
	 *  will be returned.
	 */
	TemplateDataModel.prototype.getTemplateDescription = function ( language ) {
		language = language || this.getDefaultLanguage();
		return this.description[language];
	};

	/**
	 * Get a specific parameter's description
	 * @param {string} paramKey Parameter key
	 * @param {string} [language] Optional language key
	 * @return {string} Parameter description in given language.
	 */
	TemplateDataModel.prototype.getParamDescription = function ( paramKey, language ) {
		language = language || this.getDefaultLanguage();
		if ( this.params[paramKey] && this.params[paramKey].description ) {
			// Return description in this language or fall back
			return this.params[paramKey].description[language] || '';
		}
		return '';
	};

	/**
	 * Get the current wiki language code. Defaults on 'en'.
	 * @return {string} Wiki language
	 */
	TemplateDataModel.prototype.getDefaultLanguage = function () {
		return mw.config.get( 'wgContentLanguage' ) || 'en';
	};

	/**
	 * Set template param order array.
	 * @param {string[]} orderArray Parameter key array in order
	 */
	TemplateDataModel.prototype.setTemplateParamOrder = function ( orderArray ) {
		orderArray = orderArray || [];
		// TODO: Make the compare method verify order of array?
		// Copy the array
		this.paramOrder = orderArray.slice();
		this.emit( 'change-paramOrder', orderArray );
	};

	/**
	 * Retrieve the template paramOrder array
	 * @return {string[]} orderArray Parameter keys in order
	 */
	TemplateDataModel.prototype.getTemplateParamOrder = function () {
		return this.paramOrder;
	};

	/**
	 * Set a specific parameter's property
	 * @param {string} paramKey Parameter key
	 * @param {string} prop Property name
	 * @param {Mixed...} value Property value
	 * @param {string} [language] Value language
	 * @returns {boolean} Operation was successful
	 * @fires change-property
	 */
	TemplateDataModel.prototype.setParamProperty = function ( paramKey, prop, value, language ) {
		var propertiesWithLanguage = this.constructor.static.getPropertiesWithLanguage(),
			allProps = this.constructor.static.getAllProperties( true );

		language = language || this.getDefaultLanguage();

		if ( !allProps[prop] ) {
			// The property isn't supported yet
			return false;
		}

		if ( allProps[prop].type === 'array' && $.type( value ) === 'string' ) {
			value = this.constructor.static.splitAndTrimArray( value, allProps[prop].delimiter );
		}

		// Check if the property is split by language code
		if ( $.inArray( prop, propertiesWithLanguage ) !== -1 ) {
			// Initialize property if necessary
			if ( !$.isPlainObject( this.params[paramKey][prop] ) ) {
				this.params[paramKey][prop] = {};
			}
			value = $.isPlainObject( value ) ? value[language] : value;
			// Compare with language
			if ( !this.constructor.static.compare( this.params[paramKey][prop][language], value ) ) {
				this.params[paramKey][prop][language] = value;
				this.emit( 'change-property', paramKey, prop, value, language );
				return true;
			}
		} else {
			// Compare without language
			if ( !this.constructor.static.compare( this.params[paramKey][prop], value ) ) {
				this.params[paramKey][prop] = value;
				this.emit( 'change-property', paramKey, prop, value, language );
				return true;
			}
		}
		return false;
	};

	/**
	 * Mark a parameter for deletion.
	 * Don't actually delete the parameter so we can make sure it is removed
	 * from the final output.
	 * @param {string} paramKey Parameter key
	 */
	TemplateDataModel.prototype.deleteParam = function ( paramKey ) {
		this.params[paramKey].deleted = true;
	};

	/**
	 * Get a parameter property.
	 * @param {string} paramKey Parameter key
	 * @param {string} prop Parameter property
	 * @return {Mixed...|null} Property value if it exists. Returns null if the
	 * parameter key itself doesn't exist.
	 */
	TemplateDataModel.prototype.getParamProperty = function ( paramKey, prop ) {
		if ( this.params[paramKey] ) {
			return this.params[paramKey][prop];
		}
		return null;
	};

	/**
	 * Retrieve a specific parameter data
	 * @param {string} key Parameter key
	 * @return {Object} Parameter data
	 */
	TemplateDataModel.prototype.getParamData = function ( key ) {
		return this.params[key];
	};

	/**
	 * Return the complete object of all parameters.
	 * @return {Object} All parameters and their data
	 */
	TemplateDataModel.prototype.getParams = function () {
		return this.params;
	};

	/**
	 * Set the original templatedata object
	 * @param {Object} templatedataObj TemplateData object
	 */
	TemplateDataModel.prototype.setOriginalTemplateDataObject = function ( templatedataObj ) {
		this.originalTemplateDataObject = $.extend( true, {}, templatedataObj );
	};

	/**
	 * Set is page sublevel
	 * @param {Boolean} isSubLevel Page is sublevel
	 */
	TemplateDataModel.prototype.setPageSubLevel = function ( isSubLevel ) {
		this.subLevel = isSubLevel;
	};

	/**
	 * Get full page name
	 * @param {string} pageName Page name
	 */
	TemplateDataModel.prototype.setFullPageName = function ( pageName ) {
		this.fullPageName = pageName;
	};

	/**
	 * Set parent page
	 * @param {string} Parent page
	 */
	TemplateDataModel.prototype.setParentPage = function ( parent ) {
		this.parentPage = parent;
	};

	/**
	 * Get is page sublevel
	 * @return {boolean} Page is sublevel
	 */
	TemplateDataModel.prototype.isPageSubLevel = function () {
		return this.subLevel;
	};

	/**
	 * Get page full name
	 * @return {string} Page full name
	 */
	TemplateDataModel.prototype.getFullPageName = function () {
		return this.fullPageName;
	};

	/**
	 * Get parent page
	 * @return {string} Parent page
	 */
	TemplateDataModel.prototype.getParentPage = function () {
		return this.parentPage;
	};

	/**
	 * Get original templatedata object
	 * @return {Object} Templatedata object
	 */
	TemplateDataModel.prototype.getOriginalTemplateDataObject = function () {
		return this.originalTemplateDataObject;
	};

	/**
	 * Process the current model and output it as a complete templatedata string
	 * @return {string} Templatedata String
	 */
	TemplateDataModel.prototype.outputTemplateDataString = function () {
		var param, paramKey, key, prop, oldKey, name, compareOrig, normalizedValue,
			allProps = this.constructor.static.getAllProperties( true ),
			original = this.getOriginalTemplateDataObject(),
			result = $.extend( true, {}, this.getOriginalTemplateDataObject() ),
			defaultLang = this.getDefaultLanguage();

		// Template description
		if ( this.description[defaultLang] !== undefined ) {
			normalizedValue = this.propRemoveUnusedLanguages( this.description );
			if ( this.isOutputInLanguageObject( result.description, normalizedValue ) ) {
				result.description = normalizedValue;
			} else {
				// Store only one language as a string
				result.description = normalizedValue[defaultLang];
			}
		} else {
			// Delete description
			delete result.description;
		}

		// Param order
		if ( this.paramOrder.length > 0 ) {
			result.paramOrder = this.paramOrder;
		} else if ( result.paramOrder && this.paramOrder.length === 0 ) {
			delete result.paramOrder;
		}

		// Attach sets as-is for now
		// TODO: Work properly with sets
		if ( original.sets ) {
			result.sets = original.sets;
		}

		// Go over parameters in data
		for ( paramKey in this.params ) {
			key = paramKey;
			if ( this.params[key].deleted ) {
				delete result.params[key];
				continue;
			}

			// Check if name was changed and change the key accordingly
			name = this.params[key].name;
			oldKey = key;
			if ( key !== this.params[key].name ) {
				key = this.params[key].name;
				// See if the parameters already has something with this new key
				if ( this.params[key] ) {
					// Change the key to be something else
					key += this.getNewValidParameterKey( key );
				}
				// Copy param details to new name in the model
				this.params[key] = this.params[oldKey];
				// Update the references to the key and param data
				param = result.params[name];
				// Delete the old param in both the result and model param
				delete result.params[oldKey];
				delete this.params[oldKey];
			}
			// Notice for clarity:
			// Whether the parameter name was changed or not the following
			// consistency with object keys will be observed:
			// * oldKey: original will use oldKey (for comparison to the old value)
			// * key: this.params will use key (for storing without conflict)
			// * name: result will use name (for valid output)

			// Check if param is new
			if ( !result.params[name] ) {
				// New param. Initialize it
				result.params[name] = {};
			}

			// Go over all properties
			for ( prop in allProps ) {
				switch ( prop ) {
					case 'name':
						continue;
					case 'type':
						// Only include type if the original included type
						// or if the current type is not undefined
						if (
							original.type !== undefined ||
							this.params[key].type !== 'undefined'
						) {
							result.params[name][prop] = this.params[key].type;
						}
						break;
					case 'required':
					case 'suggested':
						if ( !this.params[key][prop] ) {
							// Only add a literal false value if there was a false
							// value before
							if ( original.params[oldKey] && original.params[oldKey][prop] === false ) {
								result.params[name][prop] = false;
							}
						} else {
							result.params[name][prop] = this.params[key][prop];
						}
						break;
					case 'aliases':
						// Only add if there's anything inside the array
						if (
							$.type( this.params[key][prop] ) === 'array' &&
							this.params[key][prop].length > 0
						) {
							result.params[name][prop] = this.params[key][prop];
						}
						break;
					default:
						// Check if there's a value in the model
						if ( this.params[key][prop] !== undefined ) {
							if ( allProps[prop].allowLanguages ) {
								normalizedValue = this.propRemoveUnusedLanguages( this.params[key][prop] );
								// Check if this should be displayed with language object or directly as string
								compareOrig = original.params[oldKey] ? original.params[oldKey][prop] : {};
								if ( this.isOutputInLanguageObject( compareOrig, normalizedValue ) ) {
									result.params[name][prop] = normalizedValue;
								} else {
									// Store only one language as a string
									result.params[name][prop] = normalizedValue[defaultLang];
								}
							} else {
								result.params[name][prop] = this.params[key][prop];
							}
						}
						break;
				}
			}
		}
		return JSON.stringify( result, null, '\t' );
	};

	/**
	 * Check the key if it already exists in the parameter list. If it does,
	 * find a new key that doesn't, and return it.
	 * @param {string} key New parameter key
	 * @return {string} Valid new parameter key
	 */
	TemplateDataModel.prototype.getNewValidParameterKey = function ( key ) {
		var allParamNames = this.getAllParamNames();
		if ( this.params[key] || $.inArray( key, allParamNames ) !== -1 ) {
			// Change the key to be something else
			key += this.paramIdentifierCounter;
			this.paramIdentifierCounter++;
			this.getNewValidParameterKey( key );
		} else {
			return key;
		}
	};
	/**
	 * Go over a language property and remove empty language key values
	 * @return {Object} Property data with only used language keys
	 */
	TemplateDataModel.prototype.propRemoveUnusedLanguages = function ( propData ) {
		var key,
			result = {};
		if ( $.isPlainObject( propData ) ) {
			for ( key in propData ) {
				if ( propData[key] ) {
					result[key] = propData[key];
				}
			}
		}
		return result;
	};

	/**
	 * Check whether the output of the current parameter property should be
	 * outputted in full language mode (object) or a simple string.
	 * @param {string} paramKey Parameter key
	 * @param {string} prop Param property
	 * @return {boolean} Output should be a full language object
	 */
	TemplateDataModel.prototype.isOutputInLanguageObject = function ( originalPropValue, newPropValue ) {
		if (
			(
				// The original was already split to languages
				$.type( originalPropValue ) === 'object' &&
				// Original was not an empty object
				!$.isEmptyObject( originalPropValue )
			) ||
			(
				// The new value is split to languages
				$.type( newPropValue ) === 'object' &&
				// New object is not empty
				!$.isEmptyObject( newPropValue ) &&
				(
					// The new value doesn't have the default language
					newPropValue[this.getDefaultLanguage()] === undefined ||
					// There is more than just one language in the new property
					Object.keys( newPropValue ).length > 1
				)
			)
		) {
			return true;
		}
		return false;
	};

}( jQuery ) );
