/**
 * TemplateData Option Widget
 * @extends {OO.ui.DecoratedOptionWidget}
 * @param {Object} config Dialog configuration object
 */
mw.TemplateData.OptionWidget = function mwTemplateDataOptionWidget( config ) {
	var data;

	config = config || {};
	data = config.data || {};
	// Parent constructor
	mw.TemplateData.OptionWidget.super.call( this, $.extend( {}, config, { data: data.key, icon: 'parameter' } ) );

	this.key = data.key;
	this.name = data.name;
	this.aliases = data.aliases;
	this.description = data.description;

	// Initialize
	this.$element.addClass( 'tdg-TemplateDataOptionWidget' );
	this.buildParamLabel();
};

OO.inheritClass( mw.TemplateData.OptionWidget, OO.ui.DecoratedOptionWidget );

/**
 * Build the parameter label in the parameter select widget
 * @param {Object} paramData Parameter data
 * @return {jQuery} Label element
 */
mw.TemplateData.OptionWidget.prototype.buildParamLabel = function () {
	var i, len,
		$paramName = $( '<div>' )
			.addClass( 'tdg-TemplateDataOptionWidget-param-name' ),
		$aliases = $( '<div>' )
			.addClass( 'tdg-TemplateDataOptionWidget-param-aliases' ),
		$description = $( '<div>' )
			.addClass( 'tdg-TemplateDataOptionWidget-param-description' );

	$paramName.text( this.name );
	$description.text( this.description );

	if ( this.aliases !== undefined ) {
		for ( i = 0, len = this.aliases.length; i < len; i++ ) {
			$aliases.append(
				$( '<span>' )
					.addClass( 'tdg-TemplateDataOptionWidget-param-alias' )
					.text( this.aliases[i] )
			);
		}
	}

	this.setLabel( $paramName.add( $aliases ).add( $description ) );
};
