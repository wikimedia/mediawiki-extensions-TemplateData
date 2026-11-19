'use strict';

const { defineConfig, globalIgnores } = require( 'eslint/config' );
const wikimedia = require( 'eslint-config-wikimedia/flat' );

// Was `env: { commonjs: true }`. Use after the wikimedia configs, which
// set sourceType to 'script'.
const commonjsConfig = {
	languageOptions: {
		sourceType: 'commonjs',
		globals: {
			global: 'readonly'
		}
	}
};

// Code which runs in MediaWiki
const modulesConfig = [
	...wikimedia( 'client', 'jquery', 'mediawiki' ),
	commonjsConfig
];

// Rules from modules/.eslintrc.json, which tests/qunit also used
const modulesRules = {
	'max-len': 'off',
	'jsdoc/no-undefined-types': 'warn'
};

// Directories with their own config, which other configs don't apply to.
// These were directories with `"root": true` in .eslintrc.json.
const rootDirs = {
	modules: [ 'modules/**' ],
	templateDiscovery: [ 'modules/ext.templateData.templateDiscovery/**' ],
	// Extended modules/.eslintrc.json, so was also root
	qunit: [ 'tests/qunit/**' ],
	selenium: [ 'tests/selenium/**' ]
};

module.exports = defineConfig( [
	globalIgnores( [
		// Upstream code
		'modules/lib/*',
		'modules/lib/*/',
		'!modules/lib/foreign-resources.*',

		// Build
		'vendor/',
		'docs/'
	] ),

	// Gruntfile.js, etc.
	{
		ignores: Object.values( rootDirs ).flat(),
		extends: [ wikimedia( 'server' ) ]
	},

	// Code which runs in MediaWiki
	{
		files: rootDirs.modules,
		ignores: rootDirs.templateDiscovery,
		extends: modulesConfig,
		rules: modulesRules
	},
	{
		files: rootDirs.templateDiscovery,
		extends: modulesConfig,
		rules: {
			'max-len': 'error'
		}
	},

	// Tests
	{
		files: rootDirs.qunit,
		extends: [ wikimedia( 'client', 'jquery', 'mediawiki', 'qunit' ), commonjsConfig ],
		rules: {
			...modulesRules,
			'no-jquery/no-done-fail': 'warn'
		}
	},
	{
		files: rootDirs.selenium,
		extends: [ wikimedia( 'selenium' ) ],
		languageOptions: {
			ecmaVersion: 2021,
			sourceType: 'module',
			globals: {
				mw: 'readonly'
			}
		},
		rules: {
			'prefer-arrow-callback': 'off'
		}
	}
] );
