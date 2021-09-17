<template>  
<?php

  $nav_center_args = [
    'theme_location' => 'navbar-center',
    'container' => '',   
  ];
  $nav_right_args = [
   'theme_location' => 'navbar-right',
   'container' => '',  
  ];

?>

<nav class="pwcode-navbar">  
  <?php the_custom_logo(); ?>

  <div class="pwcode-links">
    <?php if (has_nav_menu( 'navbar-center')) : ?>
      <?php wp_nav_menu($nav_center_args); ?>
    <?php endif; ?>
      
    <?php if (has_nav_menu( 'navbar-right')) : ?>
      <?php wp_nav_menu($nav_right_args);?>    
    <?php endif; ?>
  </div>    
</nav>

</template>

<!--------------------------------- JAVASCRIPT ---------------------------------->
<script>   
   
  (function createSubmenuArrow(){    
   
    const parents = document.querySelectorAll('.menu-item-has-children');
    const arrows = [];
   
    parents.forEach(parent =>{
      const arrow = document.createElement('i');      
      parent.appendChild(arrow);
      arrows.push(arrow);
    });

    function watch(media){
      if(media.matches){
        arrows.forEach(arrow => arrow.className = "pwcode-arrow fa fa-angle-right");
      }
      else{
        arrows.forEach(arrow => arrow.className = "pwcode-arrow fa fa-angle-down");
      }     
    }
    const media = window.matchMedia('(max-width: 1079px)');
    watch(media);
    media.addListener(watch);    
    
  })();



</script>

<!------------------------------------ SCSS ------------------------------------->
<style lang='scss'>
@import "../scss/utilities.scss";

$navbar-height: 80px;
$sidebar-height: 56px;


.pwcode-navbar {
  @include border-box;
  @include anchor-child;
  @include li-child;
  @include ul-child;
  @include size(100%, $navbar-height);
  @include flexbox(space-between);
  @include container;
  text-transform: uppercase;
  box-shadow: 0px 1px 3px 0px rgba(85,85,85,0.25);

  .custom-logo-link{    
    max-height: 60px;
    width: auto;
    .custom-logo{
      max-height: 60px;
      width: auto;
    }
  }  
  .pwcode-links{
    @include flexbox(start);     

    .menu {
    
      @include flexbox(start);
      &:not(:first-of-type){
        margin-left: 80px;
      }
  
      &>li{        
        margin-left: 40px;  
       
        line-height: $navbar-height;   
        
        &:first-child{
          margin-left: 0px;
        }

        &.menu-item-has-children{
          position: relative;
          margin-right: 18px;
          
          &:hover {
            .sub-menu{
              max-height: 1000px;
              box-shadow: 0px 0px 2px 1px rgba(85,85,85,0.25); 
            }
          }

          .pwcode-arrow{
            position: absolute;
            line-height: $navbar-height;
            margin-left: 10px;
            cursor: pointer;            
          }

          .sub-menu {    
            position: absolute;
            display: flex;
            flex-direction: column;      
            transition: max-height 0.25s;
            width: 160px;
            max-height: 0px;             
            left: -20px;          
            overflow: hidden;
            top: $navbar-height;
            z-index: -1;
            li {
              line-height: 48px;
              margin-left: 20px;
              font-size: 0.9em;    
            }
          }      
        }
      }
    }
  } //behold the pyramid of doom!!!
  

  @include media($tablet){
    @include size(80%, 100vh);
    position: fixed;   
    
    left: 0px;
    flex-direction: column;
    justify-content: start;

    .custom-logo-link{
      margin: 60px 0px;
    }

    .pwcode-links{
      flex-direction: column;
      width: 100%;

      .menu{
        flex-direction: column;
        width: 100%;
        &:not(:first-of-type){
          margin-left: 0px;
          margin-top: 32px;
        }
        
        &>li{          
          margin-left: 0px;
          line-height: 40px;
          width: 100%;     
          text-align: center;          
        }
      }
    }
  }

}


</style>
