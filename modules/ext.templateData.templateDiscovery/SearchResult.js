/**
 * @class
 * @extends OO.ui.MenuOptionWidget
 *
 * @constructor
 * @param {Object} config
 * @param {jQuery|string} [config.description=''] Search result description
 * @param {boolean} [config.isFavourite=false] Whether this template has been favourited
 * @param {string} [config.data.redirecttitle] Page title for the "redirected from" message
 */
function SearchResult( config ) {
	config = Object.assign( {
		classes: [ 'ext-templatedata-SearchResult' ],
		isFavourite: false
	}, config );
	SearchResult.super.call( this, config );

	if ( config.data.redirecttitle ) {
		const redirecttitle = new mw.Title( config.data.redirecttitle )
			.getRelativeText( mw.config.get( 'wgNamespaceIds' ).template );
		$( '<span>' )
			.addClass( 'ext-templatedata-search-redirectedfrom' )
			.text( mw.msg( 'redirectedfrom', redirecttitle ) )
			.appendTo( this.$element );
	}

	$( '<span>' )
		.addClass( 'ext-templatedata-search-description' )
		.append( $( '<bdi>' ).text( config.description || '' ) )
		.appendTo( this.$element );

	// Add a wrapper element so that the button and the other elements are in separate containers.
	const $wrap = $( '<span>' );
	$wrap.append( this.$element.contents() );
	this.$element.append( $wrap );

	this.isFavourite = config.isFavourite;

	this.favouriteButton = new OO.ui.ButtonInputWidget( {
		icon: 'bookmarkOutline',
		framed: false,
		invisibleLabel: true,
		type: 'button'
	} );
	this.favouriteButton.connect( this, { click: this.clickFavourite } );
	this.$element.append( this.favouriteButton.$element );
}

OO.inheritClass( SearchResult, OO.ui.MenuOptionWidget );

SearchResult.prototype.clickFavourite = function () {
	this.isFavourite = !this.isFavourite;
	this.favouriteButton.setIcon( this.isFavourite ? 'bookmark' : 'bookmarkOutline' );
};

module.exports = SearchResult;
