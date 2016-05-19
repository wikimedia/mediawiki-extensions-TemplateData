/*!
 * Grunt file
 *
 * @package TemplateData
 */

/*jshint node:true */
module.exports = function ( grunt ) {
	var conf = grunt.file.readJSON( 'extension.json' );

	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-jsonlint' );
	grunt.loadNpmTasks( 'grunt-banana-checker' );
	grunt.loadNpmTasks( 'grunt-jscs' );
	grunt.loadNpmTasks( 'grunt-stylelint' );

	grunt.initConfig( {
		jshint: {
			options: {
				jshintrc: true
			},
			all: [
				'modules/**/*.js',
				'tests/**/*.js'
			]
		},
		jscs: {
			src: '<%= jshint.all %>'
		},
		stylelint: {
			all: [
				'modules/*.css',
				'resources/*.css'
			]
		},
		jsonlint: {
			all: [
				'**/*.json',
				'!node_modules/**'
			]
		},
		banana: conf.MessagesDirs,
		watch: {
			files: [
				'.{stylelintrc,jscsrc,jshintignore,jshintrc}',
				'<%= jshint.all %>',
				'<%= stylelint.all %>'
			],
			tasks: 'test'
		}
	} );

	grunt.registerTask( 'test', [ 'jshint', 'jscs', 'stylelint', 'jsonlint', 'banana' ] );
	grunt.registerTask( 'default', 'test' );
};
