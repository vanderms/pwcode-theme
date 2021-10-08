<template>
<?php

$loop = new \WP_Query([
  'post_type' => 'pw-services',
  'post_status' => 'publish',
  'posts_per_page' => 6,
  'order' => 'ASC'
]);

?>
<section class="pw-section-vp pw-section-services">
<?php module('component/header', ['title' => 'SERVIÇOS', 'icon' => 'fas fa-tools'])?>
<div class="pw-cards-container">  
<?php while ($loop->have_posts()): ?>
  <?php $loop->the_post(); ?>
  <article class="pw-icon-card">
    <i class="pw-icon <?php esc_attr_e(get_post_meta(get_the_ID(), 'pw-icon', true)) ?>"></i>
    <h3 class='pw-title'><?php esc_attr_e(the_title()); ?></h3>
    <?php echo the_excerpt(); ?>
    <?php module('component/fancy-button', ['text' => "SAIBA MAIS", 'link' => "#"])?>  
</article>
<?php endwhile; ?>
</section>
</template>


<script>

pw.section.services = {};

pw.section.services.ellipsisHandler = ()=>{
  
  const paragraphs = document.querySelectorAll('.pw-icon-card p');
  const items = [];

  paragraphs.forEach(paragraph => {
    items.push({p : paragraph, text: paragraph.textContent});
  });

  const setup = ()=>{
    items.forEach(item => {
      pw.util.setEllipsis(item.p, item.text);     
      item.p.classList.add('pw-ready');
    });
  }
  
  window.addEventListener('load', setup);
  window.addEventListener('resize', setup);  
}

pw.section.services.ellipsisHandler();

</script>

<style lang='scss'>
  @import "src/scss/utilities.scss";

  .pw-section-services {
    @include container;

    .pw-cards-container{
      @include flexbox(row, space-between, flex-start);  

      .pw-icon-card{
        @include flexbox(column, center, center);
        box-sizing: border-box;
        border: 1px solid $primary-dark;       
        border-radius: 5px;
        width: 30%;
        padding: 30px;

        .pw-icon{
          font-size: 48px;
          color: $primary-light;
        }

        .pw-title{
          font-size: 18px;
          font-weight: 400;
          color: $primary-light;
        }

        p{
         text-align: center;
          line-height: 1.6;
          font-size: 15px;
          height: 125px;
          overflow: hidden;  
          font-weight: 300;
          visibility: hidden;
          &.pw-ready{
            visibility: visible;
          }           
        }
      }     
    }

  }


</style>