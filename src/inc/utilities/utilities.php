<?php namespace pwcode\com\theme;


function create_customize_identifiers($section, $field){
  return [
    'section' => $section,
    'settings' => "$section-$field",
    'control' => "$section-$field-control",
    'partial' => "$section-$field-partial",
  ];
}


function parse_to_span_template($text){
  return str_replace(["{{", "}}"], ["<span>", "</span>"], $text); 
  
}


?>