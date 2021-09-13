<nav class="pwcode-navbar">
    <?php the_custom_logo(); ?>

    <?php if (has_nav_menu( 'navbar-center')) : ?>
      <?php wp_nav_menu([
        'theme_location' => 'navbar-center',
        'container' => '',        
    ]); ?>
    <?php endif; ?>
    
    <?php if (has_nav_menu( 'navbar-right')) : ?>
      <?php wp_nav_menu([
        'theme_location' => 'navbar-right',
        'container' => '',        
    ]);?>    
    <?php endif; ?>
  </nav>