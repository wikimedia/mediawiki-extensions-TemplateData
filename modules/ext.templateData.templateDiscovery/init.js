const FavoriteButton = require( './FavoriteButton.js' );
const mwConfig = require( './mwConfig.json' );
const FavoritesStore = require( './FavoritesStore.js' );

mw.templateData = {
	config: require( './config.json' ),
	TemplateSearchLayout: require( './TemplateSearchLayout.js' ),
	FavoriteButton: FavoriteButton,
	FavoritesStore: require( './FavoritesStore.js' )
};

// If we're on the TemplateDiscovery special page
if ( mw.config.get( 'wgCanonicalSpecialPageName' ) === 'TemplateDiscovery' ) {
	// Only require this if we're on the special page
	const SpecialPage = require( './SpecialPage.js' );
	const specialPage = new SpecialPage();
	specialPage.init();
	return;
}

// Current, non-Special page namespace
const namespace = mw.config.get( 'wgNamespaceNumber' );

// Only load the FavoriteButton if we're in a valid namespace
if ( mwConfig.TemplateDataEditorNamespaces.includes( namespace ) ) {
	// Find the watchlist star and add the favorite button next to it
	const watchlistStarParent = document.querySelector( '#ca-watch, #ca-unwatch' ).parentNode;
	if ( watchlistStarParent ) {
		addFavoriteIcon( watchlistStarParent );
	}
}

/**
 * Add the favorite icon next to the watchlist star
 *
 * @param {Element} watchlistStarParent
 */
function addFavoriteIcon( watchlistStarParent ) {
	const pageId = mw.config.get( 'wgArticleId' );
	if ( pageId ) {
		const favoritesStore = new FavoritesStore();
		const isFavorite = favoritesStore.isFavorite( pageId );
		const tooltip = isFavorite ? mw.msg( 'templatedata-favorite-remove' ) : mw.msg( 'templatedata-favorite-add' );
		const portlet = mw.util.addPortletLink( 'p-cactions', '', '', 'ca-favorite' );
		if ( portlet ) {
			const favoriteButton = new FavoriteButton( {
				pageId: pageId,
				favoritesStore: favoritesStore,
				label: tooltip
			} );

			portlet.classList.add( 'ext-templatedata-caction-favorite' );

			// Replace with the favorite button
			portlet.removeChild( portlet.children[ 0 ] );
			portlet.appendChild( favoriteButton.$element[ 0 ] );

			// Append next to the watchlist star
			watchlistStarParent.appendChild( portlet );
		}
	}
}
