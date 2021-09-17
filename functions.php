<?php namespace pwcode\com\theme;


add_action('after_setup_theme', function(){

  add_theme_support( 'automatic-feed-links' );
	add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  register_nav_menus(
    [ 'navbar-center' => 'Barra de Navegação - Centro',
      'navbar-right' => 'Barra de Navegação - Direita'
    ]    
  );
 
  add_theme_support( 'custom-logo', [
    'height'               => 60,
    'width'                => 60,
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => ['pwcode-logo'],
  ]);
});


add_action('wp_enqueue_scripts', function(){

  $version = wp_get_theme()->get('Version') . rand(1, 1000000);
  $css_path = get_template_directory_uri().'/assets/css/styles.css';
  $js_path = get_template_directory_uri(). '/assets/js/main.js';
  $awesome_path = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';

  //font awesome
  wp_enqueue_style('pwcode-font-awesome', $awesome_path, false, '4.7.0', 'all');
  wp_enqueue_style('pwcode-stylescss', $css_path, false, $version, 'all');
  wp_enqueue_script('pwcode-mainjs',  $js_path, false, $version, true);

});


?>