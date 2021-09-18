<?php
  namespace pw\com\theme;
  
  class MenuWalker extends \Walker_Nav_Menu {
    
    function end_el(&$output, $item, $depth = 0, $args = NULL){
      $has_children = false;
      foreach($item->classes as $class_name):
        if ($class_name === 'menu-item-has-children'):
          $output .= "<i class='pw-arrow fa fa-angle-down'></i>";       
        endif;
      endforeach;
      $output .= "</li>\n";
    }
  }

  $walker = new MenuWalker();  

  $nav_center_args = [
    'theme_location' => 'navbar-center',
    'container' => '',  
    'depth' => 2,
    'walker' => $walker 
  ];

  $nav_right_args = [
   'theme_location' => 'navbar-right',
   'container' => '',
   'depth' => 1
  ];

?>

<nav class="pw-navbar">  
 
  <?php the_custom_logo(); ?>

  <div class="pw-links">
    <?php if (has_nav_menu( 'navbar-center')) : ?>
      <?php wp_nav_menu($nav_center_args); ?>
    <?php endif; ?>
      
    <?php if (has_nav_menu( 'navbar-right')) : ?>
      <?php wp_nav_menu($nav_right_args);?>    
    <?php endif; ?>
  </div>    
</nav>


<script>

  function SidebarDropdown(){

    const parents = document.querySelectorAll('.menu-item-has-children');
    
    parents.forEach(parent =>{
      const arrow = parent.querySelector('.pw-arrow');
      const submenu = parent.querySelector('.sub-menu');
      arrow.addEventListener('click', ()=>{
        submenu.classList.toggle('pw-open');
      });
    })


  }
 
  SidebarDropdown();


</script>


<style lang='scss'>
@import "../scss/utilities.scss";

$navbar-height: 80px;
$sidebar-height: 56px;


.pw-navbar {
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
  .pw-links{
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
          padding-right: 40px;
          margin-right: -20px;
          
          &:hover {
            .sub-menu{              
              box-shadow: 0px 0px 2px 1px rgba(85,85,85,0.25);  
              li{
                height: 48px;
              }             
            }
          }

          .pw-arrow{
            position: absolute;
            top: 0px;
            line-height: $navbar-height;
            right: 20px;
            cursor: pointer;            
          }

          .sub-menu {    
            position: absolute;
            display: flex;
            flex-direction: column;            
            width: 160px;                   
            left: -20px;          
            overflow: hidden;
            top: $navbar-height;
            z-index: -1;
            li {
              overflow: hidden;
              height: 0px;
              line-height: 48px;
              margin-left: 20px;
              font-size: 0.9em;  
              transition: height 0.25s;  
            }
          }      
        }
      }
    }
  } //behold the pyramid of doom!!!
  

  @include media($tablet){
    $sidebar-lateral: 25px;     

    @include size(280px, 100%);
    padding: 0px;
    @include flexbox(column, start, start);
    position: fixed;
    overflow-x: hidden;
    overflow-y: auto;
    
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

    .pw-links{
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

            &:hover {
              .sub-menu{                
                box-shadow: unset; 
                li {
                  height: 0px;
                }

                &.pw-open{
                  li {
                    height: 48px;
                  }              
                }                
              }
            }           
            
            .pw-arrow{
              line-height: 40px;
              top: 0px;
              right: -20px;
              cursor: pointer;  
              width: 40px;
              margin-left: unset;
              text-align: center;
              font-size: 18px;
            }

            .sub-menu{
              position: unset;              
              width: 100%;                        
              
              li{
                height: 0px;
              }

              &.pw-open{
                li {
                  height: 48px;
                }              
              }              
            }
          }
        }
      }
    }
  }

}


</style>
