const Column = require( './Column.js' );

/**
 * @class
 * @extends OO.ui.TabPanelLayout
 *
 * @constructor
 * @param {Object} [config] Configuration options.
 */
function ColumnGroup( config ) {
	config = Object.assign( {
		expanded: false,
		framed: true
	}, config );
	ColumnGroup.super.call( this, config );
	this.$element.addClass( 'ext-templatedata-ColumnGroup' );
	this.config = config;
	this.columns = [];
}

/* Setup */

OO.inheritClass( ColumnGroup, OO.ui.PanelLayout );

/* Methods */

ColumnGroup.prototype.addColumn = function ( column ) {
	column.connect( this, {
		choose: this.onChoose,
		loadmore: this.onLoadmore
	} );
	this.$element.append( column.$element );
	this.columns.push( column );
};

ColumnGroup.prototype.getColumns = function () {
	return this.columns;
};

/**
 * @param {Object} data With keys 'column' and 'columnItem'.
 */
ColumnGroup.prototype.onChoose = function ( data ) {
	if ( data.columnItem.getData().isCategory ) {
		// Remove lower columns.
		this.columns
			.slice( this.columns.indexOf( data.column ) + 1 )
			.forEach( ( c ) => c.$element.remove() );
		// Add the new column.
		const col = new Column( { dataStore: this.config.dataStore } );
		this.addColumn( col );
		col.loadItems( data.columnItem.getData().value ).then( () => {
			col.scrollElementIntoView();
		} );
	} else {
		const pageId = data.columnItem.getData().pageId;
		this.config.dataStore.getItemData( pageId ).then( ( itemData ) => {
			this.emit( 'choose', itemData );
		} );
	}
};

/**
 * @param {Column} column
 * @param {string} cmcontinue
 */
ColumnGroup.prototype.onLoadmore = function ( column, cmcontinue ) {
	column.loadItems( column.getData().columnTitle, cmcontinue );
};

module.exports = ColumnGroup;
