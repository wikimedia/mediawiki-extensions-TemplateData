/**
 * Group widget containing items
 *
 * @class
 * @param {Object} [config] Configuration options
 */
mw.TemplateData.GroupWidget = function mwTemplateDataGroupWidget( config ) {
	// Configuration initialization
	config = config || {};
	// Parent constructor
	mw.TemplateData.GroupWidget.super.call( this, config );
	// Mixin constructors
	OO.ui.mixin.GroupElement.call( this, $.extend( {
		$group: this.$element
	}, config ) );
	// Events
	this.aggregate( {
		edit: 'editItem'
	} );
};

/* Inheritance */

OO.inheritClass( mw.TemplateData.GroupWidget, OO.ui.Widget );

OO.mixinClass( mw.TemplateData.GroupWidget, OO.ui.mixin.GroupElement );
