'use strict';

module.exports = function(grunt) {

	grunt.initConfig({

		paths: {
			dev: '.'
		},

		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'<%= paths.dev %>/assets/scripts/src/{,*/}*.js',
				'!<%= paths.dev %>/assets/scripts/src/jquery-fallback.js',
				'!<%= paths.dev %>/assets/scripts/src/plugins/{,*/}*.js'
			]
		},

		uglify: {
			dist: {
				options: {
					sourceMap: '<%= paths.dev %>/assets/scripts/maps/main.js.map',
					sourceMapRoot: '../src/',
					sourceMappingURL: '../maps/main.js.map',
					sourceMapPrefix: '3'
				},
				files: {
					'<%= paths.dev %>/assets/scripts/build/main.min.js': [
						'<%= paths.dev %>/bower_components/jquery/jquery-migrate.min.js',
						'<%= paths.dev %>/bower_components/jquery-fast-click/jQuery.fastClick.js',
						'<%= paths.dev %>/bower_components/jquery-throttle-debounce/jquery.ba-throttle-debounce.js',
						'<%= paths.dev %>/bower_components/jquery.lazyload/jquery.lazyload.js',
						'<%= paths.dev %>/bower_components/chosen/chosen/chosen.jquery.js',
						'<%= paths.dev %>/bower_components/jquery.fitvids/jquery.fitvids.js',
						'<%= paths.dev %>/bower_components/jquery-placeholder/jquery.placeholder.js',
						'<%= paths.dev %>/bower_components/jquery-hoverIntent/jquery.hoverIntent.js',
						'<%= paths.dev %>/assets/scripts/src/plugins/jquery.royalslider.js',
						'<%= paths.dev %>/assets/scripts/src/plugins/royalslider-modules/jquery.rs.auto-height.js',
						'<%= paths.dev %>/assets/scripts/src/plugins/royalslider-modules/jquery.rs.autoplay.js',
						'<%= paths.dev %>/assets/scripts/src/menu.js',
						'<%= paths.dev %>/assets/scripts/src/features.js',
						'<%= paths.dev %>/assets/scripts/src/blog.js',
						'<%= paths.dev %>/assets/scripts/src/main.js'
					],
					'<%= paths.dev %>/assets/scripts/build/faculty.min.js': [
						'<%= paths.dev %>/bower_components/get-style-property/get-style-property.js',
						'<%= paths.dev %>/bower_components/get-size/get-size.js',
						'<%= paths.dev %>/bower_components/isotope/jquery.isotope.js',
						'<%= paths.dev %>/assets/scripts/src/plugins/procession/jquery.procession.js',
						'<%= paths.dev %>/assets/scripts/src/faculty.js'
					],
					'<%= paths.dev %>/assets/scripts/build/jquery-fallback.min.js': [
						'<%= paths.dev %>/assets/scripts/src/jquery-fallback.js'
					],
					'<%= paths.dev %>/assets/scripts/build/admin.min.js': [
						'<%= paths.dev %>/assets/scripts/src/customNavSubheadCheckboxes.js'
					]
				}
			}
		},

		sass: {
			dist: {
				files: {
					'<%= paths.dev %>/assets/styles/build/screen.css': [
						'<%= paths.dev %>/assets/styles/src/screen.scss'
					],
					'<%= paths.dev %>/assets/styles/build/lt-ie8.css': [
						'<%= paths.dev %>/assets/styles/src/lt-ie8.scss'
					]
				}
			}
		},

		autoprefixer: {
			dist: {
				options: {
					browsers: ['last 2 versions']
				},
				files: {
					'<%= paths.dev %>/assets/styles/build/screen.css' : [
						'<%= paths.dev %>/assets/styles/build/screen.css'
					]
				}
			}
		},

		/**
		 * Watching files for changes
		 * https://github.com/gruntjs/grunt-contrib-watch
		 *
		 * To enable live reloading, you'll need:
		 * LiveReload: http://livereload.com/
		 * LiveReload browser extension: http://feedback.livereload.com/knowledgebase/articles/86242-how-do-i-install-and-use-the-browser-extensions-
		 */
		watch: {
			css: {
				files: ['<%= paths.dev %>/assets/styles/src/**/*.scss'],
				tasks: [ 'sass', 'autoprefixer' ]
			},
			scripts: {
				files: ['<%= paths.dev %>/assets/scripts/src/**/*.js'],
				tasks: ['jshint', 'uglify']
			},
			livereload: {
				options: {
					livereload: true
				},
				files: [
					'<%= paths.dev %>/assets/styles/build/**/*.css',
					'<%= paths.dev %>/assets/scripts/build/**/*.js',
					'<%= paths.dev %>/**/*.{html,php}'
				]
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('server', [
		'default',
		'watch'
	]);

	grunt.registerTask('default', [
		'jshint',
		'uglify',
		'sass',
		'autoprefixer'
	]);

};