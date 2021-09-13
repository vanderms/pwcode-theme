// Initialize modules
const { src, dest, watch, series, parallel } = require('gulp');
const concat = require('gulp-concat');
const sass = require('gulp-sass')(require('sass'));


//file path variables
const PATH = {
  scss: 'src/scss/**/*.scss',
  js: 'src/js/**/*.js'
};

//Sass task
function scssTask(){
  return (src(PATH.scss)
    .pipe(sass())
    .pipe(concat('styles.css'))
    .pipe(dest('assets/css'))
  );
}

//Js task
function jsTask(){
  return (
    src(PATH.js)
      .pipe(concat('main.js'))
      .pipe(dest('assets/js'))
  );
}


//watch task
function watchTask(){
  watch([PATH.scss, PATH.js], parallel(scssTask, jsTask));
}


//default task
exports.default = series(
  parallel(scssTask, jsTask),
  watchTask
);
