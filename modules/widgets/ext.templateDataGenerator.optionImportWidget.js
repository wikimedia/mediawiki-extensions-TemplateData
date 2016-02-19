/**
 * TemplateData Option Import Widget
 * @extends {OO.ui.DecoratedOptionWidget}
 * @param {Object} config Dialog configuration object
 */
mw.TemplateData.OptionImportWidget = function mwTemplateDataOptionImportWidget( config ) {
	config = config || {};

	// Parent constructor
	mw.TemplateData.OptionImportWidget.super.call( this, $.extend( {}, config, { icon: 'parameter-set' } ) );

	this.params = config.params;

	// Initialize
	this.$element.addClass( 'tdg-templateDataOptionImportWidget' );
	this.buildParamLabel();
};

OO.inheritClass( mw.TemplateData.OptionImportWidget, OO.ui.DecoratedOptionWidget );

/**
 * Build the parameter label in the parameter select widget
 * @param {Object} paramData Parameter data
 * @return {jQuery} Label element
 */
mw.TemplateData.OptionImportWidget.prototype.buildParamLabel = function () {
	var paramNames = this.params.slice( 0, 9 ).join( mw.msg( 'comma-separator' ) ),
		$paramName = $( '<div>' )
			.addClass( 'tdg-templateDataOptionWidget-param-name' ),
		$description = $( '<div>' )
			.addClass( 'tdg-templateDataOptionWidget-param-description' );

	$paramName.text( mw.msg( 'templatedata-modal-table-param-importoption', this.params.length ) );
	$description.text( mw.msg( 'templatedata-modal-table-param-importoption-subtitle', paramNames ) );

	this.setLabel( $paramName.add( $description ) );
};
