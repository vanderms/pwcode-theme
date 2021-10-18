<?php namespace pwcode\com\theme; ?>
<?php 
  $icons = [
    "Wordpress" => 'fab fa-wordpress',
    'Landing Page' => 'fas fa-laptop-code',
    'Aplicativo Web' => 'fab fa-react',
    'Loja Online' => 'fas fa-store',
  ];
?>
<article class="pw-component-card-project">
  <a class='pw-component-card-project-link' href="<?php echo $args['link']?>"> 
    <div class="pw-image-container">
      <i class="fas fa-camera"></i>
      <img class='pw-image' src="<?php echo $args['thumbnail']?>" alt="">
    </div>   
  </a>
  <div class="pw-info">
    <div class="pw-info-id">
      <?php krsort($args['type'], SORT_STRING); ?>
      <?php foreach($args['type'] as $type):?>
        <i class='<?php echo $icons[$type]; ?>'></i>    
      <?php endforeach; ?> 
      <h4 class='pw-title'><?php echo $args['title']; ?></h4>  
    </div>
    <div class="pw-info-interaction">
      <a class='pw-eye-link' href="<?php echo $args['link']?>">
        <i class="fas fa-eye"></i>
      </a>      
      <span class='pw-views-value'><?php echo $args['views'] ?></span>
      <i 
        class="pw-like far fa-heart"       
        data-id = "<?php echo $args['id']?>" 
      ></i>
      <span class='pw-like-value'><?php echo $args['likes'] ?></span>
    </div>      
  </div>
</article>
