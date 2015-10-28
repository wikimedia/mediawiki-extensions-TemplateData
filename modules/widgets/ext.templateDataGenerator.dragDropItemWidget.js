/**
 * Generic option widget for use with OO.ui.SelectWidget.
 *
 * @class
 * @extends OO.ui.OptionWidget
 * @mixins OO.ui.mixin.DraggableElement
 *
 * @constructor
 * @param {Mixed} data Option data
 * @param {Object} [config] Configuration options
 */
mw.TemplateData.DragDropItemWidget = function mwTemplateDataDragDropItemWidget( config ) {
	// Configuration initialization
	config = config || {};

	// Parent constructor
	mw.TemplateData.DragDropItemWidget.super.call( this, $.extend( {}, { icon: 'parameter' }, config ) );

	// Mixin constructors
	OO.ui.mixin.DraggableElement.call( this, config );

	// Initialization
	this.$element
		.addClass( 'tdg-TemplateDataDragDropItemWidget' );
};

/* Setup */

OO.inheritClass( mw.TemplateData.DragDropItemWidget, OO.ui.DecoratedOptionWidget );
OO.mixinClass( mw.TemplateData.DragDropItemWidget, OO.ui.mixin.DraggableElement );
