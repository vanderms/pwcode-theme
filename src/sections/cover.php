<section class="pw-cover pw-header-image">
  <div class="pw-cover-background pw-header-image"></div>
  <div class="pw-cover-overlay"></div> 
  <header class="pw-header">
    <div class='pw-sub-heading'>
      <span>PWCODE</span> AGÊNCIA DE DESENVOLVIMENTO DE SITES E APLICATIVOS
    </div>
    <h1 class='pw-heading'>
      CONSTRUINDO <span>SUAS IDEIAS</span> EM UM <span>MUNDO</span> DIGITAL
    </h1>
    <div class="pw-cta-container">

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
      position: relative;
      z-index: 3;
      padding-right: 40%;
      color: white;


    }
    
   
  }

</style>