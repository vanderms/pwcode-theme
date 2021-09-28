<?php namespace pwcode\com\theme;


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
  $awesome_path = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';

  //font awesome
  wp_enqueue_style('pwcode-font-awesome', $awesome_path, false, '4.7.0', 'all');
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
$menu_name = 'Menu Principal';
$menu_location = 'navbar-center';

if(!wp_get_nav_menu_object($menu_name)):
  $menu_id = wp_create_nav_menu($menu_name);
  
  wp_update_nav_menu_item($menu_id, 0, [
    'menu-item-title' =>  "HOME",    
    'menu-item-url' => home_url( '/' ), 
    'menu-item-status' => 'publish'
  ]);

  wp_update_nav_menu_item($menu_id, 0, [
    'menu-item-title' =>  "SOBRE",   
    'menu-item-url' => home_url( '/sobre' ), 
    'menu-item-status' => 'publish'
  ]);

  wp_update_nav_menu_item($menu_id, 0, [
    'menu-item-title' =>  "PORTFÓLIO",    
    'menu-item-url' => home_url( '#portfolio' ), 
    'menu-item-status' => 'publish'
  ]);

  wp_update_nav_menu_item($menu_id, 0, [
    'menu-item-title' =>  "CONTATO",    
    'menu-item-url' => home_url( '/contato' ), 
    'menu-item-status' => 'publish'
  ]);

  wp_update_nav_menu_item($menu_id, 0, [
    'menu-item-title' =>  "BLOG",    
    'menu-item-url' => home_url( '/blog' ), 
    'menu-item-status' => 'publish'
  ]);

  wp_update_nav_menu_item($menu_id, 0, [
    'menu-item-title' =>  "ORÇAMENTO",   
    'menu-item-classes'=> 'pw-orcamento', 
    'menu-item-url' => home_url( '/orcamento' ), 
    'menu-item-status' => 'publish'
  ]);


  if( !has_nav_menu( $menu_location )):
    $locations = get_theme_mod('nav_menu_locations');
    $locations[$menu_location] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
  endif;

endif;



?>

