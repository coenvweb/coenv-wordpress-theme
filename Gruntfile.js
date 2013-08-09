'use strict';

var rsyncConfig = require('./rsync-config.json');

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
					//sourceMap
				},
				files: {
					'<%= paths.dev %>/assets/scripts/build/main.min.js': [
						'<%= paths.dev %>/components/jquery/jquery-migrate.min.js',
						'<%= paths.dev %>/components/jquery-fast-click/jQuery.fastClick.js',
						'<%= paths.dev %>/components/jquery-throttle-debounce/jquery.ba-throttle-debounce.js',
						'<%= paths.dev %>/components/jquery.lazyload/jquery.lazyload.js',
						'<%= paths.dev %>/components/chosen/chosen/chosen.jquery.js',
						'<%= paths.dev %>/components/jquery.fitvids/jquery.fitvids.js',
						'<%= paths.dev %>/components/jquery-hoverIntent/jquery.hoverIntent.js',
						'<%= paths.dev %>/assets/scripts/src/plugins/jquery.royalslider.js',
						'<%= paths.dev %>/assets/scripts/src/plugins/royalslider-modules/jquery.rs.auto-height.js',
						'<%= paths.dev %>/assets/scripts/src/plugins/royalslider-modules/jquery.rs.autoplay.js',
						'<%= paths.dev %>/assets/scripts/src/main.js',
						'<%= paths.dev %>/assets/scripts/src/menu.js',
						'<%= paths.dev %>/assets/scripts/src/features.js',
						'<%= paths.dev %>/assets/scripts/src/blog.js'
					],
					'<%= paths.dev %>/assets/scripts/build/faculty.min.js': [
						'<%= paths.dev %>/components/get-style-property/get-style-property.js',
						'<%= paths.dev %>/components/get-size/get-size.js',
						'<%= paths.dev %>/components/isotope/jquery.isotope.js',
						'<%= paths.dev %>/components/procession/jquery.procession.js',
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
				options: {
					sourcemap: true
				},
				files: {
					'<%= paths.dev %>/assets/styles/build/screen.css': [
						'<%= paths.dev %>/assets/styles/src/screen.scss'
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

		watch: {
			css: {
				files: ['<%= paths.dev %>/assets/styles/src/**/*.scss'],
				tasks: [ 'sass' ],
				options: {
					livereload: true
				}
			},
			scripts: {
				files: ['<%= paths.dev %>/assets/scripts/src/**/*.js'],
				tasks: ['jshint', 'uglify'],
				options: {
					livereload: true
				}
			},
			files: {
				files: [
					'<%= paths.dev %>/**/*.{html,php}'
				],
				tasks: [],
				options: {
					livereload: true
				}
			}
		},

		rsync: {
			stage: {
				src: './',
				dest: rsyncConfig.staging.dest,
				host: rsyncConfig.staging.host,
				recursive: true,
				syncDest: false
			},
			deploy: {
				src: './',
				dest: rsyncConfig.deployment.dest,
				host: rsyncConfig.deployment.host,
				recursive: true,
				syncDest: false
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-rsync');

	grunt.registerTask('server', [
		'default',
		'watch'
	]);

	grunt.registerTask('stage', [
		'default',
		'rsync:stage'
	]);

	grunt.registerTask('deploy', [
		'default',
		'rsync:deploy'
	]);

	grunt.registerTask('default', [
		'jshint',
		'uglify',
		'sass',
		'autoprefixer'
	]);

};