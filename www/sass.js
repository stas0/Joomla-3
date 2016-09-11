'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
	return gulp.src('./modules/mod_panels/assets/css/main.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./modules/mod_panels/assets/css'));
});

gulp.task('sass:watch', function () {
	gulp.watch('./modules/mod_panels/assets/css/main.scss', ['sass']);
});

gulp.start('sass', 'sass:watch');