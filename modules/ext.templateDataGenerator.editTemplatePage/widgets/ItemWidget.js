/**
 * Item widget contained by the Group widget
 *
 * @class
 * @extends OO.ui.Widget
 * @mixins OO.ui.mixin.IconElement
 * @mixins OO.ui.mixin.LabelElement
 * @param {Object} [config] Configuration options
 */
mw.TemplateData.ItemWidget = function mwTemplateDataItemWidget( config ) {
	// Configuration initialization
	config = config || {};
	// Parent constructor
	mw.TemplateData.ItemWidget.super.call( this, config );
	// Mixin constructors
	OO.ui.mixin.IconElement.call( this, config );
	OO.ui.mixin.LabelElement.call( this, config );
	// Initialization
	this.$element
		.addClass( 'mw-TemplateData-itemWidget' )
		.append( this.$icon, this.$label );

	this.$element.on( {
		click: this.onItemClick.bind( this )
	} );

	this.highlighted = false;
};
/* Inheritance */

OO.inheritClass( mw.TemplateData.ItemWidget, OO.ui.Widget );
OO.mixinClass( mw.TemplateData.ItemWidget, OO.ui.mixin.IconElement );
OO.mixinClass( mw.TemplateData.ItemWidget, OO.ui.mixin.LabelElement );

/* Event handlers */

/**
 * Handle clicking on an item (map name on the side-bar)
 */
mw.TemplateData.ItemWidget.prototype.onItemClick = function () {
	this.emit( 'edit', this );
};

/**
 * Toggle highlighted class
 *
 * @param {boolean} highlighted The item is highlighted
 */
mw.TemplateData.ItemWidget.prototype.toggleHighlighted = function ( highlighted ) {
	highlighted = highlighted !== undefined ? highlighted : !this.highlighted;
	this.$element.toggleClass( 'mw-templateData-template-map-item-highlighted', !!highlighted );
};
