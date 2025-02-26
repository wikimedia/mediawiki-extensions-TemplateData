const FavouritesStore = require( './FavouritesStore.js' );

/**
 * @class
 *
 * @constructor
 */
function SpecialPage() {
	this.favouritesStore = new FavouritesStore();
	this.templateSearchWidget = document.getElementById( 'ext-TemplateData-SpecialTemplateSearch-widget' );
	this.templateSearchList = document.getElementById( 'ext-TemplateData-SpecialTemplateSearch-list' );
	this.favouriteTemplates = this.favouritesStore.getFavourites();
	if ( !this.templateSearchWidget || !this.templateSearchList ) {
		// Throw an error if the required elements are not found
		throw new Error( 'Required elements not found' );
	}
}

/**
 * Initialize the special page
 */
SpecialPage.prototype.init = function () {
	const searchForm = new mw.templateData.TemplateSearchLayout( {
		expanded: false
	} );
	this.templateSearchWidget.append( searchForm.$element[ 0 ] );
	searchForm.focus();
	searchForm.on( 'choose', ( item ) => {
		location.href = mw.util.getUrl( item.title );
	} );
	this.buildFavouritesList();
};

/**
 * Build the list of favourite templates
 */
SpecialPage.prototype.buildFavouritesList = function () {
	// TODO: This should probably automagically update when the favourites change
	if ( this.favouriteTemplates.length === 0 ) {
		this.templateSearchList.append( document.createElement( 'p' ).textContent = 'No favourite templates' );
	} else {
		this.templateSearchList.append( document.createElement( 'p' ).textContent = `${ this.favouriteTemplates.length } total` );
		const templateList = document.createElement( 'ul' );
		this.favouriteTemplates.forEach( ( pageId ) => {
			const result = this.favouritesStore.getFavouriteTitle( pageId );
			result.then( ( data ) => {
				const title = data.query.pages[ 0 ].title;
				const li = document.createElement( 'li' );
				const a = document.createElement( 'a' );
				a.href = mw.util.getUrl( title );
				a.textContent = title;
				li.appendChild( a );
				li.appendChild( document.createTextNode( ` (Page ID: ${ pageId })` ) );
				templateList.append( li );
			} );
		} );
		this.templateSearchList.appendChild( templateList );
	}
};

module.exports = SpecialPage;
