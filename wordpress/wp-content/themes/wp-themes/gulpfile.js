const gulp = require('gulp');
const gutil = require('gulp-util');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const minifycss = require('gulp-minify-css');
const sassLint = require('gulp-sass-lint');
const uglify = require('gulp-uglify');
const browser = require('browser-sync');
const plumber = require('gulp-plumber');
const doiuse = require('doiuse');
const cssmqpacker = require('css-mqpacker');
const browsers = ['> 3%'];

gulp.task('server', function() {
  return browser({
    server: {
      baseDir: "./"
    }
  });
});

gulp.task('sass', function() {
  return gulp.src('css/*.scss').pipe(sass()).pipe(minifycss()).pipe(gulp.dest('./css'));
});

gulp.task('sasstest', function() {
  return gulp.src('css/*.scss').pipe(plumber()).pipe(sassLint()).pipe(sassLint.format()).pipe(sassLint.failOnError()).pipe(sass()).pipe(autoprefixer({
    browsers: browsers
  })).pipe(minifycss()).pipe(gulp.dest('./css'));
});

gulp.task('js', function() {
  return gulp.src(["js/*.js", "!js/min/*.js"]).pipe(plumber()).pipe(uglify()).pipe(gulp.dest("./js/min"));
});

gulp.task('default', ['server'], function() {
  return gulp.watch("css/*.scss", ["sass"]);
});
