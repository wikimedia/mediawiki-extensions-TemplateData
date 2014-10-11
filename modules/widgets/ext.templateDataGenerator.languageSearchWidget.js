/**
 * Creates a TemplateDataLanguageSearchWidget object.
 * This is a copy of ve.ui.LanguageSearchWidget.
 *
 * @class
 * @extends OO.ui.SearchWidget
 *
 * @constructor
 * @param {Object} [config] Configuration options
 */
TemplateDataLanguageSearchWidget = function TemplateDataLanguageSearchWidget( config ) {
	// Configuration intialization
	config = $.extend( {
		placeholder: mw.msg( 'templatedata-modal-search-input-placeholder' )
	}, config );

	// Parent constructor
	OO.ui.SearchWidget.call( this, config );

	// Properties
	this.languageResultWidgets = [];

	var i, l, languageCode,
		languageCodes = Object.keys( $.uls.data.getAutonyms() ).sort();

	for ( i = 0, l = languageCodes.length; i < l; i++ ) {
		languageCode = languageCodes[i];
		this.languageResultWidgets.push(
			new TemplateDataLanguageResultWidget( {
				data: {
					code: languageCode,
					name: $.uls.data.getAutonym( languageCode ),
					autonym: $.uls.data.getAutonym( languageCode )
				},
				$: this.$
			} )
		);
	}

	// Initialization
	this.$element.addClass( 'tdg-languageSearchWidget' );
};

/* Inheritance */

OO.inheritClass( TemplateDataLanguageSearchWidget, OO.ui.SearchWidget );

/* Methods */

/**
 * @inheritdoc
 */
TemplateDataLanguageSearchWidget.prototype.onQueryChange = function () {
	// Parent method
	OO.ui.SearchWidget.prototype.onQueryChange.call( this );

	// Populate
	this.addResults();
};

/**
 * Update search results from current query
 */
TemplateDataLanguageSearchWidget.prototype.addResults = function () {
	var i, iLen, j, jLen, languageResult, data, matchedProperty,
		matchProperties = ['name', 'autonym', 'code'],
		query = this.query.getValue().trim(),
		matcher = new RegExp( '^' + this.constructor.static.escapeRegex( query ), 'i' ),
		hasQuery = !!query.length,
		items = [];

	this.results.clearItems();

	for ( i = 0, iLen = this.languageResultWidgets.length; i < iLen; i++ ) {
		languageResult = this.languageResultWidgets[i];
		data = languageResult.getData();
		matchedProperty = null;

		for ( j = 0, jLen = matchProperties.length; j < jLen; j++ ) {
			if ( matcher.test( data[matchProperties[j]] ) ) {
				matchedProperty = matchProperties[j];
				break;
			}
		}

		if ( query === '' || matchedProperty ) {
			items.push(
				languageResult
					.updateLabel( query, matchedProperty )
					.setSelected( false )
					.setHighlighted( false )
			);
		}
	}

	this.results.addItems( items );
	if ( hasQuery ) {
		this.results.highlightItem( this.results.getFirstSelectableItem() );
	}
};

/**
 * Escape regex.
 *
 * Ported from Languagefilter#escapeRegex in jquery.uls.
 *
 * @param {string} value Text
 * @returns {string} Text escaped for use in regex
 */
TemplateDataLanguageSearchWidget.static.escapeRegex = function ( value ) {
	return value.replace( /[\-\[\]{}()*+?.,\\\^$\|#\s]/g, '\\$&' );
};
