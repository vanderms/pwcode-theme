<?php
  namespace pw\com\theme;
    
  class MenuWalker extends \Walker_Nav_Menu {
    
    function end_el(&$output, $item, $depth = 0, $args = NULL){
      $has_children = false;
      foreach($item->classes as $class_name):
        if ($class_name === 'menu-item-has-children'):
          $output .= "<span class='pw-dynamic-arrow'><span></span><span></span></span>";       
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


<div class="pw-navbar-placeholder"></div>

<div class="pw-sidebar-bar">  
  <button class="pw-hamburger-menu">
    <span class="pw-top"></span>
    <span class="pw-middle"></span>
    <span class="pw-bottom"></span>
  </button>
</div>

<nav class="pw-navbar">




<div class="pw-top-sidebar">

  <!-- logo -->
  <?php if(has_custom_logo()): ?>
      <?php the_custom_logo(); ?>
    <?php elseif(file_exists(get_template_directory().'/assets/images/logo.svg')): ?>
      <a href="http://localhost:8080/" class="custom-logo-link">
        <img
          src= "<?php echo get_template_directory_uri().'/assets/images/logo.svg';?>"
          class="custom-logo" 
          alt="pwcode"/>
      </a>
    <?php else: ?>
      <span class="pw-logo-placeholder"></span>
  <?php endif; ?>

  <!-- close menu -->
  <button class="pw-close-btn">
    <span></span>
    <span></span>
  </button>

</div>

  

  <!-- links -->
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

  pw.navbar = {};
 
  pw.navbar.dropdownHandler = () =>{

    const parents = document.querySelectorAll('.menu-item-has-children');
    
    parents.forEach(parent =>{
      const arrow = parent.querySelector('.pw-dynamic-arrow');
      const submenu = parent.querySelector('.sub-menu');

      arrow.addEventListener('click', ()=>{
        submenu.classList.toggle('pw-open');
        arrow.querySelectorAll('span').forEach(span =>{
          span.classList.toggle('pw-open');
        })
      });
    })

  }

  pw.navbar.sidebarHandler = ()=>{
    const sidebar = document.querySelector('.pw-navbar');

    const menuBtn = document.querySelector('.pw-sidebar-bar .pw-hamburger-menu');
    menuBtn.addEventListener('click', ()=>{
      sidebar.classList.add('pw-open');
    });

    const closeBtn = document.querySelector('.pw-navbar .pw-close-btn');
    closeBtn.addEventListener('click', ()=>{
      sidebar.classList.remove('pw-open');

    });
  }
 
  pw.navbar.dropdownHandler();
  pw.navbar.sidebarHandler();


</script>


<style lang='scss'>
@import "../scss/utilities.scss";

$navbar-height: 80px;
$sidebar-height: 56px;


.pw-sidebar-bar{
  display: none;

  @include media($tablet){
    @include size(100%, $sidebar-height);
    display: flex;
    align-items: center;
    position: fixed;
    background-color: white;
     


    .pw-hamburger-menu{
      position: absolute;
      right: 25px;
      @include flexbox(column, space-between);
      @include size(42px, 32px);
      padding: 5px;
      border: none;
      background-color: inherit;
      cursor: pointer;
      
      span{
        @include size(100%, 1px);
        border-top: 2px solid black;
      }
    }


  }
}


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

  .pw-close-btn {
    display: none;
  }

  .custom-logo-link{
    $logo-height: 48px;
    max-height: $logo-height;
    width: auto;
    .custom-logo{
      max-height: $logo-height;
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
                transition: height 0.4s;  
              }             
            }
          }

          .pw-dynamic-arrow{
            position: absolute;
            top: 0px;
            height: $navbar-height;            
            right: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            span {
              display: inline-block;
              width: 8px;
              height: 1px;
              background-color: black;
              //transition: transform 0.4s;
              
              &:first-child {
                transform: rotate(45deg);            
              }
              &:last-child{
                transform: rotate(-45deg);
                margin-left: -3px;
                
              }
            }            
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
              transition: height 0s;  
            }
          }      
        }
      }
    }
  }
  

  @include media($tablet){

    $sidebar-lateral: 25px;  
    $sidebar-width: 280px;
    transition: left 0.4s;

    @include size($sidebar-width, 100%);
    @include flexbox(column, start, start);

    padding: 0px;    
    position: fixed;
    left: -#{$sidebar-width};
    overflow-x: hidden;
    overflow-y: auto;
    
   
    flex-direction: column;
    justify-content: start;
    align-items: start;

    &.pw-open{
      left: 0px;
    }

    .pw-top-sidebar{
      @include flexbox(row, space-between);
      @include size(100%, $sidebar-height);
      padding: 0px $sidebar-lateral;

      .pw-close-btn {
        @include flexbox(column, space-between);
        @include size(32px, 32px);
        padding: 5px;
        border: none;
        background-color: inherit;   
        cursor: pointer;
        margin-right: -4px;
        span{
          width: calc(100% + 8px);
          border-top: 2px solid black;
          margin-left: -8px;

          &:first-child{
            transform-origin: top right;
            transform: rotate(-43deg);
          }

          &:last-child{
            transform-origin: bottom right;
            transform: rotate(43deg);
          }
        }     
      }

      .custom-logo-link {
        $logo-height: 36px;
        position: relative;
        max-height: $logo-height;
        margin: calc((#{$sidebar-height} - #{$logo-height}) / 2) 0px;    
        .custom-logo {
          max-height: $logo-height;
        }
      }

    }

    .pw-links{
      @include flexbox(column, start, start);
      width: 100%;
      padding: 60px $sidebar-lateral 100px $sidebar-lateral;
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
            
            .pw-dynamic-arrow{
              height: 40px;
              top: 0px;
              right: -20px;
              cursor: pointer;  
              width: 40px;
              margin-left: unset;
              text-align: center;
              font-size: 18px;
              span {
                &:first-child{
                  &.pw-open{
                    transform: rotate(-45deg); 
                  }
                }
                &:last-child{
                  &.pw-open{
                    transform: rotate(45deg); 
                  }
                }
              }
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
