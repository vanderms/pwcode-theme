<?php namespace pwcode\com\theme;

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
    'menu-item-url' => home_url( '#sobre' ),
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