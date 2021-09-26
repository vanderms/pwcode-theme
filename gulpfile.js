const { src, dest, watch, series, parallel } = require('gulp');
const concat = require('gulp-concat');
const sass = require('gulp-sass')(require('sass'));
const extract = require('./extract');
const cmd = require('node-cmd');


const path = {  
  components : 'src/**/*.php',
  scss: 'src/scss/index.scss',
  js: 'src/js/index.js', 
  images: 'src/images/**/*.{png,jpeg,jpg}' 
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


async function imageTask(){  
  cmd.run('python main.py', function(err, data, stderr){
    console.log(data)
  })
}


//watchers
function watchScssPath(){
  watch([path.scss], scssTask);
}

function watchJsPath(){
  watch([path.js], jsTask);
}

function watchComponentPath(){
  watch([path.components], parallel(jsTask, scssTask, templateTask));
}

function watchImagePath(){
  watch([path.images], imageTask);
}


exports.default = series(
  parallel(scssTask, jsTask, templateTask, imageTask),
  parallel(watchComponentPath, watchImagePath, watchScssPath, watchJsPath)
);