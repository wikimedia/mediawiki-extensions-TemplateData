/**
 * TemplateData Dialog
 * @class
 * @mixins OO.EventEmitter
 *
 * @constructor
 * @param {Object} config Dialog configuration object
 */
mw.TemplateData.Model = function mwTemplateDataModel( config ) {
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
	this.paramOrderChanged = false;
	this.paramIdentifierCounter = 0;
	this.setPageSubLevel( !!config.isPageSubLevel );
	this.setFullPageName( config.fullPageName || '' );

	this.originalTemplateDataObject = null;
	this.sourceCodeParameters = [];
	this.templateSourceCodePromise = null;
};

/* Setup */
OO.initClass( mw.TemplateData.Model );
OO.mixinClass( mw.TemplateData.Model, OO.EventEmitter );

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
 * @param {boolean} [getTemplateData] Fetch the templatedata in the page.
 * @return {jQuery.Promise} API promise
 */
mw.TemplateData.Model.static.getApi = function ( page, getTemplateData ) {
	var config,
		api = new mw.Api(),
		baseConfig = {
			action: getTemplateData ? 'templatedata' : 'query',
			titles: page
		};
	if ( getTemplateData ) {
		config = $.extend( baseConfig, {
			redirects: '1'
		} );
	} else {
		config = $.extend( baseConfig, {
			prop: 'revisions',
			rvprop: 'content',
			indexpageids: '1'
		} );
	}
	return api.get( config );
};

/**
 * Compare two objects or strings
 * @param {Object|string} obj1 Base object
 * @param {Object|string} obj2 Compared object
 * @param {boolean} [allowSubset] Allow the second object to be a
 *  partial object (or a subset) of the first.
 * @return {boolean} Objects have equal values
 */
