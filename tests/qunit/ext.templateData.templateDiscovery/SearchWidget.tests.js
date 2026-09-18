'use strict';

const SearchWidget = require( 'ext.templateData.templateDiscovery/SearchWidget.js' );

QUnit.module( 'ext.templateData.templateDiscovery.SearchWidget', QUnit.newMwEnvironment() );

function newSearchWidget() {
	return new SearchWidget( {
		favoritesStore: {},
		api: { get: () => $.Deferred().resolve( { pages: {} } ).promise( { abort: () => {} } ) }
	} );
}

QUnit.test( 'A subst: magic word is not part of the search query', ( assert ) => {
	const widget = newSearchWidget();

	[
		[ 'Sakujo', '', 'Sakujo' ],
		[ 'subst:Sakujo', 'subst:', 'Sakujo' ],
		[ 'SUBST:Sakujo', 'SUBST:', 'Sakujo' ],
		[ 'safesubst:Sakujo', 'safesubst:', 'Sakujo' ],
		[ ' subst: Sakujo', 'subst:', 'Sakujo' ],
		[ 'subst:', 'subst:', '' ],
		[ 'Substitution', '', 'Substitution' ]
	].forEach( ( [ value, expectedPrefix, expectedQuery ] ) => {
		widget.setValue( value );
		assert.strictEqual( widget.getSubstPrefix(), expectedPrefix, value + ' prefix' );
		assert.strictEqual( widget.getSearchQuery(), expectedQuery, value + ' query' );
	} );
} );

QUnit.test( 'A chosen search result keeps the subst: magic word', ( assert ) => {
	const widget = newSearchWidget();
	const templateData = { title: 'Template:Sakujo' };
	const item = {
		getLabel: () => 'Sakujo',
		getData: () => templateData
	};

	let chosen = null;
	widget.on( 'choose', ( data ) => {
		chosen = data;
	} );

	widget.setValue( 'subst:Sakujo' );
	widget.onLookupMenuChoose( item );

	assert.strictEqual( widget.getValue(), 'subst:Sakujo', 'magic word stays in the input' );
	assert.deepEqual( chosen, { title: 'Template:Sakujo', substPrefix: 'subst:' } );
	assert.deepEqual( templateData, { title: 'Template:Sakujo' }, 'cached data is untouched' );

	widget.setValue( 'Sakujo' );
	widget.onLookupMenuChoose( item );

	assert.strictEqual( chosen, templateData, 'data is passed on unchanged without a magic word' );
} );

QUnit.test( 'The enter key keeps the subst: magic word', ( assert ) => {
	const widget = newSearchWidget();

	let chosen = null;
	widget.on( 'choose', ( data ) => {
		chosen = data;
	} );

	widget.setValue( 'subst:Sakujo' );
	widget.onEnterKeyPress();

	assert.deepEqual( chosen, {
		title: 'Template:Sakujo',
		missing: true,
		substPrefix: 'subst:'
	} );

	chosen = null;
	widget.setValue( 'subst:' );
	widget.onEnterKeyPress();

	assert.strictEqual( chosen, null, 'a magic word alone is not a template name' );
} );
