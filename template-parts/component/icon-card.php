<?php namespace pwcode\com\theme; ?>
  <a class='pw-component-icon-card-link' href="<?php echo $args['link']?>">
    <article class="pw-component-icon-card">
      <i class="pw-icon <?php esc_attr_e($args['icon']) ?>"></i>
      <h3 class='pw-title'><?php esc_attr_e($args['title']); ?></h3>
      <?php echo $args['excerpt']; ?>
      <div class="pw-read-more">        
        <span class='pw-text'>LEIA MAIS</span>
        <span class='pw-line'></span>        
      </div>
    </article>
  </a>