mw.TemplateData.Model.static.compare = function ( obj1, obj2, allowSubset ) {
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
mw.TemplateData.Model.static.translateObsoleteParamTypes = function ( paramType ) {
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
mw.TemplateData.Model.static.getAllProperties = function ( getFullData ) {
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
		deprecated: {
			type: 'boolean',
			// This should only be defined for boolean properties.
			// Define the property that represents the text value.
			textValue: 'deprecatedValue'
		},
		deprecatedValue: {
			type: 'string',
			changesBooleanValue: 'deprecated'
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
mw.TemplateData.Model.static.getPropertiesWithLanguage = function () {
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
mw.TemplateData.Model.static.splitAndTrimArray = function ( str, delim ) {
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
mw.TemplateData.Model.static.arrayUnionWithoutEmpty = function () {
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
mw.TemplateData.Model.prototype.loadModel = function ( tdString ) {
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

			// Mark existing parameters in the model
			if ( original.params ) {
				for ( var param in original.params ) {
					this.addParam( param, original.params[param] );
				}
			}
			this.setTemplateDescription( original.description );
			// Override the param order if it exists in the templatedata string
			if ( original.paramOrder && original.paramOrder.length > 0 ) {
				this.setTemplateParamOrder( original.paramOrder );
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
mw.TemplateData.Model.prototype.getMissingParams = function () {
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
mw.TemplateData.Model.prototype.importSourceCodeParameters = function () {
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
mw.TemplateData.Model.prototype.getModelFromString = function ( templateDataString ) {
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
mw.TemplateData.Model.prototype.getExistingLanguageCodes = function () {
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
mw.TemplateData.Model.prototype.getParametersFromTemplateSource = function ( templateDataString ) {
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
mw.TemplateData.Model.prototype.extractParametersFromTemplateCode = function ( templateCode ) {
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
mw.TemplateData.Model.prototype.addParam = function ( key, paramData ) {
	var prop, name, lang, propToSet,
		existingNames = this.getAllParamNames(),
		data = $.extend( true, {}, paramData ),
		language = this.getDefaultLanguage(),
		propertiesWithLanguage = this.constructor.static.getPropertiesWithLanguage(),
		allProps = this.constructor.static.getAllProperties( true );

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
	if ( data.type !== undefined ) {
		this.params[key].normalizedType = this.constructor.static.translateObsoleteParamTypes( this.params[key].type );
	}

	// Get the deprecated value
	if ( $.type( data.deprecated ) === 'string' ) {
		this.params[key].deprecatedValue = data.deprecated;
	}

	// Go over the rest of the data
	if ( data ) {
		for ( prop in data ) {
			propToSet = prop;
			if (
				// This is to make sure that forwards compatibility is achieved
				// and the code doesn't die on properties that aren't valid
				allProps[ prop ] &&
				// Check if property should have its text represented in another internal property
				// (for example, deprecated and deprecatedValue)
				allProps[ prop ].textValue
			) {
				// Set the textValue property
				propToSet = allProps[ prop ].textValue;
				// Set the boolean value in the current property
				this.setParamProperty( key, prop, !!data[prop], language );
			}

			if (
				$.inArray( propToSet, propertiesWithLanguage ) !== -1 &&
				$.isPlainObject( data[prop] )
			) {
				// Add all language properties
				for ( lang in data[prop] ) {
					this.setParamProperty( key, propToSet, data[prop], lang );
				}
			} else {
				this.setParamProperty( key, propToSet, data[prop], language );
			}
		}
	}

	// Add to paramOrder
	this.addKeyTemplateParamOrder( key );

	// Trigger the add parameter event
	this.emit( 'add-param', key, this.params[key] );
	return true;
};

/**
 * Retrieve an array of all used parameter names. Note that parameter
 * names can be different than their stored keys.
 * @return {string[]} Used parameter names
 */
mw.TemplateData.Model.prototype.getAllParamNames = function () {
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
mw.TemplateData.Model.prototype.setTemplateDescription = function ( desc, language ) {
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
mw.TemplateData.Model.prototype.getTemplateDescription = function ( language ) {
	language = language || this.getDefaultLanguage();
	return this.description[language];
};

/**
 * Get a specific parameter's description
 * @param {string} paramKey Parameter key
 * @param {string} [language] Optional language key
 * @return {string} Parameter description in given language.
 */
mw.TemplateData.Model.prototype.getParamDescription = function ( paramKey, language ) {
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
mw.TemplateData.Model.prototype.getDefaultLanguage = function () {
	return mw.config.get( 'wgContentLanguage' ) || 'en';
};

/**
 * Set template param order array.
 * @param {string[]} orderArray Parameter key array in order
 * @fires change-paramOrder
 */
mw.TemplateData.Model.prototype.setTemplateParamOrder = function ( orderArray ) {
	orderArray = orderArray || [];
	// TODO: Make the compare method verify order of array?
	// Copy the array
	this.paramOrder = orderArray.slice();
	this.emit( 'change-paramOrder', orderArray );
};

/**
 * Add a key to the end of the paramOrder
 * @param {string} key New key the add into the paramOrder
 * @fires add-paramOrder
 */
mw.TemplateData.Model.prototype.addKeyTemplateParamOrder = function ( key ) {
	if ( $.inArray( key, this.paramOrder ) === -1 ) {
		this.paramOrder.push( key );
		this.emit( 'add-paramOrder', key );
	}
};

mw.TemplateData.Model.prototype.reorderParamOrderKey = function ( key, newIndex ) {
	var keyIndex = this.paramOrder.indexOf( key );
	// Move the parameter
	this.paramOrder.splice(
		newIndex,
		0,
		this.paramOrder.splice( keyIndex, 1 )[0]
	);

	this.paramOrderChanged = true;

	// Emit event
	this.emit( 'change-paramOrder', this.paramOrder );
};

/**
 * Add a key to the end of the paramOrder
 * @param {string} key New key the add into the paramOrder
 */
mw.TemplateData.Model.prototype.removeKeyTemplateParamOrder = function ( key ) {
	var keyPos = $.inArray( key, this.paramOrder );
	if ( keyPos > -1 ) {
		this.paramOrder.splice( keyPos, 1 );
		this.emit( 'change-paramOrder', this.paramOrder );
	}
};

/**
 * Retrieve the template paramOrder array
 * @return {string[]} orderArray Parameter keys in order
 */
mw.TemplateData.Model.prototype.getTemplateParamOrder = function () {
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
mw.TemplateData.Model.prototype.setParamProperty = function ( paramKey, prop, value, language ) {
	var propertiesWithLanguage = this.constructor.static.getPropertiesWithLanguage(),
		allProps = this.constructor.static.getAllProperties( true ),
		status = false;

	language = language || this.getDefaultLanguage();
	if ( !allProps[prop] ) {
		// The property isn't supported yet
		return status;
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
			status = true;
		}
	} else {
		// Compare without language
		if ( !this.constructor.static.compare( this.params[paramKey][prop], value ) ) {
			this.params[paramKey][prop] = value;
			this.emit( 'change-property', paramKey, prop, value, language );
			status = true;
		}
	}

	if ( allProps[ prop ].textValue && value === false ) {
		// Unset the text value if the boolean it depends on is false
		status = this.setParamProperty( paramKey, allProps[prop].textValue, null, language );
	}

	return status;
};

/**
 * Mark a parameter for deletion.
 * Don't actually delete the parameter so we can make sure it is removed
 * from the final output.
 * @param {string} paramKey Parameter key
 * @fires delete-param
 */
mw.TemplateData.Model.prototype.deleteParam = function ( paramKey ) {
	this.params[paramKey].deleted = true;
	// Remove from paramOrder
	this.removeKeyTemplateParamOrder( paramKey );
	this.emit( 'delete-param', paramKey );
};

/**
 * Restore parameter by unmarking it as deleted.
 * @param {string} paramKey Parameter key
 * @fires add-param
 */
mw.TemplateData.Model.prototype.restoreParam = function ( paramKey ) {
	if ( this.params[paramKey] ) {
		this.params[paramKey].deleted = false;
		// Add back to paramOrder
		this.addKeyTemplateParamOrder( paramKey );
		this.emit( 'add-param', paramKey, this.params[paramKey] );
	}
};

/**
 * Delete all data attached to a parameter
 * @param {string} paramKey Parameter key
 */
mw.TemplateData.Model.prototype.emptyParamData = function ( paramKey ) {
	if ( this.params[paramKey] ) {
		// Delete all data and readd the parameter
		delete this.params[paramKey];
		this.addParam( paramKey );
		// Mark this parameter as intentionally emptied
		this.params[paramKey].emptied = true;
	}
};

/**
 * Get a parameter property.
 * @param {string} paramKey Parameter key
 * @param {string} prop Parameter property
 * @return {Mixed...|null} Property value if it exists. Returns null if the
 * parameter key itself doesn't exist.
 */
mw.TemplateData.Model.prototype.getParamProperty = function ( paramKey, prop ) {
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
mw.TemplateData.Model.prototype.getParamData = function ( key ) {
	return this.params[key];
};

/**
 * Return the complete object of all parameters.
 * @return {Object} All parameters and their data
 */
mw.TemplateData.Model.prototype.getParams = function () {
	return this.params;
};

mw.TemplateData.Model.prototype.isParamDeleted = function ( key ) {
	return this.params[key] && this.params[key].deleted === true;
};

mw.TemplateData.Model.prototype.isParamExists = function ( key ) {
	return $.inArray( key, Object.keys( this.params ) ) > -1;
};

/**
 * Set the original templatedata object
 * @param {Object} templatedataObj TemplateData object
 */
mw.TemplateData.Model.prototype.setOriginalTemplateDataObject = function ( templatedataObj ) {
	this.originalTemplateDataObject = $.extend( true, {}, templatedataObj );
};

/**
 * Set is page sublevel
 * @param {boolean} isSubLevel Page is sublevel
 */
mw.TemplateData.Model.prototype.setPageSubLevel = function ( isSubLevel ) {
	this.subLevel = isSubLevel;
};

/**
 * Get full page name
 * @param {string} pageName Page name
 */
mw.TemplateData.Model.prototype.setFullPageName = function ( pageName ) {
	this.fullPageName = pageName;
};

/**
 * Set parent page
 * @param {string} Parent page
 */
mw.TemplateData.Model.prototype.setParentPage = function ( parent ) {
	this.parentPage = parent;
};

/**
 * Get is page sublevel
 * @return {boolean} Page is sublevel
 */
mw.TemplateData.Model.prototype.isPageSubLevel = function () {
	return this.subLevel;
};

/**
 * Get page full name
 * @return {string} Page full name
 */
mw.TemplateData.Model.prototype.getFullPageName = function () {
	return this.fullPageName;
};

/**
 * Get parent page
 * @return {string} Parent page
 */
mw.TemplateData.Model.prototype.getParentPage = function () {
	return this.parentPage;
};

/**
 * Get original templatedata object
 * @return {Object} Templatedata object
 */
mw.TemplateData.Model.prototype.getOriginalTemplateDataObject = function () {
	return this.originalTemplateDataObject;
};

/**
 * Process the current model and output it as a complete templatedata string
 * @return {string} Templatedata String
 */
mw.TemplateData.Model.prototype.outputTemplateDataString = function () {
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
	if ( original.paramOrder || this.paramOrderChanged ) {
		result.paramOrder = this.paramOrder;
	} else {
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

		// If the user intentionally empties a parameter, delete it from
		// the result and treat it as a new parameter
		if ( this.params[key].emptied ) {
			delete result.params[key];
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
				case 'deprecatedValue':
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
				case 'deprecated':
				case 'required':
				case 'suggested':
					if ( !this.params[key][prop] ) {
						// Only add a literal false value if there was a false
						// value before
						if ( original.params[oldKey] && original.params[oldKey][prop] === false ) {
							result.params[name][prop] = false;
						} else {
							// Otherwise, delete this value
							delete result.params[name][prop];
						}
					} else {
						if ( prop === 'deprecated' ) {
							result.params[name][prop] = this.params[key].deprecatedValue || true;
							// Remove deprecatedValue
							delete result.params[name].deprecatedValue;
						} else {
							result.params[name][prop] = this.params[key][prop];
						}
					}
					break;
				case 'aliases':
					// Only update the aliases in if the new templatedata has an
					// aliases array that isn't empty
					if (
						$.type( this.params[key][prop] ) === 'array' &&
						this.params[key][prop].length > 0
					) {
						result.params[name][prop] = this.params[key][prop];
					} else {
						// If the new aliases array is empty, delete it from the original
						delete result.params[name][prop];
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
							// Set up the result
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
mw.TemplateData.Model.prototype.getNewValidParameterKey = function ( key ) {
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
mw.TemplateData.Model.prototype.propRemoveUnusedLanguages = function ( propData ) {
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
mw.TemplateData.Model.prototype.isOutputInLanguageObject = function ( originalPropValue, newPropValue ) {
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
