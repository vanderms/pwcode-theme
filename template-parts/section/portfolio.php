<?php namespace pwcode\com\theme; ?>
<?php

  $json_loop = new \WP_Query([
    'post_type' => 'pw-projects',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'ASC'
  ]);  

  $projects = [];
  while($json_loop->have_posts()){
    $json_loop->the_post();
    $project = [];
    if(has_post_thumbnail()){     
      $project['thumbnail'] = get_the_post_thumbnail_url(null, 'pw-project-thumbnail');
    }
    else{
      $project['thumbnail'] = false;
    }
    $project['title'] = esc_attr(the_title("", "", false));
    $project['id'] = get_the_ID();
    $project['link'] = get_post_permalink();
    $project['views'] = get_post_meta(get_the_ID(), 'pw-project-views', true) ?: 0;
    $project['likes'] = get_post_meta(get_the_ID(), 'pw-project-likes', true) ?: 0;    
    $project['type'] = [];
    
    
    $terms = get_the_terms($project['id'], "pw-projects-type");
    foreach($terms as $term){
      array_push($project['type'], $term->name);
    }
    array_push($projects, $project);
  }

  $projects_json = json_encode($projects);
  wp_reset_postdata(); 
?>
<section class="pw-section-projects pw-section-vp"
  data-projects = '<?php echo $projects_json; ?>'
  data-url = "<?php echo HttpRequestUtil::url()?>"
  data-nonce = "<?php echo HttpRequestUtil::projects_nonce(); ?>" 
  data-action = "<?php echo HttpRequestUtil::projects_action(); ?>"
>
  <?php component('header', ['title' => 'PORTFÓLIO', 'icon' => 'fas fa-book-open'])?>
  <div class="pw-select-container">
    <label for="pw-select-filter">FILTRO: </label>
    <select id="pw-select-filter">
      <option value="all">TODOS</option>
      <option value="Wordpress">WORDPRESS</option>
      <option value="Aplicativo Web">APLICATIVOS</option>
      <option value="Landing Page">LANDING PAGE</option>
      <option value="Loja Online">LOJA ONLINE</option>
    </select>  
  </div>  
  <ul class="pw-filter">
    <li><button class='pw-current pw-all'>TODOS</button></li>
    <li><button class='pw-wordpress'>WORDPRESS</button></li>
    <li><button class='pw-stores'>LOJAS ONLINE</button></li>
    <li><button class='pw-landing'>LANDING PAGE</button></li>
    <li><button class='pw-apps'>APLICATIVOS</button></li>
  </ul>
  <div class="pw-cards-container">
    <?php for ($i = 0; $i < count($projects) && $i < 6; $i++): ?>      
       <?php component('card-project', $projects[$i]); ?>
    <?php endfor; ?>
  </div>
</section>
