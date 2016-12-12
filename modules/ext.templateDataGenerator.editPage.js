( function () {
	/*!
	 * TemplateData Generator button fixture
	 * The button will appear on Template namespaces only, above the edit textbox
	 *
	 * @author Moriel Schottlender
	 */
	'use strict';

	/* global ve */

	$( function () {
		var pieces, isDocPage, target,
			pageName = mw.config.get( 'wgPageName' ),
			config = {
				pageName: pageName,
				isPageSubLevel: false
			},
			$textbox = $( '#wpTextbox1' );

		// Check if we're in the proper namespace
		if ( mw.config.get( 'wgCanonicalNamespace' ) !== 'Template' ) {
			return;
		}

		pieces = pageName.split( '/' );
		isDocPage = pieces.length > 1 && pieces[ pieces.length - 1 ] === 'doc';

		config = {
			pageName: pageName,
			isPageSubLevel: pieces.length > 1,
			parentPage: pageName,
			isDocPage: isDocPage
		};

		// Only if we are in a doc page do we set the parent page to
		// the one above. Otherwise, all parent pages are current pages
		if ( isDocPage ) {
			pieces.pop();
			config.parentPage = pieces.join( '/' );
		}

		// Textbox wikitext editor
		if ( $textbox.length ) {
			// Prepare the editor
			target = new mw.TemplateData.TextareaTarget( $textbox, config );
			$( '#mw-content-text' ).prepend( target.$element );
		}
		// Visual editor source mode
		mw.hook( 've.activationComplete' ).add( function () {
			var surface = ve.init.target.getSurface();
			if ( surface.getMode() === 'source' ) {
				target = new mw.TemplateData.VETarget( surface, config );
				$( '.ve-init-mw-desktopArticleTarget-originalContent' ).prepend( target.$element );
			}
		} );
		mw.hook( 've.deactivate' ).add( function () {
			if ( target ) {
				target.destroy();
				target = null;
			}
		} );

	} );

}() );
