/**
 * TemplateData Option Import Widget
 * @extends {OO.ui.DecoratedOptionWidget}
 * @param {Object} config Dialog configuration object
 */
TemplateDataOptionImportWidget = function TemplateDataOptionImportWidget( config ) {
	config = config || {};

	// Parent constructor
	TemplateDataOptionImportWidget.super.call( this, $.extend( {}, config, { icon: 'parameter-set' } ) );

	this.params = config.params;

	// Initialize
	this.$element.addClass( 'tdg-templateDataOptionImportWidget' );
	this.buildParamLabel();
};

OO.inheritClass( TemplateDataOptionImportWidget, OO.ui.DecoratedOptionWidget );

/**
 * Build the parameter label in the parameter select widget
 * @param {Object} paramData Parameter data
 * @return {jQuery} Label element
 */
TemplateDataOptionImportWidget.prototype.buildParamLabel = function () {
	var paramNames = this.params.slice( 0, 9 ).join( mw.msg( 'comma-separator' ) ),
		$paramName = this.$( '<div>' )
			.addClass( 'tdg-TemplateDataOptionWidget-param-name' ),
		$description = this.$( '<div>' )
			.addClass( 'tdg-TemplateDataOptionWidget-param-description' );

	$paramName.text( mw.msg( 'templatedata-modal-table-param-importoption', this.params.length ) );
	$description.text( mw.msg( 'templatedata-modal-table-param-importoption-subtitle', paramNames ) );

	this.setLabel( $paramName.add( $description ) );
};
