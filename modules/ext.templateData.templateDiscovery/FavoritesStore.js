const templateDiscoveryConfig = require( './config.json' );
const USER_PREFERENCE_NAME = 'templatedata-favorite-templates';

/**
 * @class
 *
 * @constructor
 */
function FavoritesStore() {
	this.favoritesArray = JSON.parse( mw.user.options.get( USER_PREFERENCE_NAME ) );
	this.maxFavorites = templateDiscoveryConfig.maxFavorites;
}

/**
 * Save the favorites array to the user options
 *
 * @param {Array} favoritesArray
 * @return {Promise}
 */
function save( favoritesArray ) {
	const json = JSON.stringify( favoritesArray );
	return new mw.Api().saveOption( USER_PREFERENCE_NAME, json, { errorsuselocal: 1, errorformat: 'html' } )
		.then( () => {
			mw.user.options.set( USER_PREFERENCE_NAME, json );
		} )
		.fail( ( _, response ) => {
			for ( const error of response.errors ) {
				mw.notify( error.html, {
					type: 'error',
					title: mw.msg( 'templatedata-favorite-error' )
				} );
			}
		} );
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
 * Add a pageId to the favorites array
 *
 * @param {number} pageId
 * @return {Promise} Resolves when the page ID is added (or is not able to be).
 */
FavoritesStore.prototype.addFavorite = function ( pageId ) {
	this.refreshFavorites();
	if ( this.favoritesArray.length < this.maxFavorites ) {
		this.favoritesArray.push( parsePageId( pageId ) );
		return save( this.favoritesArray ).then( () => {
			document.dispatchEvent( new Event( 'favoriteAdded' ) );
			mw.notify(
				mw.msg( 'templatedata-favorite-added' ),
				{
					type: 'success',
					tag: 'templatedata-favorite-added'
				}
			);
			return Promise.resolve();
		} );
	} else {
		mw.notify(
			mw.msg( 'templatedata-favorite-maximum-reached', this.maxFavorites ),
			{
				type: 'error',
				tag: 'templatedata-favorite-maximum-reached'
			}
		);
		return Promise.resolve();
	}
};

/**
 * Remove a pageId from the favorites array
 *
 * @param {number} pageId
 * @return {Promise} Resolves when the page ID is removed (or is not able to be).
 */
FavoritesStore.prototype.removeFavorite = function ( pageId ) {
	this.refreshFavorites();
	const index = this.favoritesArray.indexOf( parsePageId( pageId ) );
	if ( index > -1 ) {
		this.favoritesArray.splice( index, 1 );
	}
	return save( this.favoritesArray ).then( () => {
		document.dispatchEvent( new Event( 'favoriteRemoved' ) );
		mw.notify(
			mw.msg( 'templatedata-favorite-removed' ),
			{
				type: 'success',
				tag: 'templatedata-favorite-removed'
			}
		);
		return Promise.resolve();
	} );
};

/**
 * Check if a pageId is in the favorites array
 *
 * @param {number} pageId
 * @return {boolean} Whether the page ID is in the favorites array
 */
FavoritesStore.prototype.isFavorite = function ( pageId ) {
	return this.favoritesArray.indexOf( parsePageId( pageId ) ) !== -1;
};

/**
 * Get the favorites array
 *
 * @return {Array} Array of page IDs
 */
FavoritesStore.prototype.getFavorites = function () {
	return this.favoritesArray;
};

/**
 * Refresh the favorites array from the user options
 */
FavoritesStore.prototype.refreshFavorites = function () {
	this.favoritesArray = JSON.parse( mw.user.options.get( USER_PREFERENCE_NAME ) );
};

/**
 * Utility function to get the title of a page ID
 *
 * @param {number} pageId
 * @return {jQuery.Promise}
 */
FavoritesStore.prototype.getFavoriteTitle = function ( pageId ) {
	// TODO: Should this be cached in some way?
	return new mw.Api().get( {
		action: 'query',
		prop: 'info',
		pageids: pageId,
		formatversion: 2
	} );
};

module.exports = FavoritesStore;
