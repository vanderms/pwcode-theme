<template>
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
</template>

<script>
pw.component.iconCard = {};

pw.component.iconCard.ellipsisHandler = ()=>{
  
  const paragraphs = document.querySelectorAll('.pw-component-icon-card p');
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

pw.component.iconCard.hoverHandler = ()=>{
  const cards = document.querySelectorAll('.pw-component-icon-card');
  
  const showReadMore = (e) =>{     
    const card = e.currentTarget;
    card.classList.add('pw-hover');
  }

  const hideReadMore = (e) =>{
    const card = e.currentTarget;
    card.classList.remove('pw-hover');
  }
  
  cards.forEach(card => {
    card.addEventListener('mouseenter', showReadMore);
  })

  

}

pw.component.iconCard.hoverHandler();
pw.component.iconCard.ellipsisHandler();

</script>

<style lang='scss'>

@import "src/scss/utilities.scss";

.pw-component-icon-card-link{
  @include no-decoration-link;
  width: 30%;

  @include media($tablet){
    &:not(:first-child){
      margin-top: 40px;
    }       
    width: 540px;
  }

  @include media($mobile){
    width: 320px;
  }

  @include media($small-mobile){
    width: 260px;
    padding: 5px;
  }
}

.pw-component-icon-card{
  @include flexbox(column, center, flex-start);
  box-sizing: border-box;
  border: 1px solid transparent;
      
  border-radius: 5px;  
  width: 100%;  
  padding: 20px;
  overflow: hidden;

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
    //text-align: center;    
    line-height: 1.6;
    font-size: 15px;
    height: 75px;
    overflow: hidden;  
    font-weight: 300;
    visibility: hidden;
    &.pw-ready{
      visibility: visible;
    }           
  }

  .pw-read-more{
    @include flexbox(row, flex-start, center);
    *{
      display: inline-block;
    }    
    .pw-text{
      max-width: 0px;
      height: 20px;
      overflow: hidden;
      
    }
    .pw-line{
      width: 40px;      
      border-top: 1px solid $primary-light;
    }    
  }

  &:hover{
    border: 1px solid $primary-dark;   
    .pw-read-more{
      .pw-text{      
        transition: max-width 1s;
        margin-right: 12px;         
        max-width: 340px;
        font-size: 14px;        
      }
    }

  }

  @include media($tablet){
    .pw-read-more{
      .pw-text{
        margin-right: 12px;         
        max-width: 340px;
        font-size: 14px; 
      }
    }
  } 
}

</style>