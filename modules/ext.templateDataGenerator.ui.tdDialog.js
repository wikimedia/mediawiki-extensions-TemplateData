	( function ( mw ) {
	/**
	 * TemplateData Dialog
	 * @param {Object} config Dialog configuration object
	 */
	TemplateDataDialog = function TemplateDataDialog( config ) {
		// Parent constructor
		TemplateDataDialog.super.call( this, config );

		this.model = null;
		this.language = null;
		this.availableLanguages = [];
		this.selectedParamKey = '';
		this.propInputs = {};
		this.propFieldLayout = {};

		// Initialize
		this.$element.addClass( 'tdg-TemplateDataDialog' );
	};

	OO.inheritClass( TemplateDataDialog, OO.ui.ProcessDialog );

	/* Static properties */
	TemplateDataDialog.static.name = 'TemplateDataDialog';
	TemplateDataDialog.static.title = mw.msg( 'templatedata-modal-title' );
	TemplateDataDialog.static.size = 'large';
	TemplateDataDialog.static.actions = [
		{
			action: 'apply',
			label: mw.msg( 'templatedata-modal-button-apply' ),
			flags: [ 'primary', 'constructive' ],
			modes: 'list'
		},
		{
			action: 'add',
			label: mw.msg( 'templatedata-modal-button-addparam' ),
			flags: [ 'constructive' ],
			modes: 'list'
		},
		{
			action: 'delete',
			label: mw.msg( 'templatedata-modal-button-delparam' ),
			modes: 'edit',
			flags: 'destructive'
		},
		{
			label: mw.msg( 'templatedata-modal-button-cancel' ),
			flags: 'safe',
			modes: [ 'list', 'error' ]
		},
		{
			action: 'back',
			label: mw.msg( 'templatedata-modal-button-back' ),
			flags: 'safe',
			modes: [ 'edit', 'language', 'add' ]
		}
	];

	/**
	 * @inheritDoc
	 */
	TemplateDataDialog.prototype.initialize = function () {
		var templateParamsFieldset, languageFieldset,
			addParamFieldlayout, languageFieldLayout,
			paramOrderFieldset;

		// Parent method
		TemplateDataDialog.super.prototype.initialize.call( this );

		this.$spinner = this.$( '<div>' ).addClass( 'tdg-spinner' ).text( 'working...' );
		this.$body.append( this.$spinner );

		this.noticeLabel = new OO.ui.LabelWidget( { $: this.$ } );
		this.noticeLabel.$element.hide();

		this.panels = new OO.ui.StackLayout( { $: this.$, continuous: false } );

		this.listParamsPanel = new OO.ui.PanelLayout( {
			$: this.$,
			scrollable: true
		} );
		this.editParamPanel = new OO.ui.PanelLayout( {
			$: this.$
		} );
		this.languagePanel = new OO.ui.PanelLayout( {
			$: this.$
		} );
		this.addParamPanel = new OO.ui.PanelLayout( {
			$: this.$
		} );

		// Language panel
		this.newLanguageSearchWidget = new TemplateDataLanguageSearchWidget( {
			$: this.$
		} );

		// Add parameter panel
		this.newParamInput = new OO.ui.TextInputWidget( {
			$: this.$,
			placeholder: mw.msg( 'templatedata-modal-placeholder-paramkey' )
		} );
		this.addParamButton = new OO.ui.ButtonWidget( {
			$: this.$,
			label: mw.msg( 'templatedata-modal-button-addparam' )
		} );
		addParamFieldlayout = new OO.ui.FieldsetLayout( {
			$: this.$,
			label: mw.msg( 'templatedata-modal-title-addparam' ),
			items: [ this.newParamInput, this.addParamButton ]
		} );

		// Param list panel (main)
		this.languageDropdownWidget = new OO.ui.DropdownWidget( { $: this.$ } );
		this.languagePanelButton = new OO.ui.ButtonWidget( {
			$: this.$,
			label: mw.msg( 'templatedata-modal-button-add-language' )
		} );
		languageFieldLayout = new OO.ui.FieldLayout( this.languageDropdownWidget, {
			$: this.$,
			align: 'left',
			label: mw.msg( 'templatedata-modal-title-language' )
		} );
		languageFieldset = new OO.ui.FieldsetLayout( {
			$: this.$,
			items: [ languageFieldLayout, this.languagePanelButton ]
		} );

		// ParamOrder
		this.paramOrderWidget = new TemplateDataDragDropWidget( {
			$: this.$,
			orientation: 'horizontal'
		} );
		paramOrderFieldset = new OO.ui.FieldsetLayout( {
			$: this.$,
			label: mw.msg( 'templatedata-modal-title-paramorder' ),
			items: [ this.paramOrderWidget ]
		} );

		this.descriptionInput = new OO.ui.TextInputWidget( {
			$: this.$,
			multiline: true,
			autosize: true
		} );
		this.templateDescriptionFieldset = new OO.ui.FieldsetLayout( {
			$: this.$,
			items: [ this.descriptionInput ]
		} );
		this.paramListNoticeLabel = new OO.ui.LabelWidget( { $: this.$ } );
		this.paramListNoticeLabel.$element.hide();

		this.paramSelectWidget = new OO.ui.SelectWidget();
		templateParamsFieldset = new OO.ui.FieldsetLayout( {
			$: this.$,
			label: mw.msg( 'templatedata-modal-title-templateparams' )
		} );
		templateParamsFieldset.$element.append( this.paramSelectWidget.$element );

		// Param details panel
		this.$paramDetailsContainer = this.$( '<div>' )
			.addClass( 'tdg-TemplateDataDialog-paramDetails' );

		this.listParamsPanel.$element
			.addClass( 'tdg-templateDataDialog-listParamsPanel' )
			.append(
				this.paramListNoticeLabel.$element,
				languageFieldset.$element,
				this.templateDescriptionFieldset.$element,
				paramOrderFieldset.$element,
				templateParamsFieldset.$element
			);
		this.paramEditNoticeLabel = new OO.ui.LabelWidget( { $: this.$ } );
		this.paramEditNoticeLabel.$element.hide();
		// Edit panel
		this.editParamPanel.$element
			.addClass( 'tdg-templateDataDialog-editParamPanel' )
			.append(
				this.paramEditNoticeLabel.$element,
				this.$paramDetailsContainer
			);
		// Language panel
		this.languagePanel.$element
			.addClass( 'tdg-templateDataDialog-languagePanel' )
			.append(
				this.newLanguageSearchWidget.$element
			);
		this.addParamPanel.$element
			.addClass( 'tdg-templateDataDialog-addParamPanel' )
			.append( addParamFieldlayout.$element );

		this.panels.addItems( [
			this.listParamsPanel,
			this.editParamPanel,
			this.languagePanel,
			this.addParamPanel
		] );
		this.panels.setItem( this.listParamsPanel );
		this.panels.$element.addClass( 'tdg-TemplateDataDialog-panels' );

		// Build param details panel
		this.$paramDetailsContainer.append( this.createParamDetails() );

		// Initialization
		this.$body.append(
			this.noticeLabel.$element,
			this.panels.$element
		);

		// Events
		this.newLanguageSearchWidget.connect( this, { select: 'newLanguageSearchWidgetSelect' } );
		this.newParamInput.connect( this, { change: 'onAddParamInputChange' } );
		this.addParamButton.connect( this, { click: 'onAddParamButtonClick' } );
		this.descriptionInput.connect( this, { change: 'onDescriptionInputChange' } );
		this.paramOrderWidget.connect( this, { reorder: 'onParamOrderWidgetReorder' } );
		this.languagePanelButton.connect( this, { click: 'onLanguagePanelButton' } );
		this.languageDropdownWidget.getMenu().connect( this, { choose: 'onLanguageDropdownWidgetChoose' } );
		this.paramSelectWidget.connect( this, { choose: 'onParamSelectWidgetChoose' } );
	};

	/**
	 * Respond to model change of description event
	 * @param {jQuery.event} event Event details
	 * @param {string} description New description
	 */
	TemplateDataDialog.prototype.onModelChangeDescription = function ( description ) {
		this.descriptionInput.setValue( description );
	};

	TemplateDataDialog.prototype.onAddParamInputChange = function ( value ) {
		if ( this.model.isParamExists( value ) && !this.model.isParamDeleted( value ) ) {
			// Disable the add button
			this.addParamButton.setDisabled( true );
		} else {
			this.addParamButton.setDisabled( false );
		}
	};

	/**
	 * Respond to change of paramOrder from the model
	 * @param {string[]} paramOrderArray The array of keys in order
	 */
	TemplateDataDialog.prototype.onModelChangeParamOrder = function ( paramOrderArray ) {
		var i,
			items = [];

		this.paramOrderWidget.clearItems();
		for ( i = 0; i < paramOrderArray.length; i++ ) {
			items.push(
				new TemplateDataDragDropItemWidget( {
					$: this.$,
					data: paramOrderArray[i],
					label: paramOrderArray[i]
				} )
			);
		}
		this.paramOrderWidget.addItems( items );

		// Refresh the parameter widget
		this.repopulateParamSelectWidget();
	};

	/**
	 * Respond to an addition of a key to the model paramOrder
	 * @param {string} key Added key
	 */
	TemplateDataDialog.prototype.onModelAddKeyParamOrder = function ( key ) {
		var dragItem = new TemplateDataDragDropItemWidget( {
			$: this.$,
			data: key,
			label: key
		} );
		this.paramOrderWidget.addItems( [ dragItem ] );
	};

	TemplateDataDialog.prototype.onParamOrderWidgetReorder = function ( item, newIndex ) {
		this.model.reorderParamOrderKey( item.getData(), newIndex );
	};

	/**
	 * Respond to description input change event
	 */
	TemplateDataDialog.prototype.onDescriptionInputChange = function ( value ) {
		if ( this.model.getTemplateDescription() !== value ) {
			this.model.setTemplateDescription( value, this.language );
		}
	};

	/**
	 * Respond to add language button click
	 */
	TemplateDataDialog.prototype.onLanguagePanelButton = function () {
		this.switchPanels( 'language' );
	};

	/**
	 * Respond to language select widget choose event
	 * @param {OO.ui.OptionWidget} item Chosen item
	 */
	TemplateDataDialog.prototype.onLanguageDropdownWidgetChoose = function ( item ) {
		var language = item ? item.getData() : this.language;

		// Change current language
		if ( language !== this.language ) {
			this.language = language;

			// Update description label
			this.templateDescriptionFieldset.setLabel( mw.msg( 'templatedata-modal-title-templatedesc', this.language ) );

			// Update description value
			this.descriptionInput.setValue( this.model.getTemplateDescription( language ) );

			// Update all param descriptions in the param select widget
			this.repopulateParamSelectWidget();

			// Update the parameter detail page
			this.updateParamDetailsLanguage( this.language );

			this.emit( 'change-language', this.language );
		}
	};

	/**
	 * Respond to add language button
	 * @param {Object} data Data from the selected option widget
	 */
	TemplateDataDialog.prototype.newLanguageSearchWidgetSelect = function ( data ) {
		var languageButton,
			newLanguage = data.code;

		if (
			newLanguage &&
			$.inArray( newLanguage, this.availableLanguages ) === -1
		) {
			// Add new language
			this.availableLanguages.push( newLanguage );
			languageButton = new OO.ui.OptionWidget( {
				data: newLanguage,
				$: this.$,
				label: $.uls.data.getAutonym( newLanguage )
			} );
			this.languageDropdownWidget.getMenu().addItems( [ languageButton ] );
		}
		// Go to the main panel
		this.switchPanels( 'listParams' );
	};

	/**
	 * Respond to add parameter button
	 */
	TemplateDataDialog.prototype.onAddParamButtonClick = function () {
		var newParamKey = this.newParamInput.getValue(),
			allProps = TemplateDataModel.static.getAllProperties( true );

		// Validate parameter
		if (
			!newParamKey.match( allProps.name.restrict ) &&
			this.model.isParamExists( newParamKey )
		) {
			if ( this.model.isParamDeleted( newParamKey ) ) {
				// Empty param
				this.model.emptyParamData( newParamKey );
			} else {
				// Add to model
				if ( this.model.addParam( newParamKey ) ) {
					// Add parameter to list
					this.addParamToSelectWidget( newParamKey );
				}
			}
		}
		// Reset the input
		this.newParamInput.setValue( '' );

		// Go back to list
		this.switchPanels( 'listParams' );
	};

	/**
	 * Respond to choose event from the param select widget
	 * @param {OO.ui.OptionWidget} item Parameter item
	 */
	TemplateDataDialog.prototype.onParamSelectWidgetChoose = function ( item ) {
		var paramKey = item.getData();

		if ( paramKey === 'tdg-importParameters' ) {
			// Import
			this.importParametersFromTemplateCode();
		} else {
			this.selectedParamKey = paramKey;

			// Fill in parameter detail
			this.getParameterDetails( paramKey );
			this.switchPanels( 'editParam' );
		}
	};

	TemplateDataDialog.prototype.onParamPropertyInputChange = function ( property, value ) {
		var err = false,
			anyInputError = false,
			allProps = TemplateDataModel.static.getAllProperties( true );

		if ( property === 'type' ) {
			value = this.propInputs[property].getMenu().getSelectedItem() ? this.propInputs[property].getMenu().getSelectedItem().getData() : 'undefined';
		}

		// TODO: Validate the name
		if ( allProps[property].restrict ) {
			if ( value.match( allProps[property].restrict ) ) {
				// Error! Don't fix the model
				err = true;
				this.toggleNoticeMessage( 'edit', true, 'error', mw.msg( 'templatedata-modal-errormsg', '|', '=', '}}' ) );
			} else {
				this.toggleNoticeMessage( 'edit', false );
			}
		}

		this.propInputs[property].$element.toggleClass( 'tdg-editscreen-input-error', err );

		// Validate
		$( '.tdg-TemplateDataDialog-paramInput' ).each( function () {
			if ( $( this ).hasClass( 'tdg-editscreen-input-error' ) ) {
				anyInputError = true;
			}
		} );
		// Disable the 'back' button if there are any errors in the inputs
		this.actions.setAbilities( { back: !anyInputError } );
		if ( !err ) {
			this.model.setParamProperty( this.selectedParamKey, property, value, this.language );
		}
	};

	/**
	 * Set the parameter details in the detail panel.
	 * @param {Object} paramKey Parameter details
	 */
	TemplateDataDialog.prototype.getParameterDetails = function ( paramKey ) {
		var prop,
			paramData = this.model.getParamData( paramKey );

		for ( prop in this.propInputs ) {
			this.changeParamPropertyInput( paramKey, prop, paramData[prop], this.language );
		}
	};

	/**
	 * Reset contents on reload
	 */
	TemplateDataDialog.prototype.reset = function () {
		this.language = null;
		this.availableLanguages = [];
		if ( this.paramSelectWidget ) {
			this.paramSelectWidget.clearItems();
			this.selectedParamKey = '';
		}

		if ( this.languageDropdownWidget ) {
			this.languageDropdownWidget.getMenu().clearItems();
		}
	};

	/**
	 * Empty and repopulate the parameter select widget.
	 */
	TemplateDataDialog.prototype.repopulateParamSelectWidget = function () {
		var i, paramKey,
			missingParams = this.model.getMissingParams(),
			paramList = this.model.getParams(),
			paramOrder = this.model.getTemplateParamOrder();

		this.paramSelectWidget.clearItems();

		// Update all param descriptions in the param select widget
		for ( i in paramOrder ) {
			paramKey = paramList[paramOrder[i]];
			if ( paramKey && !paramKey.deleted ) {
				this.addParamToSelectWidget( paramOrder[i] );
			}
		}

		// Check if there are potential parameters to add
		// from the template source code
		if ( missingParams.length > 0 ) {
			// Add a final option
			this.paramSelectWidget.addItems( [
				new TemplateDataOptionImportWidget( {
					data: 'tdg-importParameters',
					$: this.$,
					params: missingParams
				} )
			] );
		}
	};

	/**
	 * Change parameter property
	 * @param {string} paramKey Parameter key
	 * @param {string} propName Property name
	 * @param {string} propVal Property value
	 * @param {string} [lang] Language
	 */
	TemplateDataDialog.prototype.changeParamPropertyInput = function ( paramKey, propName, value, lang ) {
		var languageProps = TemplateDataModel.static.getPropertiesWithLanguage(),
			allProps = TemplateDataModel.static.getAllProperties( true ),
			prop = allProps[propName],
			propInput = typeof this.propInputs[propName].getMenu === 'function' ?
				this.propInputs[propName].getMenu() : this.propInputs[propName];

		lang = lang || this.language;

		if ( value !== undefined ) {
			// Change the actual input
			if ( prop.type === 'select' ) {
				propInput.selectItem( propInput.getItemFromData( value ) );
			} else if ( prop.type === 'boolean' ) {
					propInput.setValue( !!value );
			} else {
				if ( $.inArray( propName, languageProps ) !== -1 ) {
					propInput.setValue( value[lang] );
				} else {
					if ( prop.type === 'array' && $.type( value ) === 'array' ) {
						value = value.join( prop.delimiter );
					}
					propInput.setValue( value );
				}
			}
		} else {
			// Empty the input
			if ( prop.type === 'select' ) {
				propInput.selectItem( propInput.getItemFromData( prop['default'] ) );
			} else {
				propInput.setValue( '' );
			}
		}
	};

	/**
	 * Add parameter to the list
	 * @param {string} paramKey Parameter key in the model
	 * @param {Object} paramData Parameter data
	 */
	TemplateDataDialog.prototype.addParamToSelectWidget = function ( paramKey ) {
		var paramItem,
			data = this.model.getParamData( paramKey );

		paramItem = new TemplateDataOptionWidget( {
			data: {
				key: paramKey,
				name: data.name,
				aliases: data.aliases,
				description: this.model.getParamDescription( paramKey, this.language )
			},
			$: this.$
		} );

		this.paramSelectWidget.addItems( [ paramItem ] );
	};

	/**
	 * Create the information page about individual parameters
	 * @returns {jQuery} Editable details page for the parameter
	 */
	TemplateDataDialog.prototype.createParamDetails = function () {
		var props, type, propInput, config, paramProperties,
			paramFieldset,
			typeItemArray = [];

		paramProperties = TemplateDataModel.static.getAllProperties( true );

		// Fieldset
		paramFieldset = new OO.ui.FieldsetLayout( {
			$: this.$
		} );

		for ( props in paramProperties ) {
			config = {
				$: this.$,
				multiline: paramProperties[props].multiline
			};
			if ( paramProperties[props].multiline ) {
				config.autosize = true;
			}
			// Create the property inputs
			switch ( props ) {
				case 'type':
					propInput = new OO.ui.DropdownWidget( config );
					for ( type in paramProperties[props].children ) {
						typeItemArray.push( new OO.ui.OptionWidget( {
							data: paramProperties[props].children[type],
							$: this.$,
							label: mw.msg( 'templatedata-modal-table-param-type-' + paramProperties[props].children[type] )
						} ) );
					}
					propInput.getMenu().addItems( typeItemArray );
					break;
				case 'deprecated':
				case 'required':
				case 'suggested':
					propInput = new OO.ui.ToggleSwitchWidget( config );
					break;
				default:
					propInput = new OO.ui.TextInputWidget( config );
					break;
			}

			this.propInputs[props] = propInput;

			propInput.$element
				.addClass( 'tdg-TemplateDataDialog-paramInput tdg-TemplateDataDialog-paramList-' + props );

			this.propFieldLayout[props] = new OO.ui.FieldLayout( propInput, {
				align: 'left',
				label: mw.msg( 'templatedata-modal-table-param-' + props )
			} );
			// Event
			if ( props === 'type' ) {
				propInput.getMenu().connect( this, { choose: [ 'onParamPropertyInputChange', props ] } );
			} else {
				propInput.connect( this, { change: [ 'onParamPropertyInputChange', props ] } );
			}
			// Append to parameter section
			paramFieldset.$element.append( this.propFieldLayout[props].$element );
		}
		// Update parameter property fields with languages
		this.updateParamDetailsLanguage( this.language );
		return paramFieldset.$element;
	};

	/**
	 * Update the labels for parameter property inputs that include language, so
	 * they show the currently used language.
	 * @param {string} [lang] Language. If not used, will use currently defined
	 *  language.
	 */
	TemplateDataDialog.prototype.updateParamDetailsLanguage = function ( lang ) {
		var i, prop, label,
			languageProps = TemplateDataModel.static.getPropertiesWithLanguage();
		lang = lang || this.language;

		for ( i = 0; i < languageProps.length; i++ ) {
			prop = languageProps[i];
			label = mw.msg( 'templatedata-modal-table-param-' + prop, lang );
			this.propFieldLayout[prop].setLabel( label );
		}
	};

	/**
	 * Override getBodyHeight to create a tall dialog relative to the screen.
	 * @return {number} Body height
	 */
	TemplateDataDialog.prototype.getBodyHeight = function () {
		return window.innerHeight - 200;
	};

	/**
	 * Show or hide the notice message in the dialog with a set message.
	 * @param {string} type Which notice label to show: 'list' or 'global'
	 * @param {Boolean} isShowing Show or hide the message
	 * @param {string} status Message status 'error' or 'success'
	 * @param {string|string[]} noticeMessage The message to display
	 */
	TemplateDataDialog.prototype.toggleNoticeMessage = function ( type, isShowing, status, noticeMessage ) {
		var noticeReference,
			$message;

		type = type || 'list';

		// Hide all
		this.noticeLabel.$element.hide();
		this.paramEditNoticeLabel.$element.hide();
		this.paramListNoticeLabel.$element.hide();

		if ( noticeMessage ) {
			// See which error to display
			if ( type === 'global' ) {
				noticeReference = this.noticeLabel;
			} else if ( type === 'edit' ) {
				noticeReference = this.paramEditNoticeLabel;
			} else {
				noticeReference = this.paramListNoticeLabel;
			}
			isShowing = isShowing || !noticeReference.$element.is( ':visible' );

			if ( $.type( noticeMessage ) === 'array' ) {
				$message = $( '<div>' );
				$.each( noticeMessage, function ( i, msg ) {
					$message.append( $( '<p>' ).text( msg ) );
				} );
				noticeReference.setLabel( $message );
			} else {
				noticeReference.setLabel( noticeMessage );
			}
			noticeReference.$element
				.toggle( isShowing )
				.toggleClass( 'errorbox', status === 'error' )
				.toggleClass( 'successbox', status === 'success' );
		}
	};

	/**
	 * Import parameters from the source code.
	 */
	TemplateDataDialog.prototype.importParametersFromTemplateCode = function () {
		var combinedMessage = [],
			state = 'success',
			response = this.model.importSourceCodeParameters();
		// Repopulate the list
		this.repopulateParamSelectWidget();

		if ( response.existing.length > 0 ) {
			combinedMessage.push( mw.msg( 'templatedata-modal-errormsg-import-paramsalreadyexist', response.existing.join( mw.msg( 'comma-separator' ) ) ) );
		}

		if ( response.imported.length === 0 ) {
			combinedMessage.push( mw.msg( 'templatedata-modal-errormsg-import-noparams' ) );
			state = 'error';
		} else {
			combinedMessage.push( mw.msg( 'templatedata-modal-notice-import-numparams', response.imported.length, response.imported.join( mw.msg( 'comma-separator' ) ) ) );
		}

		this.toggleNoticeMessage( 'list', true, state, combinedMessage );
	};

	/**
	 * @inheritDoc
	 */
	TemplateDataDialog.prototype.getSetupProcess = function ( data ) {
		return TemplateDataDialog.super.prototype.getSetupProcess.call( this, data )
			.next( function () {
				// Hide the panels and display a spinner
				this.$spinner.show();
				this.panels.$element.hide();
				this.toggleNoticeMessage( 'global', false );
				this.toggleNoticeMessage( 'list', false );
				this.reset();

				// Start with parameter list
				this.switchPanels( 'listParams' );
				this.model = new TemplateDataModel( data.config );

				// Events
				this.model.connect( this, {
					'change-description': 'onModelChangeDescription',
					'change-paramOrder': 'onModelChangeParamOrder',
					'add-paramOrder': 'onModelAddKeyParamOrder'
				} );

				// Load the model according to the string
				this.model.loadModel( data.wikitext )
					.done( $.proxy( function () {
						var i,
							language = this.model.getDefaultLanguage(),
							languageItems = [],
							languages = this.model.getExistingLanguageCodes();

						this.setupDetailsFromModel();

						// Fill up the language selection
						if (
							languages.length === 0 ||
							$.inArray( language, languages ) === -1
						) {
							// Add the default language
							languageItems.push( new OO.ui.OptionWidget( {
								data: language,
								$: this.$,
								label: $.uls.data.getAutonym( language )
							} ) );
							this.availableLanguages.push( language );
						}

						// Add all available languages
						for ( i = 0; i < languages.length; i++ ) {
							languageItems.push( new OO.ui.OptionWidget( {
								data: languages[i],
								$: this.$,
								label: $.uls.data.getAutonym( languages[i] )
							} ) );
							// Store available languages
							this.availableLanguages.push( languages[i] );
						}
						this.languageDropdownWidget.getMenu().addItems( languageItems );
						// Trigger the initial language choice
						this.languageDropdownWidget.getMenu().chooseItem( this.languageDropdownWidget.getMenu().getItemFromData( language ) );

						// Show the panel
						this.$spinner.hide();
						this.panels.$element.show();
					}, this ) )
					.fail( $.proxy( function () {
						// Show error
						this.actions.setMode( 'error' );
						this.$spinner.hide();
						this.toggleNoticeMessage( 'global', true, 'error', mw.msg( 'templatedata-errormsg-jsonbadformat' ) );
					}, this ) );

			}, this );
	};

	/**
	 * Set up the list of parameters from the model. This should happen
	 * after initialization of the model.
	 */
	TemplateDataDialog.prototype.setupDetailsFromModel = function () {
		// Reset parameter list
		this.reset();

		// Set up description
		this.descriptionInput.setValue( this.model.getTemplateDescription( this.language ) );
		// TODO: Set up paramOrder

		this.repopulateParamSelectWidget();
	};

	/**
	 * Switch between stack layout panels
	 * @param {string} panel Panel key to switch to
	 */
	TemplateDataDialog.prototype.switchPanels = function ( panel ) {
		switch ( panel ) {
			case 'listParams':
				this.actions.setMode( 'list' );
				this.panels.setItem( this.listParamsPanel );
				// Reset message
				this.toggleNoticeMessage( 'list', false );
				// Deselect parameter
				this.paramSelectWidget.selectItem( null );
				// Repopulate the list to account for any changes
				if ( this.model ) {
					this.repopulateParamSelectWidget();
				}
				// Hide/show panels
				this.listParamsPanel.$element.show();
				this.editParamPanel.$element.hide();
				this.addParamPanel.$element.hide();
				this.languagePanel.$element.hide();
				break;
			case 'editParam':
				this.actions.setMode( 'edit' );
				this.panels.setItem( this.editParamPanel );
				// Deselect parameter
				this.paramSelectWidget.selectItem( null );
				// Hide/show panels
				this.listParamsPanel.$element.hide();
				this.languagePanel.$element.hide();
				this.addParamPanel.$element.hide();
				this.editParamPanel.$element.show();
				break;
			case 'addParam':
				this.actions.setMode( 'add' );
				this.panels.setItem( this.addParamPanel );
				// Hide/show panels
				this.listParamsPanel.$element.hide();
				this.editParamPanel.$element.hide();
				this.languagePanel.$element.hide();
				this.addParamPanel.$element.show();
				break;
			case 'language':
				this.actions.setMode( 'language' );
				this.panels.setItem( this.languagePanel );
				// Hide/show panels
				this.listParamsPanel.$element.hide();
				this.editParamPanel.$element.hide();
				this.addParamPanel.$element.hide();
				this.languagePanel.$element.show();
				break;
		}
	};

	/**
	 * @inheritDoc
	 */
	TemplateDataDialog.prototype.getActionProcess = function ( action ) {
		if ( action === 'back' ) {
			return new OO.ui.Process( function () {
				this.switchPanels( 'listParams' );
			}, this );
		}
		if ( action === 'add' ) {
			return new OO.ui.Process( function () {
				this.switchPanels( 'addParam' );
			}, this );
		}
		if ( action === 'delete' ) {
			return new OO.ui.Process( function () {
				this.model.deleteParam( this.selectedParamKey );
				this.switchPanels( 'listParams' );
			}, this );
		}
		if ( action === 'apply' ) {
			return new OO.ui.Process( function () {
				this.emit( 'apply', this.model.outputTemplateDataString() );
				this.close( { action: action } );
			}, this );
		}
		// Fallback to parent handler
		return TemplateDataDialog.super.prototype.getActionProcess.call( this, action );
	};
}( mediaWiki ) );
