const FavoritesStore = require( './FavoritesStore.js' );
const FavoriteButton = require( './FavoriteButton.js' );

/**
 * @class
 * @extends OO.ui.MenuOptionWidget
 *
 * @constructor
 * @param {Object} config
 * @param {string} config.data.title Page title of the template
 * @param {jQuery|string} [config.description=''] Search result description
 * @param {string} [config.data.redirecttitle] Page title for the "redirected from" message
 * @param {FavoritesStore} favoritesStore
 */
function TemplateMenuItem( config, favoritesStore ) {
	config = Object.assign( {
		classes: [ 'ext-templatedata-TemplateMenuItem' ],
		$label: $( '<a>' )
	}, config );
	TemplateMenuItem.super.call( this, config );

	if ( config.data.redirecttitle ) {
		const redirecttitle = new mw.Title( config.data.redirecttitle )
			.getRelativeText( mw.config.get( 'wgNamespaceIds' ).template );
		$( '<span>' )
			.addClass( 'ext-templatedata-search-redirectedfrom' )
			.text( mw.msg( 'redirectedfrom', redirecttitle ) )
			.appendTo( this.$element );
	}
	this.$label.attr( 'href', mw.util.getUrl( config.data.title ) );

	$( '<span>' )
		.addClass( 'ext-templatedata-search-description' )
		.append( $( '<bdi>' ).text( config.description || '' ) )
		.appendTo( this.$element );

	// Add a wrapper element so that the button and the other elements are in separate containers.
	const $wrap = $( '<span>' );
	$wrap.append( this.$element.contents() );
	this.$element.append( $wrap );

	const favoriteButton = new FavoriteButton( {
		favoritesStore: favoritesStore,
		pageId: config.data.pageId
	} );
	this.$element.append( favoriteButton.$element );

	// Configure non-existing templates.
	if ( config.data.pageId === '-1' ) {
		favoriteButton.setDisabled( true );
		this.$label.addClass( 'new' );
	}
}

/* Setup */

OO.inheritClass( TemplateMenuItem, OO.ui.MenuOptionWidget );

module.exports = TemplateMenuItem;
