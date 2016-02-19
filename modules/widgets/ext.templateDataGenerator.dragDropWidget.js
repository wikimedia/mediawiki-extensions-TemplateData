/**
 * Drag and drop widget for TemplateData dialog
 *
 * Use together with TemplateDataDragDropItemWidget.
 *
 * @class
 * @extends OO.ui.Widget
 * @mixins OO.ui.mixin.DraggableGroupElement
 *
 * @constructor
 * @param {Object} [config] Configuration options
 * @cfg {OO.ui.OptionWidget[]} [items] Options to add
 */
mw.TemplateData.DragDropWidget = function mwTemplateDataDragDropWidget( config ) {
	// Configuration initialization
	config = config || {};

	// Parent constructor
	mw.TemplateData.DragDropWidget.super.call( this, config );

	// Mixin constructors
	OO.ui.mixin.DraggableGroupElement.call( this, $.extend( {}, config, { $group: this.$element } ) );

	// Initialization
	this.$element.addClass( 'tdg-templateDataDragDropWidget' );
};

/* Setup */

OO.inheritClass( mw.TemplateData.DragDropWidget, OO.ui.Widget );
OO.mixinClass( mw.TemplateData.DragDropWidget, OO.ui.mixin.DraggableGroupElement );

/**
 * Get an array of keys based on the current items, in order
 * @return {string[]} Array of keys
 */
mw.TemplateData.DragDropWidget.prototype.getKeyArray = function () {
	var i, len,
		arr = [];

	for ( i = 0, len = this.items.length; i < len; i++ ) {
		arr.push( this.items[i].getData() );
	}

	return arr;
};

/**
 * Reorder the key into its new index. Find the item first, then add
 * it back in its new place.
 * @param {string} key Unique key
 * @param {number} newIndex New index
 */
mw.TemplateData.DragDropWidget.prototype.reorderKey = function ( key, newIndex ) {
	var i, len, item;

	// Get the item that belongs to this key
	for ( i = 0, len = this.items.length; i < len; i++ ) {
		if ( this.items[i].getData() === key ) {
			item = this.items[i];
		}
	}

	this.addItems( [ item ], newIndex );
};
