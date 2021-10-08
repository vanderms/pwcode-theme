<?php namespace pwcode\com\theme; ?>
  <?php
    if(!isset($args['title']) || !isset($args['icon'])):
      throw new \Exception("param 'title' or 'icon' are not defined");   
    endif;
  ?>

  <header class='pw-component-header'>
    <h2><?php echo $args['title']; ?></h2>
    <div class="pw-delimiter">    
      <span></span>
      <i class='<?php echo $args['icon']?>'></i>
      <span></span>
    </div>
  </header>
