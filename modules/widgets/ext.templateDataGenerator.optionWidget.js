/**
 * TemplateData Option Widget
 *
 * @extends {OO.ui.DecoratedOptionWidget}
 * @param {Object} config Dialog configuration object
 */
mw.TemplateData.OptionWidget = function mwTemplateDataOptionWidget( config ) {
	var data;

	config = config || {};
	data = config.data || {};

	// Parent constructor
	mw.TemplateData.OptionWidget.parent.call( this, $.extend( {}, config, { data: data.key, icon: 'parameter' } ) );

	this.key = data.key;
	this.name = data.name;
	this.aliases = data.aliases;
	this.description = data.description;

	// Initialize
	this.$element.addClass( 'tdg-templateDataOptionWidget' );
	this.buildParamLabel();
};

/* Inheritance */

OO.inheritClass( mw.TemplateData.OptionWidget, OO.ui.DecoratedOptionWidget );

/**
 * Build the parameter label in the parameter select widget
 */
mw.TemplateData.OptionWidget.prototype.buildParamLabel = function () {
	var i, len,
		$paramName = $( '<div>' )
			.addClass( 'tdg-templateDataOptionWidget-param-name' ),
		$aliases = $( '<div>' )
			.addClass( 'tdg-templateDataOptionWidget-param-aliases' ),
		$description = $( '<div>' )
			.addClass( 'tdg-templateDataOptionWidget-param-description' );

	$paramName.text( this.name );
	$description.text( this.description );

	if ( this.aliases !== undefined ) {
		for ( i = 0, len = this.aliases.length; i < len; i++ ) {
			$aliases.append(
				$( '<span>' )
					.addClass( 'tdg-templateDataOptionWidget-param-alias' )
					.text( this.aliases[ i ] )
			);
		}
	}

	this.setLabel( $paramName.add( $aliases ).add( $description ) );
};
