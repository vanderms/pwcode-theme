<?php namespace pwcode\com\theme;
  require_once get_template_directory() . '/src/inc/utilities/utilities.php';
  
  
?>

<section class="pw-cover">
  
  <img src="<?php echo get_header_image(); ?>" 
    class='pw-bg-image' alt="imagem de fundo" onerror='this.classList.add("hidden");'
  > 
  <div class="pw-cover-overlay"></div>
  <header class="pw-header">
    <div class='pw-sub-heading'>
      <?php echo parse_to_span_template(get_theme_mod('pw-section-cover-title')); ?>
    </div>
    <h1 class='pw-heading'>
     <?php echo parse_to_span_template(get_theme_mod('pw-section-cover-slogan')); ?>
    </h1>
    <div class="pw-cta-container">
      <a href="/" class="pw-cta-primary">SOLICITE SEU ORÇAMENTO</a>
      <a href="/" class="pw-cta-secondary">VEJA NOSSO PORTFÓLIO</a>
    </div>
  </header>

</section>

