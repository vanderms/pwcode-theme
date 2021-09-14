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
        margin-left: 100px;
      }
  
      &>li{
        position: relative;
        margin-left: 50px;
        &:first-child{
          margin-left: 0px;
        }
        
        &:hover{
          .sub-menu{
            max-height: 1000px;
          }
        }
        .sub-menu {    
          position: absolute;
          display: flex;         
          flex-direction: column;      
          transition: max-height 0.25s;
          width: 140px;
          max-height: 0px;             
          left: -20px;          
          overflow: hidden;
          top: calc((#{$navbar-height} / 2) + 10px);
          z-index: -1;
          li{
            line-height: 48px;
            margin-left: 20px;
            font-size: 0.9em;
            font-style: italic;
          }
        }      
      }
    }

  }
  

  @include media($tablet){
    @include size(80%, 100vh);
    flex-direction: column;
    justify-content: start;

    .custom-logo-link{
      margin: 60px 0px;
    }

    .pwcode-links{
      flex-direction: column;

      .menu{
        flex-direction: column;
        &:not(:first-of-type){
          margin-left: 0px;
          margin-top: 32px;
        }
        
        &>li{
          position: relative;
          margin-left: 0px;
          margin-top: 12px;
          
        }
      }
    }
  }

}


</style>
