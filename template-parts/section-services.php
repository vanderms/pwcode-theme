<?php namespace pwcode\com\theme;

  $loop = new \WP_Query([
    'post_type' => 'pw-services',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'order' => 'ASC'
  ]);

?>


<section class="pw-section-vp pw-section-services">
  <?php get_template_part('template-parts/component', 'header', ['icon' => 'tools']) ?>
  <div class="pw-cards-container">

  <?php while ($loop->have_posts()): ?>
    <?php $loop->the_post(); ?>
    <article class="pw-icon-card">
    <i class="pw-icon <?php esc_attr_e(get_post_meta(get_the_ID(), 'pw-icon', true)) ?>"></i>
    <h3 class='pw-title'><?php esc_attr_e(the_title()); ?></h3>
    <?php echo the_excerpt(); ?>
  </article>
<?php endwhile; ?>


</section>




