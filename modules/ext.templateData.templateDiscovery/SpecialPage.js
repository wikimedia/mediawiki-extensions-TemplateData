const FavoritesStore = require( './FavoritesStore.js' );

/**
 * @class
 *
 * @constructor
 */
function SpecialPage() {
	this.favoritesStore = new FavoritesStore();
	this.templateSearchWidget = document.getElementById( 'ext-TemplateData-SpecialTemplateSearch-widget' );
	this.templateSearchList = document.getElementById( 'ext-TemplateData-SpecialTemplateSearch-list' );
	this.favoriteTemplates = this.favoritesStore.getFavorites();
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
	this.buildFavoritesList();
};

/**
 * Build the list of favorite templates
 */
SpecialPage.prototype.buildFavoritesList = function () {
	// TODO: This should probably automagically update when the favorites change
	if ( this.favoriteTemplates.length === 0 ) {
		this.templateSearchList.append( document.createElement( 'p' ).textContent = `0/${ this.favoritesStore.maxFavorites }` );
	} else {
		this.templateSearchList.append( document.createElement( 'p' ).textContent = `${ this.favoriteTemplates.length }/${ this.favoritesStore.maxFavorites }` );
		const templateList = document.createElement( 'ul' );
		this.favoriteTemplates.forEach( ( pageId ) => {
			const result = this.favoritesStore.getFavoriteTitle( pageId );
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
