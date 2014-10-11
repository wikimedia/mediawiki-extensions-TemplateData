( function ( $, mw ) {
	/**
	 * TemplateData Generator button fixture
	 * The button will appear on Template namespaces only, above the edit textbox
	 *
	 * @author Moriel Schottlender
	 */
	'use strict';

	$( function () {
		var config = {
				isPageSubLevel: false
			},
			$textbox = $( '#wpTextbox1' ),
			pageName = mw.config.get( 'wgPageName' );

		// Check if there's an editor textarea and if we're in the proper namespace
		if ( $textbox.length && mw.config.get( 'wgCanonicalNamespace' ) === 'Template' ) {
			if ( pageName.indexOf( '/' ) > -1 ) {
				config.parentPage = pageName.substr( 0, pageName.indexOf( '/' ) );
				config.isPageSubLevel = pageName.indexOf( '/' ) > -1;
			}

			// Prepare the editor
			mw.libs.tdgUi.init( $( '#mw-content-text' ), $textbox, config );
		}

	} );

}( jQuery, mediaWiki ) );
