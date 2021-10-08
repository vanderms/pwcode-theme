<?php namespace pwcode\com\theme;

require_once get_template_directory(). "/inc/util/util.php";


add_action('after_setup_theme', function(){

  add_theme_support( 'automatic-feed-links' );
	add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  //custom header
  $custom_header_options = ['width' => 1920, 'height' => 1080];
  $default_image = '/assets/images/1920/cover.jpg';
  if(file_exists(get_template_directory().$default_image)):
    $custom_header_options['default-image'] = get_template_directory_uri(). $default_image;
  endif;

  add_theme_support( 'custom-header', $custom_header_options);


  //navegation menus
  register_nav_menus(
    [ 'navbar-center' => 'Barra de Navegação - Centro',
      'navbar-right' => 'Barra de Navegação - Direita'
    ]    
  );
 

  //custom logo
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
  $awesome_path = get_template_directory_uri(). '/assets/css/font-awesome-5/css/all.css';

  //font awesome
  wp_enqueue_style('pwcode-font-awesome', $awesome_path, false, '5.15.4', 'all');
  wp_enqueue_style('pwcode-stylescss', $css_path, false, $version, 'all');
  wp_enqueue_script('pwcode-mainjs',  $js_path, false, $version, true);
});



//header image, include style
add_action('wp_head', function(){
  if(has_header_image()):
    echo ("<style>.pw-header-image{background-image:url(". 
      esc_url(get_header_image()) . 
      ");}</style>"
    );
  endif;
});


//header image, register
register_default_headers( [
  'default-image' => [
      'url'           => get_stylesheet_directory_uri() . '/assets/images/1920/cover.jpg',
      'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/1920/cover.jpg',
      'description'   => __( 'Default Header Image', 'textdomain' )
  ],
]);

//create default nav menu
require_once get_template_directory() . '/inc/navbar/default-menu.php';

//service custom page
require_once get_template_directory(). '/inc/services/custom-page.php';



?>