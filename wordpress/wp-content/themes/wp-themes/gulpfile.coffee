gulp = require 'gulp'
gutil = require 'gulp-util'
sass = require 'gulp-sass'
minifycss = require 'gulp-minify-css'
scsslint = require 'gulp-scss-lint'

gulp.task 'lint', ->
  gulp.src('css/*.scss')
    .pipe(scsslint({
      'reporterOutputFormat': 'Checkstyle',
      'bundleExec': true,
      'reporterOutput': 'scssReport.json',
      'config': './scss-lint.yml'
    }))
    .pipe(scsslint.failReporter())

gulp.task 'sass', ->
  gulp.src('css/*.scss')
    .pipe sass()
      .pipe minifycss()
        .pipe gulp.dest('./css')
