const USER_PREFERENCE_NAME = 'templatedata-favorite-templates';

/**
 * @class
 *
 * @constructor
 */
function FavouritesStore() {
	this.favouritesArray = JSON.parse( mw.user.options.get( USER_PREFERENCE_NAME ) );
}

/**
 * Save the favourites array to the user options
 *
 * @param {Array} favouritesArray
 */
function save( favouritesArray ) {
	new mw.Api().saveOption( USER_PREFERENCE_NAME, JSON.stringify( favouritesArray ) );
	mw.user.options.set( USER_PREFERENCE_NAME, JSON.stringify( favouritesArray ) );
}

/**
 * Parse a pageId to a number, or throw
 *
 * @param {number} pageId
 * @return {number} The parsed page ID
 * @throws {Error} If the pageId is not a number
 */
function parsePageId( pageId ) {
	const parsedPageId = parseInt( pageId );
	if ( isNaN( parsedPageId ) ) {
		throw new Error( 'Invalid pageId: ' + pageId );
	}
	return parsedPageId;
}

/**
 * Add a pageId to the favourites array
 *
 * @param {number} pageId
 */
FavouritesStore.prototype.addFavourite = function ( pageId ) {
	this.refreshFavourites();
	this.favouritesArray.push( parsePageId( pageId ) );
	save( this.favouritesArray );
	document.dispatchEvent( new Event( 'favouriteAdded' ) );
};

/**
 * Remove a pageId from the favourites array
 *
 * @param {number} pageId
 */
FavouritesStore.prototype.removeFavourite = function ( pageId ) {
	this.refreshFavourites();
	const index = this.favouritesArray.indexOf( parsePageId( pageId ) );
	if ( index > -1 ) {
		this.favouritesArray.splice( index, 1 );
	}
	save( this.favouritesArray );
	document.dispatchEvent( new Event( 'favouriteRemoved' ) );
};

/**
 * Check if a pageId is in the favourites array
 *
 * @param {number} pageId
 * @return {boolean} Whether the page ID is in the favourites array
 */
FavouritesStore.prototype.isFavourite = function ( pageId ) {
	return this.favouritesArray.indexOf( parsePageId( pageId ) ) !== -1;
};

/**
 * Get the favourites array
 *
 * @return {Array} Array of page IDs
 */
FavouritesStore.prototype.getFavourites = function () {
	return this.favouritesArray;
};

/**
 * Refresh the favourites array from the user options
 */
FavouritesStore.prototype.refreshFavourites = function () {
	this.favouritesArray = JSON.parse( mw.user.options.get( USER_PREFERENCE_NAME ) );
};

/**
 * Utility function to get the title of a page ID
 *
 * @param {number} pageId
 * @return {jQuery.Promise}
 */
FavouritesStore.prototype.getFavouriteTitle = function ( pageId ) {
	// TODO: Should this be cached in some way?
	return new mw.Api().get( {
		action: 'query',
		prop: 'info',
		pageids: pageId,
		formatversion: 2
	} );
};

module.exports = FavouritesStore;
