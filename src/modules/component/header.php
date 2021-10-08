<template>
  <?php
    if(!isset($args['title']) || !isset($args['icon'])):
      throw new \Exception("param 'title' or 'icon' are not defined");   
    endif;
  ?>

  <header class='pw-component-header'>
    <h2><?php echo $args['title']; ?></h2>
    <div class="pw-delimiter">    
      <span></span>
      <i class='<?php echo $args['icon']?>'></i>
      <span></span>
    </div>
  </header>
</template>

<script></script>

<style lang='scss'>
  @import "src/scss/utilities.scss";
  
  .pw-component-header {   
    text-align: center;
    margin-bottom: 80px;
    
    h2 {
      margin: 0px;
      font-size: 32px;
      font-weight: 600;
      color: $primary-light;
    }

    i{
      color: $primary-light;
    }
    .pw-delimiter{
      @include flexbox(row, center, center);
      span{
        border-top: 1px solid $primary-light;
        width: 50px;
        &:first-child{
          margin-right: 10px;
        }
        &:last-child{
          margin-left: 10px;
        }
      }
    }

  }

</style>
