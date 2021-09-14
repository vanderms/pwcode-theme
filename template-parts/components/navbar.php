<?php

  $nav_center_args = [
    'theme_location' => 'navbar-center',
    'container' => '',   
  ];
  $nav_right_args = [
   'theme_location' => 'navbar-right',
   'container' => '',  
  ];

?>

<nav class="pwcode-navbar">  
  <?php the_custom_logo(); ?>

  <div class="pwcode-links">
    <?php if (has_nav_menu( 'navbar-center')) : ?>
      <?php wp_nav_menu($nav_center_args); ?>
    <?php endif; ?>
      
    <?php if (has_nav_menu( 'navbar-right')) : ?>
      <?php wp_nav_menu($nav_right_args);?>    
    <?php endif; ?>
  </div>    
</nav>

