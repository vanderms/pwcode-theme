<?php namespace pwcode\com\theme;


//template parts wrappers
function component($name, $args = []){  
  $path = "template-parts/component/" . $name;
  if(file_exists(get_template_directory()."/" . $path .".php")){
    get_template_part($path, null, $args);
    return true;
  }
  return false;
}

function section($name, $args = []){
  $path = "template-parts/section/" . $name;
  if(file_exists(get_template_directory()."/" . $path .".php")){
    get_template_part($path, null, $args);
    return true;
  }
  return false;
}

function page($name, $args = []){  
  $path = "template-parts/page/" . $name;
  if(file_exists(get_template_directory()."/" . $path .".php")){
    get_template_part($path, null, $args);
  return true;
  }
  return false;
}


?>