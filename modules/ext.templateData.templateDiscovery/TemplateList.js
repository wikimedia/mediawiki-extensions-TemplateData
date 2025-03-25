const FavoritesStore = require( './FavoritesStore.js' );
const TemplateMenuItem = require( './TemplateMenuItem.js' );

/**
 * @class
 * @extends OO.ui.xxx
 *
 * @constructor
 * @param {Object} [config] Configuration options.
 */
function TemplateList( config ) {
	config = Object.assign( {
		favoritesStore: new FavoritesStore(),
		expanded: false,
		label: mw.msg( 'templatedata-search-list-header' )
	}, config );
	TemplateList.super.call( this, 'template-list', config );
	this.$element.addClass( 'ext-templatedata-TemplateList' );

	config.favoritesStore.getAllFavoritesDetails().then( ( favorites ) => {
		const menu = new OO.ui.PanelLayout( { expanded: false } );
		const templateNsId = mw.config.get( 'wgNamespaceIds' ).template;
		for ( const fave of favorites ) {
			const searchResultConfig = {
				data: fave,
				label: mw.Title.newFromText( fave.title ).getRelativeText( templateNsId ),
				description: fave.description
			};
			const templateMenuItem = new TemplateMenuItem( searchResultConfig, config.favoritesStore );
			templateMenuItem.connect( this, { choose: 'onChoose' } );
			menu.$element.append( templateMenuItem.$element );
		}
		this.$element.append( menu.$element );
	} );
}

/* Setup */

OO.inheritClass( TemplateList, OO.ui.TabPanelLayout );

/* Events */

/**
 * When a template is chosen from the list of favorites.
 *
 * @event choose
 * @param {Object} The template data of the chosen template.
 */

/* Methods */

TemplateList.prototype.onChoose = function ( templateData ) {
	this.emit( 'choose', templateData );
};

module.exports = TemplateList;
