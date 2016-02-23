/**
 * TemplateData Param Widget
 *
 * @class
 * @extends {OO.ui.DecoratedOptionWidget}
 * @mixins OO.ui.mixin.DraggableElement
 *
 * @param {Object} config Dialog configuration object
 */
mw.TemplateData.ParamWidget = function mwTemplateDataParamWidget( config ) {
	var data;

	config = config || {};
	data = config.data || {};

	// Parent constructor
	mw.TemplateData.ParamWidget.parent.call( this, $.extend( {}, config, { data: data.key, icon: 'menu' } ) );

	// Mixin constructors
	OO.ui.mixin.DraggableElement.call( this, $.extend( { $handle: this.$icon } ) );

	this.key = data.key;
	this.name = data.name;
	this.aliases = data.aliases;
	this.description = data.description;

	// Initialize
	this.$element.addClass( 'tdg-templateDataParamWidget' );
	this.buildParamLabel();
};

/* Inheritance */

OO.inheritClass( mw.TemplateData.ParamWidget, OO.ui.DecoratedOptionWidget );

OO.mixinClass( mw.TemplateData.ParamWidget, OO.ui.mixin.DraggableElement );

/**
 * Build the parameter label in the parameter select widget
 */
mw.TemplateData.ParamWidget.prototype.buildParamLabel = function () {
	var i, len,
		$paramName = $( '<div>' )
			.addClass( 'tdg-templateDataParamWidget-param-name' ),
		$aliases = $( '<div>' )
			.addClass( 'tdg-templateDataParamWidget-param-aliases' ),
		$description = $( '<div>' )
			.addClass( 'tdg-templateDataParamWidget-param-description' );

	$paramName.text( this.name );
	$description.text( this.description );

	if ( this.aliases !== undefined ) {
		for ( i = 0, len = this.aliases.length; i < len; i++ ) {
			$aliases.append(
				$( '<span>' )
					.addClass( 'tdg-templateDataParamWidget-param-alias' )
					.text( this.aliases[ i ] )
			);
		}
	}

	this.setLabel( $paramName.add( $aliases ).add( $description ) );
};
