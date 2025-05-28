const ColumnItem = require( './ColumnItem.js' );

/**
 * @class
 * @extends OO.ui.PanelLayout
 *
 * @constructor
 * @param {Object} [config] Configuration options.
 */
function Column( config ) {
	config = Object.assign( {
		expanded: false,
		framed: true
	}, config );
	Column.super.call( this, config );
	OO.ui.mixin.PendingElement.call( this, config );
	OO.EventEmitter.call( this );

	this.$element.addClass( 'ext-templatedata-ColumnGroup-Column' );

	this.dataStore = config.dataStore;
	this.items = [];
	this.data = {};
}

/* Setup */

OO.inheritClass( Column, OO.ui.PanelLayout );
OO.mixinClass( Column, OO.ui.mixin.PendingElement );
OO.mixinClass( Column, OO.EventEmitter );

/* Events */

/**
 * When a template is chosen.
 *
 * @event choose
 * @param {Object} The template data of the chosen template.
 */

/** Methods */

/**
 * @param {string} columnTitle
 * @param {string} cmcontinue
 * @return {Promise}
 */
Column.prototype.loadItems = function ( columnTitle, cmcontinue ) {
	this.data.columnTitle = columnTitle;
	this.scrollElementIntoView();
	this.pushPending();
	return this.dataStore.getColumnData( columnTitle, cmcontinue )
		.then( ( data ) => {
			for ( const itemData of data ) {
				const columnItem = new ColumnItem( itemData );
				columnItem.connect( this, {
					choose: this.onChoose,
					loadmore: this.onLoadmore
				} );
				this.items.push( columnItem );
				this.$element.append( columnItem.$element );
			}
			if ( data.length === 0 ) {
				this.$element.addClass( 'ext-templatedata-column-error' );
				this.$element.append( mw.message( 'templatedata-category-column-empty', columnTitle ).parse() );
			}
			this.popPending();
		} ).catch( ( err ) => {
			this.$element.addClass( 'ext-templatedata-column-error' );
			this.$element.append( mw.msg( 'templatedata-category-column-error' ) + mw.msg( 'colon-separator' ) + err );
			this.popPending();
		} );
	// @todo popPending should be moved to .finally(), when we can use that.
};

Column.prototype.getData = function () {
	return this.data;
};

Column.prototype.getItem = function ( index ) {
	return this.items[ index ];
};

Column.prototype.onChoose = function ( columnItem ) {
	// Unhighlight all other items.
	this.items
		.filter( ( i ) => i !== columnItem )
		.forEach( ( i ) => i.setHighlighted( false ) );
	this.emit( 'choose', {
		column: this,
		columnItem: columnItem
	} );
};

Column.prototype.onLoadmore = function ( columnItem, cmcontinue ) {
	columnItem.$element.remove();
	this.items.splice( this.items.indexOf( columnItem ), 1 );
	this.emit( 'loadmore', this, cmcontinue );
};

module.exports = Column;
