<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <nav class="pwcode-navbar">
    <?php if (has_nav_menu( 'primary')) : ?>
      <?php 
        wp_nav_menu(
          array(
            'theme_location'  => 'primary',
            'menu_class'      => 'menu-wrapper',
            'container_class' => 'primary-menu-container',
            'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
            'fallback_cb'     => false,
          )
        );        
      ?>
    <?php endif; ?>
  </nav>
  <main>



  
