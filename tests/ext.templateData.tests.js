/**
 * TemplateData Generator GUI Unit Tests
 */

( function () {
	'use strict';

	QUnit.module( 'ext.templateData', QUnit.newMwEnvironment() );

	var i, testVars, finalJsonStringParams, finalJsonStringOnly, finalJsonStringOnlyParamOrder,
		resultDescCurrLang = {},
		resultDescMockLang = {},
		resultDescBothLang = {},
		currLanguage = mw.config.get( 'wgContentLanguage' ) || 'en',
		model = new mw.TemplateData.Model(),
		originalWikitext = 'Some text here that is not templatedata information.' +
			'<templatedata>' +
			'{' +
			'	"description": {\n' +
			'		"' + currLanguage + '": "Label unsigned comments in a conversation.",\n' +
			'		"blah": "Template description in some blah language."\n' +
			'	},' +
			'	"params": {' +
			'		"user": {' +
			'			"label": "Username",' +
			'			"type": "wiki-user-name",' +
			'			"required": true,' +
			'			"description": "User name of person who forgot to sign their comment.",' +
			'			"aliases": ["1"]' +
			'		},' +
			'		"date": {' +
			'			"label": "Date",' +
			'			"description": {' +
			'				"en": "Timestamp of when the comment was posted, in YYYY-MM-DD format."' +
			'			},' +
			'			"aliases": ["2"],' +
			'			"autovalue": "{{subst:CURRENTMONTHNAME}}",' +
			'			"suggested": true' +
			'		},' +
			'		"year": {' +
			'			"label": "Year",' +
			'			"type": "number"' +
			'		},' +
			'		"month": {' +
			'			"label": "Month",' +
			'			"inherits": "year"' +
			'		},' +
			'		"day": {' +
			'			"label": "Day",' +
			'			"inherits": "year"' +
			'		},' +
			'		"comment": {' +
			'			"required": false' +
			'		}' +
			'	},' +
			'	"sets": [' +
			'		{' +
			'			"label": "Date",' +
			'			"params": ["year", "month", "day"]' +
			'		}' +
			'	]' +
			'}' +
			'</templatedata>' +
			'Trailing text at the end.';

	// Prepare description language objects
	resultDescCurrLang[currLanguage] = 'Some string here in ' + currLanguage + ' language.';
	resultDescMockLang.blah = 'Some string here in blah language.';
	resultDescBothLang = $.extend( {}, resultDescCurrLang, resultDescMockLang );
	finalJsonStringParams = '	"params": {\n' +
		'		"user": {\n' +
		'			"label": "Username",\n' +
		'			"type": "wiki-user-name",\n' +
		'			"required": true,\n' +
		'			"description": "User name of person who forgot to sign their comment.",\n' +
		'			"aliases": [\n' +
		'				"1"\n' +
		'			]\n' +
		'		},\n' +
		'		"date": {\n' +
		'			"label": "Date",\n' +
		'			"description": {\n' +
		'				"en": "Timestamp of when the comment was posted, in YYYY-MM-DD format."\n' +
		'			},\n' +
		'			"aliases": [\n' +
		'				"2"\n' +
		'			],\n' +
		'			"autovalue": "{{subst:CURRENTMONTHNAME}}",\n' +
		'			"suggested": true\n' +
		'		},\n' +
		'		"year": {\n' +
		'			"label": "Year",\n' +
		'			"type": "number"\n' +
		'		},\n' +
		'		"month": {\n' +
		'			"label": "Month",\n' +
		'			"inherits": "year"\n' +
		'		},\n' +
		'		"comment": {\n' +
		'			"required": false,\n' +
		'			"type": "wiki-page-name"\n' +
		'		},\n' +
		'		"newParam1": {\n' +
		'			"description": {\n' +
		'				"' + currLanguage + '": "Some string here in ' + currLanguage + ' language.",\n' +
		'				"blah": "Some string here in blah language."\n' +
		'			},\n' +
		'			"required": true\n' +
		'		},\n' +
		'		"newParam2": {},\n' +
		'		"newParam3": {\n' +
		'			"description": "Some string here in ' + currLanguage + ' language."\n' +
		'		},\n' +
		'		"newParam4": {\n' +
		'			"description": {\n' +
		'				"' + currLanguage + '": "' + resultDescBothLang[currLanguage] + '",\n' +
		'				"blah": "' + resultDescBothLang.blah + '"\n' +
		'			}\n' +
		'		}\n' +
		'	},\n';
	finalJsonStringOnly = '{\n' +
		'	"description": {\n' +
		'		"' + currLanguage + '": "Label unsigned comments in a conversation.",\n' +
		'		"blah": "Template description in some blah language."\n' +
		'	},\n' + finalJsonStringParams +
		'	"sets": [\n' +
		'		{\n' +
		'			"label": "Date",\n' +
		'			"params": [\n' +
		'				"year",\n' +
		'				"month",\n' +
		'				"day"\n' +
		'			]\n' +
		'		}\n' +
		'	]\n' +
		'}';
	finalJsonStringOnlyParamOrder = '{\n' +
		'	"description": {\n' +
		'		"' + currLanguage + '": "Label unsigned comments in a conversation.",\n' +
		'		"blah": "Template description in some blah language."\n' +
		'	},\n' + finalJsonStringParams +
		'	"sets": [\n' +
		'		{\n' +
		'			"label": "Date",\n' +
		'			"params": [\n' +
		'				"year",\n' +
		'				"month",\n' +
		'				"day"\n' +
		'			]\n' +
		'		}\n' +
		'	],\n' +
		'	"paramOrder": [\n' +
		'		"date",\n' +
		'		"year",\n' +
		'		"user",\n' +
		'		"month",\n' +
		'		"comment",\n' +
		'		"newParam1",\n' +
		'		"newParam2",\n' +
		'		"newParam3",\n' +
		'		"newParam4"\n' +
		'	]\n' +
		'}';

	// Test validation tools
	QUnit.test( 'Validation tools', function ( assert ) {
		var tests = {
				'compare': [
					{
						obj1: {},
						obj2: [],
						result: false,
						msg: 'Compare: object vs array'
					},
					{
						obj1: null,
						obj2: undefined,
						result: false,
						msg: 'Compare: null vs undefined'
					},
					{
						obj1: 'string',
						obj2: undefined,
						result: false,
						msg: 'Compare: string vs undefined'
					},
					{
						obj1: undefined,
						obj2: undefined,
						result: true,
						msg: 'Compare: undefined vs undefined'
					},
					{
						obj1: null,
						obj2: null,
						result: true,
						msg: 'Compare: null vs null'
					},
					{
						obj1: 'A proper string.',
						obj2: 'A proper string.',
						result: true,
						msg: 'Compare: strings'
					},
					{
						obj1: true,
						obj2: true,
						result: true,
						msg: 'Compare: booleans'
					},
					{
						obj1: { 1: 'string', 2: 'another', 4: 'and another' },
						obj2: { 1: 'string', 2: 'another', 4: 'and another' },
						result: true,
						allowSubset: true,
						msg: 'Compare: plain object full equality'
					},
					{
						obj1: { 1: 'string', 2: 'another', 4: 'and another' },
						obj2: { 1: 'another', 2: 'and another', 4: 'string' },
						result: false,
						allowSubset: true,
						msg: 'Compare: plain object full inequality'
					},
					{
						obj1: { 1: 'string', 2: 'another', 4: 'and another' },
						obj2: { 4: 'and another' },
						result: true,
						allowSubset: true,
						msg: 'Compare: plain object subset equality'
					},
					{
						obj1: [ 'val1', 'val2', 'val3' ],
						obj2: [ 'val1', 'val2', 'val3' ],
						result: true,
						msg: 'Compare: arrays'
					},
					{
						obj1: [ 'val1', 'val2', 'val3' ],
						obj2: [ 'val1' ],
						result: true,
						allowSubset: true,
						msg: 'Compare: array subset: true'
					},
					{
						obj1: [ 'val1', 'val2', 'val3' ],
						obj2: [ 'val1' ],
						result: false,
						allowSubset: false,
						msg: 'Compare: array subset: false'
					},
					{
						obj1: {
							param1: {
								type: 'undefined',
								aliases: [ 'alias2', 'alias1', 'alias3' ],
								description: 'Some description',
								required: true,
								suggested: false
							},
							param2: {
								required: true
							}
						},
						obj2: {
							param1: {
								type: 'undefined',
								aliases: [ 'alias2', 'alias1', 'alias3' ],
								description: 'Some description',
								required: true,
								suggested: false
							},
							param2: {
								required: true
							}
						},
						result: true,
						allowSubset: true,
						msg: 'Compare: complex objects'
					},
					{
						obj1: {
							param1: {
								type: 'undefined',
								aliases: [ 'alias1', 'alias2', 'alias3' ],
								description: 'Some description',
								required: true,
								suggested: false
							},
							param2: {
								required: true
							}
						},
						obj2: {
							param1: {
								aliases: [ 'alias1', 'alias2', 'alias3' ],
								suggested: false
							}
						},
						result: true,
						allowSubset: true,
						msg: 'Compare: complex objects subset'
					}
				],
				'splitAndTrimArray': [
					{
						string: 'str1 , str2 ',
						delim: ',',
						result: [ 'str1', 'str2' ],
						msg: 'splitAndTrimArray: split and trim'
					},
					{
						string: 'str1, str2, , , , str3',
						delim: ',',
						result: [ 'str1', 'str2', 'str3' ],
						msg: 'splitAndTrimArray: remove empty values'
					},
					{
						string: 'str1|str2|str3',
						delim: '|',
						result: [ 'str1', 'str2', 'str3' ],
						msg: 'splitAndTrimArray: different delimeter'
					}
				],
				'arrayUnionWithoutEmpty': [
					{
						arrays: [ [ 'en', 'he', '' ], [ 'he', 'de', '' ], [ 'en', 'de' ] ],
						result: [ 'en', 'he', 'de' ],
						msg: 'arrayUnionWithoutEmpty: Remove duplications'
					},
					{
						arrays: [ [ 'en', '', '' ], [ 'he', '', '' ], [ 'de', '' ] ],
						result: [ 'en', 'he', 'de' ],
						msg: 'arrayUnionWithoutEmpty: Remove empty values'
					}
				],
				'props': {
					'all': [
						'name',
						'aliases',
						'label',
						'description',
						'type',
						'default',
						'autovalue',
						'deprecated',
						'required',
						'suggested'
					],
					'language': [
						'label',
						'description'
					]
				}
			};

		QUnit.expect(
			tests.compare.length +
			tests.splitAndTrimArray.length +
			tests.arrayUnionWithoutEmpty.length +
			Object.keys( tests.props ).length
		);

		// Compare
		for ( i = 0; i < tests.compare.length; i++ ) {
			testVars = tests.compare[i];
			assert.equal(
				mw.TemplateData.Model.static.compare( testVars.obj1, testVars.obj2, testVars.allowSubset ),
				testVars.result,
				testVars.msg
			);
		}

		// Split and trim
		for ( i = 0; i < tests.splitAndTrimArray.length; i++ ) {
			testVars = tests.splitAndTrimArray[i];
			assert.deepEqual(
				mw.TemplateData.Model.static.splitAndTrimArray( testVars.string, testVars.delim ),
				testVars.result,
				testVars.msg
			);
		}

		// arrayUnionWithoutEmpty
		for ( i = 0; i < tests.arrayUnionWithoutEmpty.length; i++ ) {
			testVars = tests.arrayUnionWithoutEmpty[i];
			assert.deepEqual(
				mw.TemplateData.Model.static.arrayUnionWithoutEmpty.apply( testVars, testVars.arrays ),
				testVars.result,
				testVars.msg
			);
		}

		// Props
		assert.deepEqual(
			mw.TemplateData.Model.static.getAllProperties( false ),
			tests.props.all,
			'All properties'
		);
		assert.deepEqual(
			mw.TemplateData.Model.static.getPropertiesWithLanguage(),
			tests.props.language,
			'Language properties'
		);
	} );

	// Test model load
	QUnit.asyncTest( 'TemplateData model', function ( assert ) {
		var i,
			paramAddTest = [
				{
					key: 'newParam1',
					data: { required: true },
					result: { name: 'newParam1', required: true },
					description: '',
					msg: 'Adding a simple parameter.'
				},
				{
					key: 'newParam2',
					data: null,
					result: { name: 'newParam2' },
					description: '',
					msg: 'Adding new parameter without data.'
				},
				{
					key: 'newParam3',
					data: { description: 'Some string here in ' + currLanguage + ' language.' },
					result: { name: 'newParam3', description: resultDescCurrLang },
					description: 'Some string here in ' + currLanguage + ' language.',
					msg: 'Adding parameter with language prop: original without language.'
				},
				{
					key: 'newParam4',
					data: {
						description: resultDescBothLang
					},
					result: { name: 'newParam4', description: resultDescBothLang },
					description: 'Some string here in ' + currLanguage + ' language.',
					msg: 'Adding parameter with language prop: original with multiple languages.'
				}
			],
			paramChangeTest = [
				{
					key: 'newParam1',
					property: 'description',
					language: 'en',
					value: resultDescCurrLang[currLanguage],
					result: $.extend( {}, paramAddTest[0].result, {
						description: resultDescCurrLang
					} ),
					msg: 'Adding description in current language.'
				},
				{
					key: 'newParam1',
					property: 'description',
					language: 'blah',
					value: resultDescMockLang.blah,
					result: $.extend( {}, paramAddTest[0].result, {
						description: $.extend( {}, resultDescCurrLang, resultDescMockLang )
					} ),
					msg: 'Adding description in mock language.'
				},
				{
					key: 'comment',
					property: 'type',
					value: 'wiki-page-name',
					result: {
						name: 'comment',
						type: 'wiki-page-name',
						required: false
					},
					msg: 'Adding type to comment.'
				},
				{
					key: 'newParam2',
					property: 'description',
					language: 'blah',
					value: '',
					result: $.extend( {}, paramAddTest[1].result, {
						description: { 'blah': '' }
					} ),
					msg: 'Adding empty description in mock language.'
				}
			];

		QUnit.expect(
			// Description and parameter list
			3 +
			// Add parameter tests
			2 * paramAddTest.length +
			// Change properties tests
			paramChangeTest.length +
			// Json output
			2
		);

		model.loadModel( originalWikitext )
			.done( function () {

				// Check description
				assert.equal(
					model.getTemplateDescription(),
					'Label unsigned comments in a conversation.',
					'Description in default language.'
				);
				assert.equal(
					model.getTemplateDescription( 'blah' ),
					'Template description in some blah language.',
					'Description in mock language.'
				);

				// Check parameters
				assert.deepEqual(
					Object.keys( model.getParams() ),
					[ 'user', 'date', 'year', 'month', 'day', 'comment' ],
					'Parameters retention.'
				);

				for ( i = 0; i < paramAddTest.length; i++ ) {
					// Add parameter
					model.addParam( paramAddTest[i].key, paramAddTest[i].data );

					// Test new param data
					assert.deepEqual(
						model.getParamData( paramAddTest[i].key ),
						paramAddTest[i].result,
						paramAddTest[i].msg + ' (parameter data)'
					);

					// Check description in current language
					assert.equal(
						model.getParamDescription( paramAddTest[i].key, currLanguage ),
						paramAddTest[i].description,
						paramAddTest[i].msg + ' (description in current language)'
					);
				}

				// Change parameter properties
				for ( i = 0; i < paramChangeTest.length; i++ ) {
					testVars = paramChangeTest[i];
					model.setParamProperty( testVars.key, testVars.property, testVars.value, testVars.language );
					assert.deepEqual(
						model.getParamData( testVars.key ),
						paramChangeTest[i].result,
						paramChangeTest[i].msg
					);
				}

				// Delete parameter
				model.deleteParam( 'day' );

				// Ouput a final templatedata string
				assert.equal(
					model.outputTemplateDataString(),
					finalJsonStringOnly,
					'Final templatedata output'
				);

				// Change order and verify result now has paramOrder
				model.reorderParamOrderKey( 'user', 2 );
				// Ouput a final templatedata string
				assert.equal(
					model.outputTemplateDataString(),
					finalJsonStringOnlyParamOrder,
					'Final templatedata output with paramOrder'
				);

			} )
			.always( function () {
				QUnit.start();
			} );
	} );

}() );
