/**
 * Generic option widget for use with OO.ui.SelectWidget.
 *
 * @class
 * @extends OO.ui.OptionWidget
 * @mixins OO.ui.DraggableElement
 *
 * @constructor
 * @param {Mixed} data Option data
 * @param {Object} [config] Configuration options
 */
TemplateDataDragDropItemWidget = function TemplateDataDragDropItemWidget( config ) {
	// Configuration initialization
	config = config || {};

	// Parent constructor
	TemplateDataDragDropItemWidget.super.call( this, $.extend( {}, { icon: 'parameter' }, config ) );

	// Mixin constructors
	OO.ui.DraggableElement.call( this, config );

	// Initialization
	this.$element
		.addClass( 'tdg-TemplateDataDragDropItemWidget' );
};

/* Setup */

OO.inheritClass( TemplateDataDragDropItemWidget, OO.ui.DecoratedOptionWidget );
OO.mixinClass( TemplateDataDragDropItemWidget, OO.ui.DraggableElement );
