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
					"description": {
						"en": ""
					},
					"params": {
						"foo": {
							"description": {
								"en": ""
							},
							"default": "",
							"required": false,
							"deprecated": false,
							"aliases": [],
							"clones": []
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
							"description": {
								"en": "User name of user who owns the badge"
							},
							"default": "Base page name of the host page",
							"required": false,
							"deprecated": false,
							"aliases": [
								"1"
							],
							"clones": []
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
							"description": {
								"en": "User name of user who owns the badge"
							},
							"default": "Base page name of the host page",
							"required": false,
							"deprecated": false,
							"aliases": [
								"1"
							],
							"clones": []
						}
					}
				}
				',
				'Fully normalised json should be valid input and stay unchanged'
			)
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
