const FavoriteButton = require( './FavoriteButton.js' );

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

// If the #ca-favorite portlet has been added (in Hooks.php), replace it with a button.
const caFavorite = document.getElementById( 'ca-favorite' );
const pageId = mw.config.get( 'wgArticleId' );
if ( caFavorite && pageId ) {
	// Some skins show the watchlist button as a star icon.
	const iconSkins = [ 'vector', 'vector-2022', 'timeless' ];
	const showIcon = iconSkins.includes( mw.config.get( 'skin' ) );
	const buttonConfig = {
		pageId: pageId,
		invisibleLabel: showIcon,
		$input: $( '<a>' )
	};
	if ( !showIcon ) {
		buttonConfig.icon = false;
	}
	const favoriteButton = new FavoriteButton( buttonConfig );
	caFavorite.classList.add( 'ext-templatedata-caction-favorite' );
	caFavorite.replaceChildren( favoriteButton.$element[ 0 ] );
	// If there is a watchstar, move the favorite button to be after it.
	const watchlistStar = document.querySelector( '#ca-watch, #ca-unwatch' );
	if ( watchlistStar ) {
		watchlistStar.after( caFavorite );
	}
}
