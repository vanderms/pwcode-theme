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
   
  function SubmenuArrow(){    
   
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
    
  }

  SubmenuArrow();



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
  @include flexbox(row, space-between);
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
    @include flexbox(row, start);     

    .menu {
    
      @include flexbox(row, start);
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
    $sidebar-lateral: 25px;

    @include size(280px, 100vh);
    padding: 0px;
    @include flexbox(column, start, start);
    position: fixed;
    
    left: 0px;
    flex-direction: column;
    justify-content: start;
    align-items: start;

    .custom-logo-link{
      $logo-height: 30px;
      position: relative;
      max-height: $logo-height;
      margin: calc((#{$sidebar-height} - #{$logo-height}) / 2) $sidebar-lateral;    
      .custom-logo {
        max-height: $logo-height;
      }
      

    }

    .pwcode-links{
      @include flexbox(column, start, start);
      width: 100%;
      padding: 60px $sidebar-lateral 0px $sidebar-lateral;
      //margin-top: 40px;
      border-top: 1px solid gainsboro;

      .menu{
        @include flexbox(column, start, start);
        width: 100%;
        &:not(:first-of-type){
          margin-left: 0px;
          margin-top: 32px;
        }
        
        &>li{          
          margin-left: 0px;
          line-height: 40px;  
          
          
          &.menu-item-has-children{
            width: 100%;
            margin-right: unset;
            .pwcode-arrow{
              line-height: unset;
              right: -20px;
              cursor: pointer;  
              width: 40px;
              margin-left: unset;
              text-align: center;
              font-size: 18px;

            }
          }
        }
      }
    }
  }

}


</style>
