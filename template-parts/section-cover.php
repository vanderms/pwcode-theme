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

