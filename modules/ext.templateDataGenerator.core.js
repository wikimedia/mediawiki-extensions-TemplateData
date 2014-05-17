( function ( $, mw ) {
	/**
	 * TemplateDataGenerator generates the JSON string for templatedata
	 * or reads existing templatedata string and allows for it to be edited
	 * with a visual modal GUI.
	 *
	 * @author Moriel Schottlender
	 */
	'use strict';

	mw.libs.templateDataGenerator = ( function () {
		var paramBase, paramTypes, domObjects, curr;

		/* Private helper functions */

		/**
		 * Show an error message in the main Edit screen
		 *
		 * @param {string} msg The message to display in the error box
		 */
		function showErrorEditPage( msg ) {
			domObjects.$errorBox.text( msg ).show();
		}

		/**
		 * Helper function to clean up the aliases string-to-array
		 *
		 * @param {string} str Comma separated string
		 * @returns {string[]} Cleaned-up alias array
		 */
		function cleanupAliasArray( str ) {
			return $.map( str.split( ',' ), function ( item ) {
				if ( $.trim( item ).length > 0 ) {
					return $.trim( item );
				}
			} );
		}

		/**
		 * Show an error message in the GUI
		 *
		 * @param {string} msg The message to be displayed in the error box
		 */
		function showErrorModal( msg ) {
			domObjects.$errorModalBox.text( msg ).show();
		}

		/**
		 * Create `<select>` for parameter type based on the
		 * options given by key/value
		 *
		 * @param {Object} options The key/value pair for the options
		 *  that should appear in the select input.
		 * @returns {jQuery} <select> object
		 */
		function createTypeSelect( opts ) {
			var op,
				$sel = $( '<select>' );

			for ( op in opts ) {
				$sel.append( $( '<option>' ).val( op ).text( opts[ op ] ) );
			}

			return $sel;
		}

		/**
		 * Parse the JSON information from the wikitext
		 *
		 * If it exists, and prepare DOM elements from
		 * the parameters into the global param DOM JSON.
		 *
		 * @param {string} wikitext The source of the template text
		 * @returns {Object} Parameters object parsed from the JSON string
		 */
		function parseTemplateData( wikitext ) {
			var attrib,
				param,
				trimmedParam,
				arrayParamNamesForTrimming = [],
				jsonParams = {},
				parts = wikitext.match(
					/(<templatedata>)([\s\S]*?)(<\/templatedata>)/i
				);

			// Check if <templatedata> exists
			if ( parts && parts[2] ) {
				// Make sure it's not empty
				if ( $.trim( parts[2] ).length > 0 ) {
					try {
						jsonParams = $.parseJSON( $.trim( parts[2] ) );
					} catch ( err ) {
						// Oops, JSON contains syntax error
						mw.log( 'TemplateData: ' + mw.msg( 'templatedata-errormsg-jsonbadformat' ) );
						if ( domObjects ) {
							showErrorEditPage( mw.msg( 'templatedata-errormsg-jsonbadformat' ) );
						}
						return {};
					}
				}
				// See if jsonParams has 'params'
				if ( jsonParams && jsonParams.params ) {
					// Add DOM elements to the JSON data params
					for ( param in jsonParams.params ) {
						// Trim parameter key if it contains trailing/leading whitespace
						trimmedParam = $.trim( param );

						// Insert into the array for later trimming
						if ( trimmedParam !== param ) {
							arrayParamNamesForTrimming.push( param );
						}
						// Only create dom params if needed
						// This will allow the entire method to be called
						// individually, as a tool or for qunit tests
						if ( curr && curr.paramDomElements ) {
							setupDomParam( trimmedParam, attrib );
						}
					}
				}
				// Trim the params we need to in the JSON object param keys
				$.each( arrayParamNamesForTrimming, function ( index, paramid ) {
					trimmedParam = $.trim( paramid );
					jsonParams.params[trimmedParam] = jsonParams.params[paramid];
					delete jsonParams.params[paramid];
				} );
			}

			return jsonParams;
		}

		/**
		 * Create a DOM element that correspond to the parameter and field
		 *
		 * @param {String} paramName Parameter name or id
		 * @param {String} attrib The field that will correspond to the dom element
		 */
		function setupDomParam( paramName, attrib ) {
			var $tmpDom;
			curr.paramDomElements[paramName] = {};

			// Create DOM elements per parameter
				for ( attrib in paramBase ) {
					// Set up the DOM element
					if ( attrib === 'type' ) {
						$tmpDom = createTypeSelect( paramTypes );
					} else {
						$tmpDom = paramBase[attrib].dom;
					}
					curr.paramDomElements[paramName][attrib] = $tmpDom.clone( true );
					curr.paramDomElements[paramName][attrib].data( 'paramid', paramName );
					curr.paramDomElements[paramName][attrib].attr( 'id', attrib + '_paramid_' + paramName );
					curr.paramDomElements[paramName][attrib].addClass( 'tdg-element-attr-' + attrib );

				}
				// Set up the 'delete' button
				curr.paramDomElements[paramName].delbutton
					.text( mw.msg( 'templatedata-modal-button-delparam' ) )
					.addClass( 'tdg-param-del' )
					.attr( 'id', 'tdg-param-del' )
					.data( 'paramid', paramName );
		}

		/**
		 * Checks the wikitext for template parameters and imports
		 * those that aren't yet in the templatedata list.
		 * Adapted from https://he.wikipedia.org/wiki/MediaWiki:Gadget-TemplateParamWizard.js
		 *
		 * @param {string} wikitext The source of the template text
		 */
		function importTemplateParams( wikitext ) {
			var newParam, matches, $row, paramName, paramID,
				paramExtractor = /{{3,}(.*?)[<|}]/mg,
				paramCounter = 0,
				existingParamNamesArray = [];

			// fill up the existingParamNameArray with GUI params
			// So we can test against it while importing:
			// We should go by param name, not param ID, because
			// if the param is new, its id is new_randomString, and so
			// the actual representation is the value of the name field.
			for ( paramID in curr.paramDomElements ) {
				paramName = $.trim( curr.paramDomElements[paramID].name.val() );

				// Validate
				if (
					paramName.length > 0 &&
					!paramName.match( /[\|=]|}}/ ) &&
					!curr.paramDomElements[paramID].tdgMarkedForDeletion &&
					$.inArray( paramName, existingParamNamesArray ) === -1
				) {
					existingParamNamesArray.push( paramName );
				}
			}

			while ( ( matches = paramExtractor.exec( wikitext ) ) !== null ) {
				paramName = $.trim( matches[1] );

				// Make sure the template itself is not giving us bad params
				if (
					paramName.length === 0 &&
					paramName.match( /[\|=]|}}/ )
				) {
					continue;
				}

				// Make sure the param doesn't already exist in the GUI
				if ( $.inArray( paramName, existingParamNamesArray ) > -1 ) {
					// This is dupe, ignore it
					continue;
				} else {
					// Add name to the existingParamNamesArray
					existingParamNamesArray.push( paramName );

					// Add to domParams
					newParam = addParam();
					newParam.name.val( paramName );
					$row = translateParamToRowDom( curr.paramsJson, newParam );
					domObjects.$modalTable.append( $row );
					paramCounter++;
				}
			}

			if ( paramCounter === 0 ) {
				showErrorModal( mw.msg( 'templatedata-modal-errormsg-import-noparams' ) );
			} else {
				showErrorModal( mw.msg( 'templatedata-modal-notice-import-numparams', paramCounter ) );
			}
		}

		/**
		 * Create a <table> DOM with initial headings for the parameters
		 * The table headings will go by the paramBase
		 *
		 * @returns {jQuery} Table element
		 */
		function createParamTableDOM() {
			var $tbl, attrib,
				$tr = $( '<tr>' );

			for ( attrib in paramBase ) {
				$tr.append(
					$( '<th>' )
						.text( paramBase[attrib].label )
						.addClass( 'tdg-title-' + attrib )
					);
			}

			$tbl = $( '<table>' )
				.addClass( 'tdg-editTable' )
				.append( $tr );

			return $tbl;
		}

		/**
		 * Create a <table> HTMLElement with initial headings for the parameters
		 * The table headings will go by the paramBase
		 *
		 * @param {Object} paramsJson Object with current parameter values
		 * @param {Object} paramAttrObj Object with parameter properties
		 * @returns {jQuery} Table element
		 */
		function translateParamToRowDom( paramsJson, paramAttrObj ) {
			var $tdDom,
				$trDom,
				paramAttr,
				paramid = paramAttrObj.delbutton.data( 'paramid' );

			$trDom = $( '<tr>' )
				.attr( 'id', 'param-' + paramid )
				.data( 'paramid', paramid );

			// Go over the attributes for <td>s
			for ( paramAttr in paramAttrObj ) {
				// Check if value already exists for this in the original json
				if (
					paramsJson.params &&
					paramsJson.params[paramid] &&
					paramsJson.params[paramid][paramAttr]
				) {
					// Only accept values that are expected editable
					if (
						typeof paramsJson.params[paramid][paramAttr] === 'string' ||
						( paramAttr === 'aliases' && $.isArray( paramsJson.params[paramid][paramAttr] ) )
					) {
						paramAttrObj[paramAttr].val( paramsJson.params[paramid][paramAttr] );
					} else if ( paramAttrObj[paramAttr].prop( 'type' ) === 'checkbox' ) {
						paramAttrObj[paramAttr].prop( 'checked', paramsJson.params[paramid][paramAttr] );
					} else {
						// For the moment, objects are uneditable
						paramAttrObj[paramAttr]
							.prop( 'disabled', true )
							.data( 'tdg-uneditable', true )
							.val( mw.msg( 'brackets', mw.msg( 'templatedata-modal-table-param-uneditablefield' ) ) );
					}
				}

				$tdDom = $( '<td>' ).addClass( 'tdg-attr-' + paramAttr );

				// Add label to 'required' checkbox
				if ( paramAttr === 'required' ) {
					$tdDom.append(
						$( '<label>' )
							.attr( 'for', paramAttr + '_paramid_' + paramid )
							.text( paramBase.required.label )
							.prepend( paramAttrObj[paramAttr] )
					);
				} else {
					$tdDom.append( paramAttrObj[paramAttr] );
				}

				$trDom.append( $tdDom );
			}

			// Set up the name
			if ( paramsJson && curr.paramsJson.params && curr.paramsJson.params[paramid] ) {
				$trDom.find( '.tdg-element-attr-name' ).val( paramid );
			}

			return $trDom;
		}

		/**
		 * Add an empty parameter to the paramDomElements list
		 *
		 * @returns {jQuery} Table row element
		 */
		function addParam() {
			var attrib,
				$tmpDom,
				// Create a unique identifier for paramid
				paramid = 'new_' + $.now();

			// Add to the DOM object
			curr.paramDomElements[paramid] = {};

			for ( attrib in paramBase ) {
				// Set up the DOM element
				if ( attrib === 'type' ) {
					$tmpDom = createTypeSelect( paramTypes );
				} else {
					$tmpDom = paramBase[attrib].dom;
				}

				curr.paramDomElements[paramid][attrib] = $tmpDom.clone( true );
				curr.paramDomElements[paramid][attrib].data( 'paramid', paramid );
				curr.paramDomElements[paramid][attrib].attr( 'id', attrib + '_paramid_' + paramid );
				curr.paramDomElements[paramid][attrib].addClass( 'tdg-element-attr-' + attrib );
			}

			// Set up the 'delete' button
			curr.paramDomElements[paramid].delbutton
				.text( mw.msg( 'templatedata-modal-button-delparam' ) )
				.addClass( 'tdg-param-del' )
				.attr( 'id', 'tdg-param-del' )
				.data( 'paramid', paramid );

			return curr.paramDomElements[paramid];
		}

		/**
		 * Validate the Modal inputs before continuing to the actual 'apply'
		 *
		 * @returns {boolean} Passed validation
		 */
		function isFormValid() {
			var paramID,
				paramName,
				paramNameArray = [],
				passed = true,
				paramProblem = false;

			// Reset
			$( '.tdgerror' ).removeClass( 'tdgerror' );
			domObjects.$errorModalBox.empty().hide();

			// Go over the paramDomElements object, look for:
			// * Empty name fields
			// * Duplicate *name* values:
			// * Illegal characters in name fields: pipe, equal, }}
			for ( paramID in curr.paramDomElements ) {
				paramProblem = false;
				// Trim:
				paramName = curr.paramDomElements[paramID].name.val();
				curr.paramDomElements[paramID].name.val( paramName );

				// Ignore if the param was flagged for deletion
				if ( curr.paramDomElements[paramID].tdgMarkedForDeletion ) {
					continue;
				}

				// Name field is empty
				if ( paramName.length === 0 ) {
					passed = false;
					paramProblem = true;
				}

				// Check for illegal characters in param name
				if ( paramName.match( /[\|=]|}}/ ) ) {
					passed = false;
					paramProblem = true;
				}

				// Check for dupes
				if ( $.inArray( paramName, paramNameArray ) > -1 ) {
					// This is dupe!
					passed = false;
					paramProblem = true;
				} else {
					paramNameArray.push( paramName );
				}

				if ( paramProblem ) {
					domObjects.$modalTable.find( '#param-' + paramID ).addClass( 'tdgerror' );
				}
			}

			return passed;
		}

		/**
		 * Reset the GUI completely, including the domElements and the json
		 */
		function globalReset() {
			// Reset Modal GUI
			domObjects.$modalBox.empty();
			domObjects.$errorModalBox.empty().hide();

			// Reset vars
			curr = {
				paramDomElements: {},
				paramsJson: {}
			};
		}

		/**
		 * Take the amended JSON object and stringify it, putting
		 *  it back into the original wikitext.
		 * @param {Object} newJsonObject Edited json object
		 * @param {String} originalWikitext The original wikitext
		 * @returns {String} Thew new wikitext
		 */
		function amendWikitext( newJsonObject, originalWikitext ) {
			var finalOutput = '',
				wikitext = originalWikitext || domObjects.wikitext;

				// Check if we started with existing <templatedata> tags
				if ( wikitext.match(
						/(<templatedata>)([\s\S]*?)(<\/templatedata>)/i)
				) {
					// replace the <templatedata> tags
					finalOutput = wikitext.replace(
						/(<templatedata>)([\s\S]*?)(<\/templatedata>)/i,
						'<templatedata>\n' + JSON.stringify( newJsonObject, null, '	' ) + '\n</templatedata>'
					);
				} else {
					// add <templatedata> tags
					finalOutput = wikitext + '\n<templatedata>\n';
					finalOutput += JSON.stringify( newJsonObject, null, '	' );
					finalOutput += '\n</templatedata>';
				}

				return finalOutput;
		}
		/**
		 * Apply the changes made to the parameters to the json
		 *
		 * @param {Object} originalJsonObject [description]
		 * @param {Object<string,jQuery>} modalDomElements The structure of the
		 *  dom elements in the editor, sorted by parameter id and jQuery editable
		 *  object
		 * @param {boolean} doNotCheckForm if set to true, the system will not validate the form
		 *  used mostly for tests.
		 * @returns {Object|boolean} Amended json object or false if changes are invalid.
		 */
		function applyChangeToJSON( originalJsonObject, modalDomElements, doNotCheckForm ) {
			var templateDescriptionObject,
				paramid,
				paramName,
				paramProp,
				$domEl,
				domElements,
				newValue,
				paramObj,
				propExists,
				tmpjson,
				// Compare the original to the new changes
				outputJson = originalJsonObject || curr.paramsJson,
				paramDomElements = modalDomElements || curr.paramDomElements;

			// Validate
			if ( !doNotCheckForm ) {
				if ( !isFormValid() ) {
					showErrorModal( mw.msg( 'templatedata-modal-errormsg', '|', '=', '}}' ) );
					return false;
				}
			}

				// Update the description
				templateDescriptionObject = $( '.tdg-template-description' );

				if (
						templateDescriptionObject.length &&
						!templateDescriptionObject.data( 'tdg-uneditable' )
					) {
					outputJson.description = templateDescriptionObject.val();
				}

				// First check if there's outpuJson.params
				if ( !outputJson.params ) {
					outputJson.params = {};
				}

				// Go over the parameters, check if param was marked as deleted
				// in curr.paramsJson
				for ( paramid in paramDomElements ) {
					domElements = paramDomElements[paramid];
					// Get the name of the param
					paramName = domElements.name.val();
					// New parameter added
					if ( !outputJson.params[paramid] ) {
						paramObj = outputJson.params[paramName] = {};
					} else {
						// Check if name changed
						if ( paramName !== paramid ) {
							// change the param name
							outputJson.params[paramName] = {};
							tmpjson = $.extend( true, {}, outputJson.params[paramid] );
							$.extend( true, outputJson.params[paramName], tmpjson );
							// delete the old param
							delete outputJson.params[paramid];
						}
					}

					// Parameter marked for deletion
					if ( domElements.tdgMarkedForDeletion ) {
						delete outputJson.params[paramName];
						// Move to next iteration
						continue;
					}

					paramObj = outputJson.params[paramName];

					// Go over the properties that have DOM elements
					for ( paramProp in domElements ) {
						propExists = ( paramObj.hasOwnProperty( paramProp ) );
						$domEl = domElements[paramProp];

						// Skip all inputs that are marked as uneditable
						if ( !$domEl.data( 'tdg-uneditable' ) ) {
							// Check if value changed
							switch ( paramProp ) {
								// Skip:
								case 'name':
								case 'delbutton':
									break;
								case 'aliases':
									newValue = cleanupAliasArray( $domEl.val() );
									if ( propExists &&
										newValue.sort().join( '|' ) !== paramObj.aliases.sort().join( '|' ) ) {
										// Replace:
										if ( newValue.length === 0 ) {
											delete paramObj.aliases;
											continue;
										} else {
											paramObj.aliases = newValue;
										}
									} else if ( !propExists ) {
										if ( newValue.length > 0 ) {
											paramObj.aliases = newValue;
										}
									}
									break;
								case 'description':
								case 'default':
								case 'label':
									newValue = $domEl.val();
									if ( paramObj[paramProp] !== newValue ) {
										if ( !newValue || newValue.length === 0 ) {
											delete paramObj[paramProp];
											continue;
										} else {
											paramObj[paramProp] = newValue;
										}
									}
									break;
								case 'type':
									newValue = $domEl.val();
									if ( paramObj[paramProp] !== newValue ) {
										if ( newValue === 'undefined' ) {
											delete paramObj[paramProp];
											continue;
										} else {
											paramObj[paramProp] = newValue;
										}
									}
									break;
								case 'required':
									newValue = $domEl.prop( 'checked' );
									if ( paramObj[paramProp] !== undefined || newValue === true ) {
										paramObj[paramProp] = newValue;
									}
									break;
							}
						}
					}
				}
				return outputJson;
		}
		/**
		 * Create i18n-compatible Modal Buttons
		 * also contains the 'apply' functionality
		 *
		 * @param {string} btnApply the text for the 'apply' button
		 * @param {string} btnCancel the text for the 'cancel' button
		 * @returns {Array} Button objects with their functionality, for the modal
		 */
		function i18nModalButtons( btnApply, btnCancel ) {
			var modalButtons = {};

			modalButtons[btnApply] = function () {
				var finalOutput,
					newJson = applyChangeToJSON();

				// Check if returned json is valid
				if ( !newJson ) {
					return false;
				}

				// Apply changes
				finalOutput = amendWikitext( newJson );

				// Close the modal
				domObjects.$modalBox.dialog( 'close' );

				// Trigger the closing event so the new output can be put
				// back to the textbox
				domObjects.$modalBox.trigger( 'TemplateDataGeneratorDone', [ finalOutput ] );

				return finalOutput;
			};

			modalButtons[btnCancel] = function () {
				domObjects.$modalBox.dialog( 'close' );
			};

			return modalButtons;
		}

		/** Public Methods **/
		return {
			/**
			 * Injects required DOM elements to the edit screen
			 */
			init: function () {
				paramBase = {
					name: {
						label: mw.msg( 'templatedata-modal-table-param-name' ),
						dom: $( '<input>' )
					},
					aliases: {
						label: mw.msg( 'templatedata-modal-table-param-aliases' ),
						dom: $( '<input>' )
					},
					label: {
						label: mw.msg( 'templatedata-modal-table-param-label' ),
						dom: $( '<input>' )
					},
					description: {
						label: mw.msg( 'templatedata-modal-table-param-desc' ),
						dom: $( '<textarea>' )
					},
					type: {
						label: mw.msg( 'templatedata-modal-table-param-type' ),
						dom: $( '<select>' )
					},
					'default': {
						label: mw.msg( 'templatedata-modal-table-param-default' ),
						dom: $( '<textarea>' )
					},
					'required': {
						label: mw.msg( 'templatedata-modal-table-param-required' ),
						dom: $( '<input type="checkbox" />' )
					},
					delbutton: {
						label: mw.msg( 'templatedata-modal-table-param-actions' ),
						dom: $( '<button>' )
							.button()
							.addClass( 'tdg-param-button-del buttonRed' )
							.click( function () {
								var paramid = $( this ).data( 'paramid' );
									// Flag as DELETED in curr.paramDomElements[paramid] (property tdgDELETED)
								if ( curr.paramDomElements[paramid] ) {
									curr.paramDomElements[paramid].tdgMarkedForDeletion = true;
								}
								// Delete the DOM row from table:
								// (Don't delete property from paramDomElements,
								// so when we go over the DOM elements on 'apply' this
								// parameter is recognized as marked for deletion)
								$( '#param-' + paramid ).remove();
							} )
					}
				};
				paramTypes = {
					'undefined': mw.msg( 'templatedata-modal-table-param-type-undefined' ),
					'number': mw.msg( 'templatedata-modal-table-param-type-number' ),
					'date': mw.msg( 'templatedata-modal-table-param-type-date' ),
					'string': mw.msg( 'templatedata-modal-table-param-type-string' ),
					'string/wiki-user-name': mw.msg( 'templatedata-modal-table-param-type-user' ),
					'string/wiki-file-name': mw.msg( 'templatedata-modal-table-param-type-file' ),
					'string/wiki-page-name': mw.msg( 'templatedata-modal-table-param-type-page' )
				};
				domObjects = {
					$editButton: $( '<button>' )
						.button()
						.addClass( 'tdg-editscreen-main-button' )
						.text( mw.msg( 'templatedata-editbutton' ) ),
					$errorBox: $( '<div>' )
						.addClass( 'tdg-editscreen-error-msg' )
						.hide(),
					$errorModalBox: $( '<div>' )
						.addClass( 'tdg-errorbox' )
						.hide(),
					$modalBox: $( '<div>' )
						.addClass( 'tdg-editscreen-modal-form' )
						.attr( 'id', 'modal-box' )
						.attr( 'title', mw.msg( 'templatedata-modal-title' ) )
						.hide(),
					$modalTable: {},
					wikitext: ''
				};
				curr = {
					paramDomElements: {},
					paramsJson: {}
				};
				// Return the objects to be added to the edit page
				return domObjects;
			},

			/**
			 * Create the modal screen and populate it with existing
			 * data, if available
			 *
			 * @param {jQuery} $wikitextBox Article edit textarea
			 * @returns {jQuery} Modal div element
			 */
			createModal: function ( wikitext ) {
				var $row,
					paramObj,
					$descBox;

				// Reset:
				globalReset();
				domObjects.wikitext = wikitext;
				$descBox = $( '<textarea>' ).addClass( 'tdg-template-description' );
				domObjects.$modalTable = createParamTableDOM();

				// Parse JSON
				curr.paramsJson = parseTemplateData( wikitext );
				if ( !$.isEmptyObject( curr.paramsJson ) ) {
					if ( curr.paramsJson.description ) {
						if ( typeof curr.paramsJson.description === 'string' ) {
							$descBox.text( curr.paramsJson.description );
						} else {
							$descBox
								.prop( 'disabled', true )
								.data( 'tdg-uneditable', true )
								.val( mw.msg( 'brackets', mw.msg( 'templatedata-modal-table-param-uneditablefield' ) ) );
						}
					}

					// Build the parameter row DOMs
					for ( paramObj in curr.paramDomElements ) {
						// Make the row
						$row = translateParamToRowDom( curr.paramsJson, curr.paramDomElements[paramObj] );
						domObjects.$modalTable.append( $row );
					}
				}

				// Build the Modal window
				domObjects.$modalBox
					.append( $( '<h3>' )
						.addClass( 'tdg-title' )
						.text( mw.msg( 'templatedata-modal-title-templatedesc' ) )
					)
					.append( $descBox )
					.append( domObjects.$errorModalBox )
					.append( $( '<h3>' )
						.addClass( 'tdg-title' )
						.text( mw.msg( 'templatedata-modal-title-templateparams' ) )
					)
					.append(
						$( '<button>' )
							.button()
							.text( mw.msg( 'templatedata-modal-button-importParams' ) )
							.addClass( 'tdg-addparam' )
							.click( function () {
								// TODO: Check that we're not in the /doc subpage
								importTemplateParams( wikitext );
							} ) )
					.append( domObjects.$modalTable )
					.append(
						$( '<button>' )
							.button()
							.text( mw.msg( 'templatedata-modal-button-addparam' ) )
							.addClass( 'tdg-addparam' )
							.click( function () {
								var newParam = addParam(),
									$row = translateParamToRowDom( curr.paramsJson, newParam );

								domObjects.$modalTable.append( $row );
						} )
					);

				domObjects.$modalBox.dialog( {
					autoOpen: false,
					height: $( window ).height() * 0.8,
					width: $( window ).width() * 0.8,
					modal: true,
					buttons: i18nModalButtons(
						mw.msg( 'templatedata-modal-button-apply' ),
						mw.msg( 'templatedata-modal-button-cancel' )
					),
					close: function () {
						domObjects.$modalBox.empty();
					}
				} );

				// Return the modal object
				return domObjects.$modalBox;
			},

			/** Testing functions **/

			/**
			 * @private
			 * @inheritDoc #parseTemplateData
			 */
			parseTemplateData: function ( wikitext ) {
				return parseTemplateData( wikitext );
			},

			/**
			 * @private
			 * @inheritDoc #applyChangesToJSON
			 */
			applyChangesToJSON: function ( originalJsonObject, modalDomElements, doNotCheckForm ) {
				return applyChangeToJSON( originalJsonObject, modalDomElements, doNotCheckForm );
			},

			/**
			 * @private
			 * @inheritDoc #amendWikitext
			 */
			amendWikitext: function ( newJsonObject, originalWikitext ) {
				return amendWikitext( newJsonObject, originalWikitext );
			},

			/**
			 * @private
			 * @inheritDoc #translateParamToRowDom
			 */
			translateParamToRowDom: function ( paramsJson, paramAttrObj ) {
				return translateParamToRowDom( paramsJson, paramAttrObj );
			}

		};
	} )();
}( jQuery, mediaWiki ) );
