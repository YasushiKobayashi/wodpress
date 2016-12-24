gulp = require 'gulp'
gutil = require 'gulp-util'
sass = require 'gulp-sass'
autoprefixer = require 'gulp-autoprefixer'
minifycss = require 'gulp-minify-css'
sassLint = require 'gulp-sass-lint'
uglify = require 'gulp-uglify'
browser = require 'browser-sync'
plumber = require 'gulp-plumber'
doiuse = require 'doiuse'
cssmqpacker = require 'css-mqpacker'
browsers = ['> 3%']

gulp.task 'server', ->
  browser
    server:
      baseDir: "./"

gulp.task 'sass', ->
  gulp.src('css/*.scss')
    .pipe sass()
      .pipe minifycss()
        .pipe gulp.dest('./css')


gulp.task 'sasstest', ->
  gulp.src('css/*.scss')
    .pipe(plumber())
    # .pipe(sassLint(
    #   'reporterOutputFormat': 'Checkstyle',
    #   'filePipeOutput': 'scssReport.xml'
    # ))
    .pipe(sassLint())
    .pipe(sassLint.format())
    .pipe(sassLint.failOnError())
    .pipe sass()
    # .pipe(doiuse(browsers: browsers))
    .pipe(autoprefixer(browsers: browsers))
    # .pipe(cssmqpacker)
    .pipe minifycss()
    .pipe gulp.dest('./css')

gulp.task 'js', ->
  gulp.src(["js/*.js","!js/min/*.js"])
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest("./js/min"))

gulp.task 'default', ['server'], ->
  # gulp.watch(["js/**/*.js","!js/min/**/*.js"],["js"])
  gulp.watch("css/*.scss", ["sass"])
