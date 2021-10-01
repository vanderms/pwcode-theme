<?php namespace pwcode\com\theme;

add_action('customize_register', function($wp_customize){  

  $wp_customize->add_section('pw-section-cover', [
    'title' => 'Capa',    
    'description' => "Capa é a primeira seção da Homepage"        
  ]);

  //slogan
  $wp_customize->add_setting('pw-section-cover-slogan', [
    'default' => 'CONSTRUINDO {{SUAS IDEIAS}} EM UM {{MUNDO}} DIGITAL',
    'transport' => 'postMessage',
    'sanitize_callback' => function($input){
      return filter_var($input, FILTER_SANITIZE_STRING);
    }
  ]);

  $wp_customize->add_control(new \WP_Customize_Control($wp_customize, 'pw-section-cover-control', [
    'label' => 'Slogan:',
    'description' => 'Para dar ênfase a uma trecho do texto, insira-o entre duas chaves. Ex. {{suas ideias}}',
    'section' => 'pw-section-cover',
    'settings' => 'pw-section-cover-slogan',
    'type' => 'textarea'
  ]));

  $wp_customize->selective_refresh->add_partial('pw-section-cover-slogan-partial', [
    'settings' => 'pw-section-cover-slogan',
    'selector' => '.pw-heading',
    'container_inclusive' => false,
    'render_callback' => function(){
      $slogan = get_theme_mod('pw-section-cover-slogan');
      echo str_replace(["{{", "}}"], ["<span>", "</span>"], $slogan);      
    }
  ]);

});





?>