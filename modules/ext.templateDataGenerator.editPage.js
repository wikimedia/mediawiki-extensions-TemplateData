( function ( $, mw ) {
	/**
	 * TemplateData Generator button fixture
	 * The button will appear on Template namespaces only, above the edit textbox
	 *
	 * @author Moriel Schottlender
	 */
	'use strict';

	$( document ).ready(function () {
		var tmplDataGen, editboxObjects,
			$textbox = $( '#wpTextbox1' );

		// Check if there's an editor textarea and if we're in the proper namespace
		if ( $textbox.length > 0 && mw.config.get( 'wgCanonicalNamespace' ) === 'Template' ) {

			tmplDataGen = mw.libs.templateDataGenerator;
			editboxObjects = tmplDataGen.init();

			// Add the button and modal element to the document
			$( '#mw-content-text' )
				.prepend(
					editboxObjects.$modalBox,
					editboxObjects.$errorBox,
					editboxObjects.$editButton
				);

			$( '.tdg-editscreen-main-button' ).click( function () {
				var $modalBox = tmplDataGen.createModal( $textbox.val() );

				// open the dialog
				$modalBox.dialog( 'open' );

				// respond to modal close event
				$modalBox.on( 'TemplateDataGeneratorDone', function( e, output ) {
					$textbox.val( output );
				} );
			} );
		}

	} );

}( jQuery, mediaWiki ) );
