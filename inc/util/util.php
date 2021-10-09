<?php namespace pwcode\com\theme;


//template parts wrappers
function component($name, $args = []){
  $path = "template-parts/component/" . $name;
  get_template_part($path, null, $args);
}

function section($name, $args = []){
  $path = "template-parts/section/" . $name;
  get_template_part($path, null, $args);
}

function page($name, $args = []){
  $path = "template-parts/page/" . $name;
  get_template_part($path, null, $args);
}


?>