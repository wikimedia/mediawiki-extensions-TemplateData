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
		label: mw.msg( 'templatedata-search-list-header' ),
		expanded: false
	}, config );
	TemplateList.super.call( this, 'template-list', config );
	this.$element.addClass( 'ext-templatedata-TemplateList' );
	this.menuItems = new Map();
	this.config = config;
	this.menu = new OO.ui.PanelLayout( { expanded: false } );

	this.$tabHeaderIcon = null;
	this.$emptyListMessage = null;
	this.items = [];
	this.favorites = [];
	this.favoritesStore = config.favoritesStore || new FavoritesStore();

	this.config.favoritesStore.getAllFavoritesDetails().then( ( favorites ) => {
		// Either loop through all favorites, adding them to the list.
		for ( const fave of favorites ) {
			this.addRowToList( fave );
		}
		// Or add a message explaining that there are no favorites.
		if ( favorites.length === 0 ) {
			this.emptyListMessage = new OO.ui.MessageWidget( {
				icon: 'bookmark',
				classes: [ 'ext-templatedata-TemplateList-empty' ],
				label: mw.msg( 'templatedata-search-list-empty' )
			} );
			this.menu.$element.append( this.emptyListMessage.$element );
		}
		// Then add the list (or message) to the container.
		this.$element.append( this.menu.$element );
		const mergedConfig = Object.assign( {
			items: this.items
		}, config );
		mergedConfig.$group = this.$element;
		OO.ui.mixin.DraggableGroupElement.call( this, mergedConfig );
	} );

	this.config.favoritesStore.connect(
		this,
		{
			removed: 'onFavoriteRemoved',
			added: 'onFavoriteAdded'
		}
	);

}

/* Setup */

OO.inheritClass( TemplateList, OO.ui.TabPanelLayout );
OO.mixinClass( TemplateList, OO.ui.mixin.DraggableGroupElement );

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

/**
 * When a favorite is removed, update the list.
 *
 * @param {number} pageId
 */
TemplateList.prototype.onFavoriteRemoved = function ( pageId ) {
	this.menuItems.get( pageId ).$element[ 0 ].classList.add( 'ext-templatedata-TemplateMenuItem-removed' );
};

/**
 * When a favorite is added, update the list.
 *
 * @param {number} pageId
 * @return {void}
 */
TemplateList.prototype.onFavoriteAdded = function ( pageId ) {
	// Check if the pageId is already in the list.
	// If it is, remove the 'removed' class.
	if ( this.menuItems.has( pageId ) ) {
		this.menuItems.get( pageId ).$element[ 0 ].classList.remove( 'ext-templatedata-TemplateMenuItem-removed' );
		return;
	}

	// Otherwise, add it to the list.
	this.config.favoritesStore.getFavoriteDetail( pageId ).then( ( data ) => {
		if ( data && data[ 0 ] ) {
			this.addRowToList( data[ 0 ] );
		}
	} );
};

/**
 * Add a template to the list of favorites.
 *
 * @param {Object} fave
 */
TemplateList.prototype.addRowToList = function ( fave ) {
	const templateNsId = mw.config.get( 'wgNamespaceIds' ).template;
	const searchResultConfig = {
		data: fave,
		label: mw.Title.newFromText( fave.title ).getRelativeText( templateNsId ),
		description: fave.description,
		draggable: true // Only allow reordering of favorites in the list.
	};
	const templateMenuItem = new TemplateMenuItem( searchResultConfig, this.config.favoritesStore );
	this.items.push( templateMenuItem );
	this.favorites.push( parseInt( fave.pageId ) );
	this.menuItems.set( fave.pageId, templateMenuItem );
	templateMenuItem.connect( this, { choose: 'onChoose', drop: 'onReorder' } );
	this.menu.$element.append( templateMenuItem.$element );
	// Remove the empty-list state (if applicable).
	if ( this.emptyListMessage ) {
		this.emptyListMessage.$element.remove();
	}
};

TemplateList.prototype.onReorder = function () {
	const droppedItem = this.items[ 0 ];
	const oldIndex = this.favorites.indexOf( parseInt( droppedItem.data.pageId ) );

	this.items.splice( oldIndex, 1 );
	this.items.splice( this.items[ 0 ].index, 0, droppedItem );
	this.favorites.splice( oldIndex, 1 );
	this.favorites.splice( this.items[ 0 ].index, 0, parseInt( droppedItem.data.pageId ) );
	this.favoritesStore.saveFavoritesArray( this.favorites );
};

module.exports = TemplateList;
