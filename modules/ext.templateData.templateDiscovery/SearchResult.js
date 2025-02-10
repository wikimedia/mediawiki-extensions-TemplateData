/**
 * @class
 * @extends OO.ui.MenuOptionWidget
 *
 * @constructor
 * @param {Object} config
 * @param {jQuery|string} [config.description=''] Search result description
 * @param {string} [config.data.redirecttitle] Page title for the "redirected from" message
 */
function SearchResult( config ) {
	SearchResult.super.call( this, config );

	if ( config.data.redirecttitle ) {
		const redirecttitle = new mw.Title( config.data.redirecttitle )
			.getRelativeText( mw.config.get( 'wgNamespaceIds' ).template );
		$( '<div>' )
			.addClass( 'ext-templatedata-search-redirectedfrom' )
			.text( mw.msg( 'redirectedfrom', redirecttitle ) )
			.appendTo( this.$element );
	}

	$( '<span>' )
		.addClass( 'ext-templatedata-search-description' )
		.append( $( '<bdi>' ).text( config.description || '' ) )
		.appendTo( this.$element );
}

OO.inheritClass( SearchResult, OO.ui.MenuOptionWidget );

module.exports = SearchResult;
