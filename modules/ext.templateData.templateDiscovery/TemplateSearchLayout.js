const FavoritesStore = require( './FavoritesStore.js' );
const SearchWidget = require( './SearchWidget.js' );
const TemplateList = require( './TemplateList.js' );

/**
 * @class
 * @extends OO.ui.PanelLayout
 *
 * @constructor
 * @param {Object} [config] Configuration options.
 */
function TemplateSearchLayout( config ) {
	config = Object.assign( {
		padded: true,
		expanded: true
	}, config );
	TemplateSearchLayout.super.call( this, config );

	const favoritesStore = new FavoritesStore();

	this.matchedTemplateData = null;
	// @todo Inject favoriteStore to SearchWidget
	this.searchWidget = new SearchWidget( {}, this );
	this.searchWidget.connect( this, {
		change: 'onTemplateInputChange',
		match: 'onTemplateInputMatch',
		choose: 'onAddTemplate'
	} );
	this.searchWidget.getMenu().connect( this, { choose: 'onAddTemplate' } );

	this.searchButton = new OO.ui.ButtonWidget( {
		label: mw.msg( 'templatedata-search-button' ),
		flags: [ 'progressive' ],
		disabled: true
	} );
	this.searchButton.connect( this, {
		click: function () {
			this.onAddTemplate( this.matchedTemplateData );
		}
	} );

	const field = new OO.ui.ActionFieldLayout(
		this.searchWidget,
		this.searchButton,
		{
			label: mw.msg( 'templatedata-search-description' ),
			align: 'top'
		}
	);

	// By design, this is a tab bar with just a single tab.
	const tabLayout = new OO.ui.IndexLayout( {
		expanded: false,
		framed: false,
		classes: [ 'ext-templatedata-search-tabs' ]
	} );

	const templateList = new TemplateList( { favoritesStore: favoritesStore } );
	templateList.connect( this, { choose: 'onAddTemplate' } );
	tabLayout.addTabPanels( [ templateList ] );

	const searchFieldset = new OO.ui.FieldsetLayout( {
		label: mw.msg( 'templatedata-search-title' ),
		icon: 'puzzle',
		items: [ field, tabLayout ]
	} );

	this.$element
		.addClass( 'ext-templatedata-search' )
		.append( $( '<div>' )
			.append(
				searchFieldset.$element
			)
		);
}

/* Setup */

OO.inheritClass( TemplateSearchLayout, OO.ui.PanelLayout );

/* Events */

/**
 * When a template is choosen by searching or other means.
 *
 * @event choose
 * @param {Object} The template data of the chosen template.
 */

/* Methods */

TemplateSearchLayout.prototype.onTemplateInputChange = function () {
	this.matchedTemplateData = null;
	this.searchButton.setDisabled( true );
};

TemplateSearchLayout.prototype.onTemplateInputMatch = function ( data ) {
	this.matchedTemplateData = data;
	this.searchButton.setDisabled( false );
};

/**
 * @fires choose
 * @param {Object} data The texmplate data of the choosen template
 */
TemplateSearchLayout.prototype.onAddTemplate = function ( data ) {
	if ( !data ) {
		return;
	}
	this.emit( 'choose', data );
};

TemplateSearchLayout.prototype.focus = function () {
	this.searchWidget.$input.trigger( 'focus' );
};

module.exports = TemplateSearchLayout;
