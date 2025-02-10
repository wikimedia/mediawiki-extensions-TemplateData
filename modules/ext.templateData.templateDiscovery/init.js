mw.templateData = {
	config: require( './config.json' ),
	TemplateSearchLayout: require( './TemplateSearchLayout.js' )
};

// If we're on the TemplateSearch special page
if ( mw.config.get( 'wgCanonicalSpecialPageName' ) === 'TemplateSearch' ) {
	const specialTemplateSearch = document.getElementById( 'ext-TemplateData-SpecialTemplateSearch' );
	if ( specialTemplateSearch ) {
		const config = {
			expanded: false
		};
		const searchForm = new mw.templateData.TemplateSearchLayout( config );
		specialTemplateSearch.append( searchForm.$element[ 0 ] );
	}
}
