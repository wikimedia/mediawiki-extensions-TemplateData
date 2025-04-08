const FavoritesStore = require( './FavoritesStore.js' );
const TemplateMenuItem = require( './TemplateMenuItem.js' );

/**
 * @class
 * @extends OO.ui.TabPanelLayout
 *
 * @constructor
 * @param {Object} [config] Configuration options.
 * @param {FavoritesStore} config.favoritesStore
 */
function TemplateList( config ) {
	config = Object.assign( {
		expanded: false
	}, config );
	TemplateList.super.call( this, 'template-list', config );
	this.$element.addClass( 'ext-templatedata-TemplateList' );
	this.menuItems = new Map();

	config.favoritesStore.getAllFavoritesDetails().then( ( favorites ) => {
		const menu = new OO.ui.PanelLayout( { expanded: false } );
		const templateNsId = mw.config.get( 'wgNamespaceIds' ).template;
		// Either loop through all favorites, adding them to the list.
		for ( const fave of favorites ) {
			const searchResultConfig = {
				data: fave,
				label: mw.Title.newFromText( fave.title ).getRelativeText( templateNsId ),
				description: fave.description
			};
			const templateMenuItem = new TemplateMenuItem( searchResultConfig, config.favoritesStore );
			this.menuItems.set( fave.pageId, templateMenuItem );
			templateMenuItem.connect( this, { choose: 'onChoose' } );
			menu.$element.append( templateMenuItem.$element );
		}
		// Or add a message explaining that there are no favorites.
		if ( favorites.length === 0 ) {
			menu.$element.append( $( '<p>' )
				.addClass( 'ext-templatedata-TemplateList-empty' )
				.text( mw.msg( 'templatedata-search-list-empty' ) ) );
		}
		// Then add the list (or message) to the container.
		this.$element.append( menu.$element );
	} );

	config.favoritesStore.connect(
		this,
		{
			removed: 'onFavoriteRemoved'
		}
	);

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

TemplateList.prototype.setupTabItem = function () {
	const icon = new OO.ui.IconWidget( {
		icon: 'bookmark',
		framed: false,
		flags: [ 'progressive' ],
		classes: [ 'ext-templatedata-TemplateList-tabIcon' ]
	} );
	this.tabItem.$label.append(
		icon.$element,
		' ',
		mw.msg( 'templatedata-search-list-header' )
	);
};

TemplateList.prototype.onChoose = function ( templateData ) {
	this.emit( 'choose', templateData );
};

TemplateList.prototype.onFavoriteRemoved = function ( pageId ) {
	this.menuItems.get( pageId ).$element[ 0 ].classList.add( 'ext-templatedata-TemplateMenuItem-removed' );
};

module.exports = TemplateList;
