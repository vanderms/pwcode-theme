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




<script></script>

<style lang='scss'>
  @import "../scss/utilities.scss";

  .pw-section-services {
    @include container;

    .pw-cards-container{
      @include flexbox(row, space-between, flex-start);  

      .pw-icon-card{
        border: 1px solid $primary-dark;       
        border-radius: 5px;
        width: 30%;
        padding: 30px;

        .pw-icon{
          font-size: 60px;
          color: $primary-light;
        }

        .pw-title{
          font-size: 20px;
          color: $primary-light;
        }

        p{
          line-height: 22px;
          max-height: 88px;
          overflow: hidden;                     
        }
      }     
    }

  }


</style>