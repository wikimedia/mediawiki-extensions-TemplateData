<?php
class TemplateDataBlobTest extends MediaWikiTestCase {

	protected function setUp() {
		parent::setUp();

		$this->setMwGlobals( array(
			'wgLanguageCode' => 'en',
			'wgContLang' => Language::factory( 'en' ),
		) );
	}

	public static function provideParse() {
		return array(
			array(
				'
				{}
				',
				'
				{}
				',
				'Empty object'
			),
			array(
				'
				{
					"foo": "bar"
				}
				',
				'
				{}
				',
				'Unknown properties are stripped'
			),
			array(
				'
				{
					"params": {
						"foo": {}
					}
				}
				',
				'
				{
					"description": null,
					"params": {
						"foo": {
							"label": null,
							"description": null,
							"default": "",
							"required": false,
							"deprecated": false,
							"aliases": [],
							"type": "unknown"
						}
					}
				}
				',
				'Optional properties are added if missing'
			),
			array(
				'
				{
					"description": "User badge MediaWiki developers.",
					"params": {
						"nickname": {
							"label": null,
							"description": "User name of user who owns the badge",
							"default": "Base page name of the host page",
							"required": false,
							"aliases": [
								"1"
							]
						}
					}
				}
				',
				'
				{
					"description": {
						"en": "User badge MediaWiki developers."
					},
					"params": {
						"nickname": {
							"label": null,
							"description": {
								"en": "User name of user who owns the badge"
							},
							"default": "Base page name of the host page",
							"required": false,
							"deprecated": false,
							"aliases": [
								"1"
							],
							"type": "unknown"
						}
					}
				}
				',
				'InterfaceText is expanded to langcode-keyed object, assuming content language'
			),
			array(
				'
				{
					"description": {
						"en": "User badge MediaWiki developers."
					},
					"params": {
						"nickname": {
							"label": null,
							"description": {
								"en": "User name of user who owns the badge"
							},
							"default": "Base page name of the host page",
							"required": false,
							"deprecated": false,
							"aliases": [
								"1"
							],
							"type": "unknown"
						}
					}
				}
				',
				'Fully normalised json should be valid input and stay unchanged'
			),
			array(
				'
				{
					"description": "Document the documenter.",
					"params": {
						"1d": {
							"description": "Description of the template parameter",
							"required": true,
							"default": "example"
						},
						"2d": {
							"inherits": "1d",
							"default": "overridden"
						}
					}
				}
				',
				'
				{
					"description": {
						"en": "Document the documenter."
					},
					"params": {
						"1d": {
							"label": null,
							"description": {
								"en": "Description of the template parameter"
							},
							"required": true,
							"default": "example",
							"deprecated": false,
							"aliases": [],
							"type": "unknown"
						},
						"2d": {
							"label": null,
							"description": {
								"en": "Description of the template parameter"
							},
							"required": true,
							"default": "overridden",
							"deprecated": false,
							"aliases": [],
							"type": "unknown"
						}
					}
				}
				',
				'The inherits property copies over properties from another parameter (preserving overides)'
			),
		);
	}

	/**
	 * @dataProvider provideParse
	 */
	public function testParse( $input, $expected, $msg = null ) {
		if ( !$msg ) {
			$msg = $expected;
			$expected = $input;
		}
		$t = TemplateDataBlob::newFromJSON( $input );
		$actual = $t->getJSON();
		$this->assertJsonStringEqualsJsonString(
			$expected,
			$actual,
			$msg
		);
	}

	public static function provideStatus() {
		return array(
			array(
				'
				[]
				',
				false,
				'Not an object'
			),
			array(
				'
				{
					"params": {}
				}
				',
				true,
				'Minimal valid blob'
			),
			array(
				'
				{
					"params": {},
					"foo": "bar"
				}
				',
				false,
				'Unknown properties'
			),
		);
	}

	/**
	 * @dataProvider provideStatus
	 */
	public function testStatus( $inputJSON, $isGood, $msg ) {
		// Make sure we don't have two errors cancelling each other out
		if ( json_decode( $inputJSON ) === null ) {
			throw new Exception( 'Test case provided invalid JSON.' );
		}

		$t = TemplateDataBlob::newFromJSON( $inputJSON );
		$status = $t->getStatus();

		$this->assertEquals(
			$status->isGood(),
			$isGood,
			$msg
		);
	}
}
