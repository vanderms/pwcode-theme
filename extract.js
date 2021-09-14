let through = require('through2');

function getTagContent(tagName, file){ 
  let str = file.contents.toString();

  const startTag = `<${tagName}`;
  const endTag = `</${tagName}>`;

  let start = str.indexOf(startTag);
  let end = str.indexOf(endTag);
  
  if(start === -1){
    console.log('not found' + startTag);
    str = '';      
  }
  else if (end == -1){
    console.log('not found' + endTag);
    str = ''; 
  }
  else {
    start = str.indexOf('\n', start + 1) + 1;
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
