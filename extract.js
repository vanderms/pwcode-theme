let through = require('through2');

function getTagContent(tagName, file){ 
  
  if(file.path.length - file.path.indexOf('.php') != 4){
    return file;
  }
  
  let str = file.contents;  
  let start = 0;  
  let end = 0;

  if(tagName === 'php'){
    const script = str.indexOf('<script');
    const style = str.indexOf('<style');
    if(script > 0 && script < style){
      end = script;
    }
    else if(style > 0 && style < script){
      end= style;
    }
    else {
      return file;
    }
  }
  else {    
    const startTag = `<${tagName}`;
    const endTag = `</${tagName}>`;
    start = str.indexOf(startTag);   
    end = str.indexOf(endTag);
    start = str.indexOf('\n', start + 1) + 1;
  }
 
  if(start === -1){    
    str = '';      
  }
  else if (end == -1){    
    str = ''; 
  }
  else {
    str = str.slice(start, end);
  }

  const strBuffer = Buffer.alloc(str.length, str);
  file.contents = strBuffer;
  return file;
}


module.exports = function extract(tagName){
  return through.obj(function(file, encoding, callback){
    callback(null, getTagContent(tagName, file));
  });
}
