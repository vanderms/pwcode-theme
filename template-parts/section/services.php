<?php namespace pwcode\com\theme; ?>
<?php

$loop = new \WP_Query([
  'post_type' => 'pw-services',
  'post_status' => 'publish',
  'posts_per_page' => 6,
  'order' => 'ASC'
]);

?>
<section class="pw-section-vp pw-section-services">
<?php component('header', ['title' => 'SERVIÇOS', 'icon' => 'fas fa-tools'])?>
<div class="pw-cards-container">  
<?php while ($loop->have_posts()): ?>
  <?php $loop->the_post(); ?>
  <?php 
    component('icon-card', [
      'title' => the_title('', '', false),
      'icon' => get_post_meta(get_the_ID(), 'pw-service-icon', true),
      'excerpt' => apply_filters( 'the_excerpt', get_the_excerpt()),
      'link' => get_post_permalink()
    ]);
  ?>
<?php endwhile; ?>
</section>
