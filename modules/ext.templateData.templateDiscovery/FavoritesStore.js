const templateDiscoveryConfig = require( './config.json' );
const mwConfig = require( './mwConfig.json' );
const USER_PREFERENCE_NAME = 'templatedata-favorite-templates';

/**
 * @class
 *
 * @constructor
 */
function FavoritesStore() {
	this.validateFavorites().then( ( validatedFavorites ) => {
		this.favoritesArray = validatedFavorites;
	} );
	this.maxFavorites = templateDiscoveryConfig.maxFavorites;
}

/**
 * @return {Promise}
 */
FavoritesStore.prototype.getAllFavoritesDetails = function () {
	return new mw.Api().get( {
		action: 'templatedata',
		includeMissingTitles: 1,
		pageids: this.favoritesArray.join( '|' ),
		lang: mw.config.get( 'wgUserLanguage' ),
		redirects: 1,
		formatversion: 2
	} ).then( ( data ) => {
		const favorites = [];
		Object.keys( data.pages ).forEach( ( k ) => {
			const favorite = data.pages[ k ];
			favorite.pageId = k;
			favorites.push( favorite );
		} );
		return favorites
			.sort( ( p1, p2 ) => p1.title === p2.title ? 0 : ( p1.title < p2.title ? -1 : 1 ) );
	} );
};

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
		.fail( ( code, response ) => {
			// The 'notloggedin' error is a special case in mw.Api.saveOptions()
			if ( code === 'notloggedin' ) {
				mw.notify( mw.msg( 'notloggedin' ), {
					type: 'error',
					title: mw.msg( 'templatedata-favorite-error' )
				} );
			} else {
				for ( const error of response.errors ) {
					mw.notify( error.html, {
						type: 'error',
						title: mw.msg( 'templatedata-favorite-error' )
					} );
				}
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
			return;
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
		return;
	} );
};

/**
 * Check if a pageId is in the favorites array
 *
 * @param {number} pageId
 * @return {boolean} Whether the page ID is in the favorites array
 */
FavoritesStore.prototype.isFavorite = function ( pageId ) {
	return this.favoritesArray.includes( parsePageId( pageId ) );
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
 * Validate the favorites array
 *
 * @return {Promise}
 */
FavoritesStore.prototype.validateFavorites = function () {
	this.refreshFavorites();
	// If the user has no favorites, return early
	if ( this.favoritesArray.length === 0 ) {
		return Promise.resolve( [] );
	}
	const validatedFavorites = [];
	const api = new mw.Api();
	return api.get( {
		action: 'query',
		prop: 'info',
		formatversion: 2,
		origin: '*',
		pageids: this.favoritesArray.join( '|' )
	} ).then( ( data ) => {
		if ( !data.query || !data.query.pages ) {
			return [];
		}
		data.query.pages.forEach( ( page ) => {
			// Skip if the page is missing, or in an invalid namespace
			if ( page.missing || !mwConfig.TemplateDataEditorNamespaces.includes( page.ns ) ) {
				return;
			}
			validatedFavorites.push( page.pageid );
		} );
		return validatedFavorites;
	} );
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
