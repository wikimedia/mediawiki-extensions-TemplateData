const FavoritesStore = require( './FavoritesStore.js' );

/**
 * @class
 * @extends OO.ui.MenuOptionWidget
 *
 * @constructor
 * @param {Object} config
 * @param {jQuery|string} [config.description=''] Search result description
 * @param {string} [config.data.redirecttitle] Page title for the "redirected from" message
 * @param {FavoritesStore} favoritesStore
 */
function SearchResult( config, favoritesStore ) {
	config = Object.assign( {
		classes: [ 'ext-templatedata-SearchResult' ],
		$label: $( '<a>' )
	}, config );
	SearchResult.super.call( this, config );
	this.favoritesStore = favoritesStore;

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

	this.isFavorite = this.favoritesStore.isFavorite( config.data.pageId );

	this.favoriteButton = new OO.ui.ButtonInputWidget( {
		icon: this.isFavorite ? 'bookmark' : 'bookmarkOutline',
		framed: false,
		invisibleLabel: true,
		type: 'button'
	} );
	this.favoriteButton.connect( this, { click: this.clickFavorite } );
	this.$element.append( this.favoriteButton.$element );

	// Configure non-existing templates.
	if ( config.data.pageId === '-1' ) {
		this.favoriteButton.setDisabled( true );
		this.$label.addClass( 'new' );
	}

	// Don't let temp and anon users favorite.
	if ( !mw.user.isNamed() ) {
		this.favoriteButton.setDisabled( true );
		this.favoriteButton.setTitle( mw.msg( 'templatedata-favorite-disabled' ) );
	}
}

/* Setup */

OO.inheritClass( SearchResult, OO.ui.MenuOptionWidget );

/* Methods */

SearchResult.prototype.clickFavorite = function () {
	if ( !this.isFavorite ) {
		// Add to favorites
		this.favoritesStore.addFavorite( this.data.pageId ).then( () => {
			this.isFavorite = true;
			this.favoriteButton.setIcon( 'bookmark' );
		} );
	} else {
		// Remove from favorites
		this.favoritesStore.removeFavorite( this.data.pageId ).then( () => {
			this.isFavorite = false;
			this.favoriteButton.setIcon( 'bookmarkOutline' );
		} );
	}
};

module.exports = SearchResult;
