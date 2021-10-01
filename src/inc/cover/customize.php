<?php namespace pwcode\com\theme;
require_once get_template_directory() .'/src/inc/utilities/utilities.php';


add_action('customize_register', function($wp_customize){

  $section = 'pw-section-cover';

  $wp_customize->add_section($section, [
    'title' => 'Capa',    
    'description' => "Capa é a primeira seção da Homepage"        
  ]);

  customize_title($wp_customize, $section);
  customize_slogan($wp_customize, $section);
  

});


function customize_title($wp_customize, $section){   
  
  $field = 'title';
  $container = '.pw-sub-heading';
  $ids = create_customize_identifiers($section, $field);
  
  //settings
  $wp_customize->add_setting($ids['settings'], [
    'default' => '{{PWCODE}} AGÊNCIA DE DESENVOLVIMENTO DE SITES E APLICATIVOS',
    'transport' => 'postMessage',
    'sanitize_callback' => function($input){
      return filter_var($input, FILTER_SANITIZE_STRING);
    }
  ]);

  //control
  $wp_customize->add_control(
    new \WP_Customize_Control($wp_customize, $ids['control'], [
    'label' => 'Título:',
    'description' => 'Para dar ênfase a uma trecho do texto, insira-o entre duas chaves. Ex. {{suas ideias}}',
    'section' => $ids['section'],
    'settings' => $ids['settings'],
    'type' => 'text'
  ]));

  //partial
  $wp_customize->selective_refresh->add_partial($ids['partial'], [
    'settings' => $ids['settings'],
    'selector' => $container,
    'container_inclusive' => false,
    'render_callback' => function() use ($ids){
      echo parse_to_span_template(get_theme_mod($ids['settings']));            
    }
  ]);
}


function customize_slogan($wp_customize, $section){   
  
  $field = 'slogan'; 
  $container = '.pw-heading';
  $ids = create_customize_identifiers($section, $field);

  //settings
  $wp_customize->add_setting($ids['settings'], [
    'default' => 'CONSTRUINDO {{SUAS IDEIAS}} EM UM {{MUNDO}} DIGITAL',
    'transport' => 'postMessage',
    'sanitize_callback' => function($input){
      return filter_var($input, FILTER_SANITIZE_STRING);
    }
  ]);

  //control
  $wp_customize->add_control(
    new \WP_Customize_Control($wp_customize, $ids['control'], [
    'label' => 'Slogan:',
    'description' => 'Para dar ênfase a uma trecho do texto, insira-o entre duas chaves. Ex. {{suas ideias}}',
    'section' => $ids['section'],
    'settings' => $ids['settings'],
    'type' => 'text'
  ]));

  //partial
  $wp_customize->selective_refresh->add_partial($ids['partial'], [
    'settings' => $ids['settings'],
    'selector' => $container,
    'container_inclusive' => false,
    'render_callback' => function() use ($ids){
      echo parse_to_span_template(get_theme_mod($ids['settings']));            
    }
  ]);
}





?>