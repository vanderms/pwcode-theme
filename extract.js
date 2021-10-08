let through = require('through2');

function getTagContent(tagName, file){ 
  
  if(file.path.length - file.path.indexOf('.php') != 4){
    return file;
  }
  
  const str = file.contents;
  let start = 0;
  let end = 0;

  const startTag = `<${tagName}`;
  const endTag = `</${tagName}>`;

  start = str.indexOf(startTag);   
  end = str.indexOf(endTag);

  let out = "";
 
  if(start !== -1 && end != -1) {
    start = str.indexOf('\n', start + 1) + 1;
    out = str.slice(start, end);
    if(tagName === "template"){
      out = "<?php namespace pwcode\\com\\theme; ?>\n" + out;
    }
  }

  const outBuffer = Buffer.from(out);
  file.contents = outBuffer;
  return file;
}


module.exports = function extract(tagName){
  return through.obj(function(file, encoding, callback){
    callback(null, getTagContent(tagName, file));
  });
}
