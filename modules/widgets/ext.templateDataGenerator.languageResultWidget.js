/**
 * Creates a TemplateDataLanguageResultWidget object.
 * This is a copy of ve.ui.LanguageResultWidget
 *
 * @class
 * @extends OO.ui.OptionWidget
 *
 * @constructor
 * @param {Object} [config] Configuration options
 */
TemplateDataLanguageResultWidget = function TemplateDataLanguageResultWidget( config ) {
	// Parent constructor
	OO.ui.OptionWidget.call( this, config );

	// Initialization
	this.$element.addClass( 'tdg-languageResultWidget' );
	this.$name = this.$( '<div>' ).addClass( 'tdg-languageResultWidget-name' );
	this.$otherMatch = this.$( '<div>' ).addClass( 'tdg-languageResultWidget-otherMatch' );
	this.setLabel( this.$otherMatch.add( this.$name ) );
};

/* Inheritance */

OO.inheritClass( TemplateDataLanguageResultWidget, OO.ui.OptionWidget );

/* Methods */

/**
 * Update labels based on query
 *
 * @param {string} [query] Query text which matched this result
 * @param {string} [matchedProperty] Data property which matched the query text
 * @chainable
 */
TemplateDataLanguageResultWidget.prototype.updateLabel = function ( query, matchedProperty ) {
	var $highlighted, data = this.getData();

	// Reset text
	this.$name.text( data.name );
	this.$otherMatch.text( data.code );

	// Highlight where applicable
	if ( matchedProperty ) {
		$highlighted = this.highlightQuery( data[matchedProperty], query );
		if ( matchedProperty === 'name' ) {
			this.$name.empty().append( $highlighted );
		} else {
			this.$otherMatch.empty().append( $highlighted );
		}
	}

	return this;
};

/**
 * Highlight text where a substring query matches
 *
 * @param {string} text Text
 * @param {string} query Query to find
 * @returns {jQuery} Text with query substring wrapped in highlighted span
 */
TemplateDataLanguageResultWidget.prototype.highlightQuery = function ( text, query ) {
	var $result = this.$( '<span>' ),
		offset = text.toLowerCase().indexOf( query.toLowerCase() );

	if ( !query.length || offset === -1 ) {
		return $result.text( text );
	}
	$result.append(
		document.createTextNode( text.slice( 0, offset ) ),
		this.$( '<span>' )
			.addClass( 'tdg-languageResultWidget-highlight' )
			.text( text.substr( offset, query.length ) ),
		document.createTextNode( text.slice( offset + query.length ) )
	);
	return $result.contents();
};
