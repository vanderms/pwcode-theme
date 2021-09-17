const { src, dest, watch, series, parallel } = require('gulp');
const concat = require('gulp-concat');
const sass = require('gulp-sass')(require('sass'));
const extract = require('./extract');


const path = {
  components : 'src/**/*.php',
  scss: 'src/scss/index.scss',
  js: 'src/js/index.js'
};


function scssTask(){
  return (
    src([path.scss, path.components])
      .pipe(extract('style'))
      .pipe(sass())
      .pipe(concat('styles.css'))
      .pipe(dest('assets/css'))
  );
}


function jsTask(){
  return (
    src([path.js, path.components])
      .pipe(extract('script'))
      .pipe(concat('main.js'))
      .pipe(dest('assets/js'))
  );
}


function templateTask(){
  return(
    src(path.components)
      .pipe(extract('php'))
      .pipe(dest('template-parts'))
  );
}


function watchTask(){
  watch([path.components, path.scss, path.js], parallel(scssTask, jsTask, templateTask));
}


exports.default = series(
  parallel(scssTask, jsTask, templateTask),
  watchTask
);