<?php namespace pwcode\com\theme;


//get_template_part wrapper
function module($module, $args = []){
  $path = "template-parts/" . $module;
  get_template_part($path, null, $args);
}


?>