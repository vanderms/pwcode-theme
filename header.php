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
  
<!-- navbar -->
  <nav class="pwcode-navbar">
    <?php the_custom_logo(); ?>

    <?php if (has_nav_menu( 'primary')) : ?>
      <?php wp_nav_menu([
        'theme_location' => 'primary',
        'container' => '',        
    ]); ?>
    
    <?php endif; ?>
  </nav>
 
<!-- navbar end -->

<main>



  
