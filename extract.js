let through = require('through2');


function getTagContent(tag, file){ 
  
  if(file.path.length - file.path.indexOf('.php') != 4){
    return file;
  }
  
  const buf = file.contents;
  const openTag = `<${tag}`;
  const closeTag = `</${tag}>`; 
  
  let start = 0;
  let end = 0;

  if( tag === "template"){
    start = buf.indexOf(openTag);   
    end = buf.lastIndexOf(closeTag);    
  }
  else {
    let searchFrom = buf.lastIndexOf('</template>');
    searchFrom = searchFrom != -1 ? searchFrom : 0;
    start = buf.indexOf(openTag, searchFrom);
    end = buf.indexOf(closeTag, start);
  } 

  let out = "";
 
  if(start !== -1 && end != -1) {
    start = buf.indexOf('\n', start + 1) + 1;
    out = buf.slice(start, end);
    if(tag === "template"){
      out = "<?php namespace pwcode\\com\\theme; ?>\n" + out;
    }
  }
   
  file.contents = Buffer.from(out);
  return file;
}


module.exports = function extract(tag){
  return through.obj(function(file, encoding, callback){
    callback(null, getTagContent(tag, file));
  });
}
