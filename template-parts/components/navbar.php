<?php
  namespace pwcode\com\theme;
  
  class MenuWalker extends \Walker_Nav_Menu {
    
    function end_el(&$output, $item, $depth = 0, $args = NULL){
      $has_children = false;
      foreach($item->classes as $class_name):
        if ($class_name === 'menu-item-has-children'):
          $output .= "<i class='pwcode-arrow fa fa-angle-down'></i>";       
        endif;
      endforeach;
      $output .= "</li>\n";
    }
  }

  $walker = new MenuWalker();  

  $nav_center_args = [
    'theme_location' => 'navbar-center',
    'container' => '',  
    'depth' => 2,
    'walker' => $walker 
  ];

  $nav_right_args = [
   'theme_location' => 'navbar-right',
   'container' => '',
   'depth' => 1
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


