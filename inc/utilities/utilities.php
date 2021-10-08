<?php namespace pwcode\com\theme;

//default values




function parse_brackets($text){  
  return str_replace(["{{", "}}"], ["<b>", "</b>"], $text); 
}







?>