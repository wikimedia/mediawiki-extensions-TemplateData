/**
 * TemplateData Generator GUI Unit Tests
 */

( function ( $, mw ) {
	'use strict';

	QUnit.module( 'ext.templateData', QUnit.newMwEnvironment() );

	var wikitext = 'Some initial test sentence.\n' +
		'<templatedata>\n' +
		'{\n' +
		'	"description": "This is a description of the template.",\n' +
		'	"params": {\n' +
		'		"user": {\n' +
		'			"label": "Username",\n' +
		'			"type": "string/wiki-user-name",\n' +
		'			"default": "some default value here.",\n' +
		'			"required": true,\n' +
		'			"description": "User name of person who forgot to sign their comment.",\n' +
		'			"aliases": ["1"]\n' +
		'		},\n' +
		'		"date": {\n' +
		'			"label": "Date",\n' +
		'			"aliases": ["2", "3"]\n' +
		'		},\n' +
		'		"year": {\n' +
		'			"label": "Year",\n' +
		'			"type": "number"\n' +
		'		},\n' +
		'		"comment": {\n' +
		'			"required": false\n' +
		'		}\n' +
		'	}\n' +
		'}\n' +
		'</templatedata>\n' +
		'Some following sentence.';

	QUnit.test( 'TemplateData modal display', 11, function ( assert ) {
		var $modalBox, tmplDataGenTest1;

		tmplDataGenTest1 = mw.libs.templateDataGenerator;
		tmplDataGenTest1.init();

		$modalBox = tmplDataGenTest1.createModal( wikitext );

		// Tests
		assert.equal(
			$modalBox.find( '.tdg-template-description' ).val(),
			'This is a description of the template.',
			'Template description'
		);

		assert.equal(
			$modalBox.find( '.tdg-element-attr-name' ).length,
			4,
			'Number of parameters in edit modal table.'
		);

		// Check for proper parsing
		assert.equal(
			$modalBox.find( '#param-user .tdg-element-attr-name' ).val(),
			'user',
			'Parameter details: name.'
		);

		assert.equal(
			$modalBox.find( '#param-date .tdg-element-attr-aliases' ).val(),
			'2,3',
			'Parameter details: aliases (multiple).'
		);

		assert.equal(
			$modalBox.find( '#param-user .tdg-element-attr-aliases' ).val(),
			'1',
			'Parameter details: aliases (single).'
		);

		assert.equal(
			$modalBox.find( '#param-user .tdg-element-attr-label' ).val(),
			'Username',
			'Parameter details: label.'
		);

		assert.equal(
			$modalBox.find( '#param-user .tdg-element-attr-description' ).val(),
			'User name of person who forgot to sign their comment.',
			'Parameter details: description.'
		);

		assert.equal(
			$modalBox.find( '#param-user .tdg-element-attr-type' ).val(),
			'string/wiki-user-name',
			'Parameter details: type.'
		);

		assert.equal(
			$modalBox.find( '#param-user .tdg-element-attr-default' ).val(),
			'some default value here.',
			'Parameter details: default.'
		);

		assert.equal(
			$modalBox.find( '#param-user .tdg-element-attr-required' ).prop( 'checked' ),
			true,
			'Parameter details: required.'
		);

		assert.equal(
			$modalBox.find( '#param-year .tdg-element-attr-required' ).prop( 'checked' ),
			false,
			'Parameter details: non required.'
		);

	} );

	QUnit.test( 'TemplateData JSON manipulation', 4, function ( assert ) {
		var $modalDomElements, parsedJson, expectedTextResult,
			exampleJson, changedParsedJson, reparsedJson,
			tmplDataGenTest2 = mw.libs.templateDataGenerator,
			origText = 'Some initial test sentence.\n' +
				'<templatedata>\n' +
				'{\n' +
				'	"description": "This is a description of the template.",\n' +
				'	"params": {\n' +
				'		"user": {\n' +
				'			"label": "Username",\n' +
				'			"type": "string/wiki-user-name",\n' +
				'			"default": "some default value here.",\n' +
				'			"required": true,\n' +
				'			"description": "User name of person who forgot to sign their comment.",\n' +
				'			"aliases": ["1"]\n' +
				'		},\n' +
				'		"date": {\n' +
				'			"label": "Date",\n' +
				'			"aliases": ["2", "3"]\n' +
				'		},\n' +
				'		"year": {\n' +
				'			"label": "Year",\n' +
				'			"type": "number"\n' +
				'		},\n' +
				'		"comment": {\n' +
				'			"required": false,\n' +
				'			"somethingelse": "this should stay"\n' +
				'		}\n' +
				'	},\n' +
				'	"testing": {\n' +
				'		"something": {\n' +
				'			"completely": "random"\n' +
				'		}\n' +
				'	}\n' +
				'}\n' +
				'</templatedata>\n' +
				'Some following sentence.';

		parsedJson = tmplDataGenTest2.parseTemplateData( origText );

		assert.equal(
			parsedJson.testing.something.completely,
			'random',
			'Parse original JSON and preserve all data.'
		);

		// Copy the parsed JSON object so we can manually
		// manipulate it
		changedParsedJson = $.extend( true, {}, parsedJson );

		// Partial dom elements on purpose, to make sure
		// that the rest of the json object, even fields that are
		// not represented in the dom elements, are preserved
		$modalDomElements = {
			'user': {
				'name': $( '<input>' ).val( 'user' ),
				'label': $( '<input>' ).val( 'changed to another label' )
			}
		};

		// Manually change the object we copied earlier to test against
		changedParsedJson.params.user.label = 'changed to another label';

		assert.deepEqual(
			mw.libs.templateDataGenerator.applyChangesToJSON( parsedJson, $modalDomElements, true ),
			changedParsedJson,
			'Preserve parameters on edit.'
		);

		// Name change
		// Notice, parsedJson also had its user.label change, so we have
		// to do the same to our new test and change both label and name.
		$modalDomElements = {
			'user': {
				'name': $( '<input>' ).val( 'anotherName' ),
				'label': $( '<input>' ).val( 'changed to another label' )
			}
		};

		// Copy the parsed JSON object so we can manually
		// manipulate it
		changedParsedJson = $.extend( true, {}, parsedJson );
		changedParsedJson.params.anotherName = {};
		$.extend( true, changedParsedJson.params.anotherName, parsedJson.params.user );
		delete changedParsedJson.params.user;

		// Re-parse the json so we can manipulate it in exampleJson
		reparsedJson = mw.libs.templateDataGenerator.parseTemplateData( origText );

		// Get the system's response to changing the name
		exampleJson = mw.libs.templateDataGenerator.applyChangesToJSON( reparsedJson, $modalDomElements, true );

		assert.deepEqual(
			exampleJson,
			changedParsedJson,
			'Change parameter name.'
		);

		// Back to wikitext
		// Since 'parsedJson' was changed in previous tests, we'll use it

		expectedTextResult = 'Some initial test sentence.\n' +
			'<templatedata>\n' +
			'{\n' +
			'	"description": "This is a description of the template.",\n' +
			'	"params": {\n' +
			'		"date": {\n' +
			'			"label": "Date",\n' +
			'			"aliases": [\n' +
			'				"2",\n' +
			'				"3"\n' +
			'			]\n' +
			'		},\n' +
			'		"year": {\n' +
			'			"label": "Year",\n' +
			'			"type": "number"\n' +
			'		},\n' +
			'		"comment": {\n' +
			'			"required": false,\n' +
			'			"somethingelse": "this should stay"\n' +
			'		},\n' +
			'		"anotherName": {\n' +
			'			"label": "changed to another label",\n' +
			'			"type": "string/wiki-user-name",\n' +
			'			"default": "some default value here.",\n' +
			'			"required": true,\n' +
			'			"description": "User name of person who forgot to sign their comment.",\n' +
			'			"aliases": [\n' +
			'				"1"\n' +
			'			]\n' +
			'		}\n' +
			'	},\n' +
			'	"testing": {\n' +
			'		"something": {\n' +
			'			"completely": "random"\n' +
			'		}\n' +
			'	}\n' +
			'}\n' +
			'</templatedata>\n' +
			'Some following sentence.';

		// Using 'exampleJson' with the previous name change and label change
		assert.equal(
			mw.libs.templateDataGenerator.amendWikitext( exampleJson, origText ),
			expectedTextResult,
			'Returning edited json into original wikitext.'
		);

	} );

}( jQuery, mediaWiki ) );
