<?php namespace pw\com\theme;
    
  class MenuWalker extends \Walker_Nav_Menu {
    
    function end_el(&$output, $item, $depth = 0, $args = NULL){
      $has_children = false;
      foreach($item->classes as $class_name):
        if ($class_name === 'menu-item-has-children'):
          $output .= "<span class='pw-dynamic-arrow'><span></span><span></span></span>";       
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

<div class="pw-sidebar-bar">   
  <button class="pw-hamburger-menu">
    <span class="pw-top"></span>
    <span class="pw-middle"></span>
    <span class="pw-bottom"></span>
  </button>
</div>

<nav class="pw-navbar">

<div class="pw-top-sidebar">

  <!-- logo -->  
  <?php if(has_custom_logo()): ?>
      <?php the_custom_logo(); ?>
    <?php elseif(file_exists(get_template_directory().'/assets/images/logo.svg')): ?>
      <a href="http://localhost:8080/" class="custom-logo-link">
        <img
          src= "<?php echo get_template_directory_uri().'/assets/images/logo.svg';?>"
          class="custom-logo" 
          alt="pwcode"/>
      </a>
    <?php else: ?>
      <span class="pw-logo-placeholder"></span>
  <?php endif; ?>

  <!-- close button -->
  <button class="pw-close-btn">
    <span></span>
    <span></span>
  </button>

</div>

  <!-- links -->
  <div class="pw-links">
    
  <!-- Menu central -->
    <?php if (has_nav_menu( 'navbar-center')) : ?>
      <?php wp_nav_menu($nav_center_args); ?>
    <?php endif; ?>

    <!-- Menu Lateral -->  
    <?php if (has_nav_menu( 'navbar-right')) : ?>
      <?php wp_nav_menu($nav_right_args);?>    
    <?php endif; ?>
  
  </div>    
</nav>

<div class="pw-navbar-placeholder"></div>
<div class="pw-navbar-backdrop"></div>

