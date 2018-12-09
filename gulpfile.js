'use strict';

var gulp = require('gulp');

var sass = require('gulp-sass');

var autoprefixer = require('gulp-autoprefixer');

var imagemin = require('gulp-imagemin');

gulp.task('sass', function() {
	return gulp.src('sass/style.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(autoprefixer())
	.pipe(gulp.dest(''));

});

gulp.task('sass:watch', function () {
  gulp.watch('style.scss', ['sass']);
});

gulp.task('jpgs', function() {
	return gulp.src('images/*.jpg')
	.pipe(imagemin({progressive: true }))
	.pipe(gulp.dest('img'));
});

