<?php namespace pwcode\com\theme; ?>
<?php 
  $loop = new \WP_Query([
    'post_type' => 'pw-projects',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'order' => 'ASC'
  ]);
?>

<section class="pw-section-projects pw-section-vp">
  <?php component('header', ['title' => 'PROJETOS RECENTES', 'icon' => 'fas fa-book-open'])?>
  <div class="pw-cards-container">
    <?php while ($loop->have_posts()): ?>
      <?php $loop->the_post(); ?>
      <article class="pw-project-card">
        <?php the_post_thumbnail(); ?>
        <h4 class='pw-title'><?php esc_attr_e(the_title()); ?></h4> 
      </article>
    <?php endwhile; ?>
  </div>
</section>
