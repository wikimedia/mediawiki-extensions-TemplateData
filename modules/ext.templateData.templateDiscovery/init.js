const SpecialPage = require( './SpecialPage.js' );

mw.templateData = {
	config: require( './config.json' ),
	TemplateSearchLayout: require( './TemplateSearchLayout.js' ),
	FavoriteButton: require( './FavoriteButton.js' )
};

// If we're on the TemplateSearch special page
if ( mw.config.get( 'wgCanonicalSpecialPageName' ) === 'TemplateSearch' ) {
	const specialPage = new SpecialPage();
	specialPage.init();
}
