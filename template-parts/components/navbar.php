<?php
  namespace pw\com\theme;
  
  class MenuWalker extends \Walker_Nav_Menu {
    
    function end_el(&$output, $item, $depth = 0, $args = NULL){
      $has_children = false;
      foreach($item->classes as $class_name):
        if ($class_name === 'menu-item-has-children'):
          $output .= "<i class='pw-arrow fa fa-angle-down'></i>";       
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

<nav class="pw-navbar">  
 
  <?php if(has_custom_logo()): ?>
  <?php the_custom_logo(); ?>
  <?php else: ?>
    <?php require get_template_directory().'/assets/images/logo.svg'; ?>
  <?php endif; ?>
  <svg xmlns="http://www.w3.org/2000/svg" width="34.286" height="20" viewBox="0 0 34.286 20">
  <g id="Icon_ionic-ios-menu" data-name="Icon ionic-ios-menu" transform="translate(-4.5 -10.125)">
    <path id="Path_3" data-name="Path 3" d="M37.357,12.375H5.929A1.308,1.308,0,0,1,4.5,11.25h0a1.308,1.308,0,0,1,1.429-1.125H37.357a1.308,1.308,0,0,1,1.429,1.125h0A1.308,1.308,0,0,1,37.357,12.375Z" transform="translate(0)"/>
    <path id="Path_4" data-name="Path 4" d="M37.357,19.125H5.929A1.308,1.308,0,0,1,4.5,18h0a1.308,1.308,0,0,1,1.429-1.125H37.357A1.308,1.308,0,0,1,38.786,18h0A1.308,1.308,0,0,1,37.357,19.125Z" transform="translate(0 2.125)"/>
    <path id="Path_5" data-name="Path 5" d="M37.357,25.875H5.929A1.308,1.308,0,0,1,4.5,24.75h0a1.308,1.308,0,0,1,1.429-1.125H37.357a1.308,1.308,0,0,1,1.429,1.125h0A1.308,1.308,0,0,1,37.357,25.875Z" transform="translate(0 4.25)"/>
  </g>
</svg>



  <div class="pw-links">
    <?php if (has_nav_menu( 'navbar-center')) : ?>
      <?php wp_nav_menu($nav_center_args); ?>
    <?php endif; ?>
      
    <?php if (has_nav_menu( 'navbar-right')) : ?>
      <?php wp_nav_menu($nav_right_args);?>    
    <?php endif; ?>
  </div>    
</nav>
<div class="pw-sidebar-bar">

</div>


