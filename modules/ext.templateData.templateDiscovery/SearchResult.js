const FavouritesStore = require( './FavouritesStore.js' );

/**
 * @class
 * @extends OO.ui.MenuOptionWidget
 *
 * @constructor
 * @param {Object} config
 * @param {jQuery|string} [config.description=''] Search result description
 * @param {string} [config.data.redirecttitle] Page title for the "redirected from" message
 * @param {FavouritesStore} favouritesStore
 */
function SearchResult( config, favouritesStore ) {
	config = Object.assign( {
		classes: [ 'ext-templatedata-SearchResult' ],
		$label: $( '<a>' )
	}, config );
	SearchResult.super.call( this, config );
	this.favouritesStore = favouritesStore;

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

	this.isFavourite = this.favouritesStore.isFavourite( config.data.pageId );

	this.favouriteButton = new OO.ui.ButtonInputWidget( {
		icon: this.isFavourite ? 'bookmark' : 'bookmarkOutline',
		framed: false,
		invisibleLabel: true,
		type: 'button'
	} );
	this.favouriteButton.connect( this, { click: this.clickFavourite } );
	this.$element.append( this.favouriteButton.$element );

	// Configure non-existing templates.
	if ( config.data.pageId === '-1' ) {
		this.favouriteButton.setDisabled( true );
		this.$label.addClass( 'new' );
	}
}

OO.inheritClass( SearchResult, OO.ui.MenuOptionWidget );

SearchResult.prototype.clickFavourite = function () {
	if ( !this.isFavourite ) {
		// Add to favourites
		if ( !this.favouritesStore.addFavourite( this.data.pageId ) ) {
			return;
		}
	} else {
		// Remove from favourites
		if ( !this.favouritesStore.removeFavourite( this.data.pageId ) ) {
			return;
		}
	}
	this.isFavourite = !this.isFavourite;
	this.favouriteButton.setIcon( this.isFavourite ? 'bookmark' : 'bookmarkOutline' );
};

module.exports = SearchResult;
