<template>
<div class="pw-component-fancy-button">
  <span class="lateral"></span>
  <span class="vertical"></span>
  <a href="<?php echo $args['link']; ?>"><?php echo $args['text']; ?></a>
  <span class="vertical"></span>
  <span class="lateral"></span>  
</div>
</template>

<script></script>

<style lang='scss'>
  @import 'src/scss/utilities.scss';

  .pw-component-fancy-button{
    @include flexbox(row, center, center); 

    a{    
      position: relative;
      z-index: 1;
      margin: 0px 4px;
      text-decoration: none;
      color: inherit;
      cursor: pointer;
      display: inline-block;
      font-size: 15px;
      font-weight: 300;
      padding: 2px 6px;
      border-radius: 2px;
     
      &:hover{
        background-color: $primary;
        color: white;
      }

    }

    .lateral{
      @include size(30px, 0px);
      border-top: 1px solid $primary-light;     
      position: relative; 
    }   

    .vertical{
      @include size(0px, 20px);
      border-right: 1px solid $primary-light;
      position: relative;
    }

  }

</style>