const { src, dest, watch, series, parallel } = require('gulp');
const concat = require('gulp-concat');
const sass = require('gulp-sass')(require('sass'));
const extract = require('./extract');


const PATH = {
  components : 'src/**/*.php',
  scss : 'src/**/*.scss',
  css: ['src/css/font.css', 'src/css/components.css', 'src/css/global.css']
};


function scssComponentTask(){
  return (
    src(PATH.components)
      .pipe(extract('style'))
      .pipe(sass())
      .pipe(concat('components.css'))
      .pipe(dest('src/css'))
  );
}

function scssTask(){
  return (
    src(PATH.scss)
    .pipe(sass())
    .pipe(concat('global.css'))
    .pipe(dest('src/css'))
  );
}

function mergeCssTask(){
  return(
    src(PATH.css)
    .pipe(concat('styles.css'))
    .pipe(dest('assets/css'))
  );
}


function jsComponentTask(){
  return (
    src(PATH.components)
      .pipe(extract('script'))
      .pipe(concat('main.js'))
      .pipe(dest('assets/js'))
  );
}


function phpComponentTask(){
  return(
    src(PATH.components)
      .pipe(extract('template'))
      .pipe(dest('template-parts'))
  );
}


function watchTask(){
  watch([PATH.components], series(
    parallel(scssComponentTask, jsComponentTask, phpComponentTask, scssTask)),    
    mergeCssTask
  );
}


exports.default = series(
  parallel(scssComponentTask, jsComponentTask, phpComponentTask, scssTask), 
  mergeCssTask,
  watchTask
);