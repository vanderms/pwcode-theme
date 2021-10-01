<?php 
  $slogan = get_theme_mod('pw-section-cover-slogan');
  $slogan = str_replace(["{{", "}}"], ["<span>", "</span>"], $slogan);
?>

<section class="pw-cover pw-header-image">
  <div class="pw-cover-background pw-header-image"></div>
  <div class="pw-cover-overlay"></div> 
  <header class="pw-header">
    <div class='pw-sub-heading'>
      <span>PWCODE</span> AGÊNCIA DE DESENVOLVIMENTO DE SITES E APLICATIVOS
    </div>
    <h1 class='pw-heading'>
     <?php echo $slogan; ?>
    </h1>
    <div class="pw-cta-container">
      <a href="/" class="pw-cta-primary">SOLICITE SEU ORÇAMENTO</a>
      <a href="/" class="pw-cta-secondary">VEJA NOSSO PORTFÓLIO</a>

    </div>
  </header>

</section>

<script>


</script>

<style lang='scss'>
  @import "../scss/utilities.scss";
  .pw-cover{
    min-height: calc(100vh - 80px);   
    position: relative;
    
    .pw-cover-background{
      z-index: 1;
      min-height: calc(100vh - 80px);
      width: 100%;
      position: absolute;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    .pw-cover-overlay{
      z-index: 2;
      min-height: calc(100vh - 80px);
      width: 100%;
      position: absolute;
      background-color: black;
      opacity: 0.75;
    }

    .pw-header{
      @include container(true, false);
      @include flexbox(column, center, flex-start);
      position: relative;
      z-index: 3;
      padding-right: 40%;
      color: white;
      min-height: calc(100vh - 80px);
      
      h1{
          margin: 0px;
          font-size: 52px;
      }
     
      span{
        color: $primary-light;
      }     

      .pw-heading{
        margin: 20px 0px 50px 0px;
       
      }

      .pw-cta-container{
        .pw-cta-primary{
          @include cta-primary;
        }
        .pw-cta-secondary{
          @include cta-secondary;
          margin-left: 25px;
        }
      }
    
    
      @include media($tablet){
        padding-right: 20%;
        h1{
          font-size: 48px;
        }        
      }

      @include media($mobile){
        @include container(true, true);
        

        h1{
          font-size: 32px;
          text-align: center;
        }

        .pw-sub-heading{
          text-align: center;
          line-height: 1.6;
          margin-bottom: 20px;
        }

        .pw-cta-container{
          @include flexbox(column, flex-start, center);
          width: 100%;

          .pw-cta-secondary{
            margin-left: 0px;
            margin-top: 25px;
          }
        }
      }


    }//end pw-header
    
   

   
  }

</style>