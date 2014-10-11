( function ( $, mw ) {
	/**
	 * TemplateData Generator data model.
	 * This singleton is independent of any UI; it expects
	 * a templatedata string, converts it into the object
	 * model and manages it, fully event-driven.
	 *
	 * @author Moriel Schottlender
	 */
	'use strict';
	mw.libs.tdgUi = ( function () {
		var isPageSubLevel,
			parentPage,
			$textbox,
			/**
			 * ooui Window Manager
			 */
			tdgDialog,
			windowManager,
			/**
			 * Edit window elements
			 */
			editOpenDialogButton,
			editNoticeLabel,

		editArea = {
			/**
			 * Display error message in the edit window
			 * @param {string} msg Message to display
			 * @param {string} type Message type 'notice' or 'error'
			 */
			setNoticeMessage: function ( msg, type ) {
				type = type || 'error';
				editNoticeLabel.$element.toggleClass( 'errorbox', type === 'error' );

				editNoticeLabel.setLabel( msg );
				editNoticeLabel.$element.show();
			},

			/**
			 * Reset the error message in the edit window
			 */
			resetNoticeMessage: function () {
				editNoticeLabel.setLabel( '' );
				editNoticeLabel.$element.hide();
			}
		},

		/**
		 * Respond to edit dialog button click.
		 */
		onEditOpenDialogButton = function () {
			// Reset notice message
			editArea.resetNoticeMessage();
			// Open the dialog
			windowManager.openWindow( tdgDialog, {
				wikitext: $textbox.val(),
				config: {
					parentPage: parentPage,
					isPageSubLevel: !!isPageSubLevel
				}
			} );
		},

		/**
		 * Respond to edit dialog apply event
		 * @param {string} templateDataString New templatedata string
		 */
		onDialogApply = function ( templateDataString ) {
			$textbox.val( replaceTemplateData( templateDataString ) );
		},

		/**
		 * Replace the old templatedata string with the new one, or
		 * insert the new one into the page if an old one doesn't exist
		 * @param {string} newTemplateData New templatedata string
		 * @return {string} Full wikitext content with the new templatedata
		 *  string.
		 */
		replaceTemplateData = function ( newTemplateData ) {
			var finalOutput,
				fullWikitext = $textbox.val(),
				parts = fullWikitext.match(
					/<templatedata>([\s\S]*?)<\/templatedata>/i
				);

			if ( parts && parts[1] ) {
				// <templatedata> exists. Replace it
				finalOutput = fullWikitext.replace(
					/(<templatedata>)([\s\S]*?)(<\/templatedata>)/i,
					'<templatedata>\n' + newTemplateData + '\n</templatedata>'
				);
			} else {
				if ( isPageSubLevel ) {
					// Add the <templatedata>
					finalOutput = fullWikitext + '\n<templatedata>\n' +
						newTemplateData +
						'\n</templatedata>\n';
				} else {
					// If we are not in a subpage, add <noinclude> tags
					finalOutput = fullWikitext + '\n<noinclude>\n<templatedata>\n' +
						newTemplateData +
						'\n</templatedata>\n</noinclude>\n';
				}
			}
			return finalOutput;
		};

		return {
			/**
			 * Initialize UI
			 * @param {jQuery} $container The container to attach UI buttons to
			 * @param {jQuery} $editorTextbox The editor textbox to take the
			 *  current wikitext from.
			 */
			init: function ( $container, $editorTextbox, userConfig ) {
				var editHelpButtonWidget,
					config = userConfig;

				$textbox = $editorTextbox;

				parentPage = config.parentPage;
				isPageSubLevel = !!config.isPageSubLevel;

				editOpenDialogButton = new OO.ui.ButtonWidget( {
					label: mw.msg( 'templatedata-editbutton' )
				} );

				editNoticeLabel = new OO.ui.LabelWidget( {
					classes: [ 'tdg-editscreen-error-msg' ]
				} )
					.toggle( false );

				editHelpButtonWidget = new OO.ui.ButtonWidget( {
					label: mw.msg( 'templatedata-helplink' ),
					classes: [ 'tdg-editscreen-main-helplink' ],
					href: 'https://www.mediawiki.org/wiki/Extension:TemplateData',
					target: '_blank',
					framed: false
				} );

				// Dialog
				windowManager = new OO.ui.WindowManager();
				tdgDialog = new TemplateDataDialog( config );
				windowManager.addWindows( [ tdgDialog ] );

				// Prepend to container
				$container
					.prepend(
						$( '<div>' )
							.addClass( 'tdg-editscreen-main' )
							.append(
								editOpenDialogButton.$element,
								editHelpButtonWidget.$element,
								editNoticeLabel.$element
							)
					);
				$( 'body' )
					.append( windowManager.$element );

				// UI events
				editOpenDialogButton.connect( this, { click: onEditOpenDialogButton } );

				tdgDialog.connect( this, {
					apply: onDialogApply
				} );
			}
		};
	}() );
}( jQuery, mediaWiki ) );
