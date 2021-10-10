<template>
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
</template>

<script>

</script>

<style lang='scss'>
@import "src/scss/utilities.scss";

.pw-section-projects{
  @include container;

  .pw-cards-container{
    @include flexbox(row, space-between, center);
    flex-wrap: wrap;
    
    .pw-project-card{
      width: 340px;
      padding: 10px;
      border: 1px solid $primary-dark;
      border-radius: 5px;

      img{
        width: 100%;
        height: auto;
      }

      h4{
        margin: 5px 0px 0px 0px;
        font-size: 14px;
        font-weight: 300;
        //color: gainsboro;
      }


    }
  }

}

</style>