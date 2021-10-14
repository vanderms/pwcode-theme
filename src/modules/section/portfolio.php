<template>
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
  <div class="pw-filter">
    <button class='pw-current pw-all'>TODOS</button>
    <button class='pw-wordpress'>WORDPRESS</button>
    <button class='pw-stores'>LOJAS ONLINE</button>
    <button class='pw-landing'>LANDING PAGE</button>
    <button class='pw-apps'>APLICATIVOS</button>
  </div>
  <div class="pw-cards-container">
    <?php for ($i = 0; $i < count($projects) && $i < 6; $i++): ?>      
       <?php component('card-project', $projects[$i]); ?>
    <?php endfor; ?>
  </div>
</section>
</template>

<script>

pw.section.portfolio = {

  current: "all",

  filterHandler: ()=>{
    const section = document.querySelector('.pw-section-projects');
    const projects = JSON.parse(section.dataset.projects);
    
    const classes = {
        "all" : ".pw-all",
        "Wordpress" : '.pw-wordpress',
        "Aplicativo Web" : ".pw-apps",
        "Landing Page" : ".pw-landing",
        "Loja Online" : ".pw-stores"
      }; 
   
    const update = (filter)=>{   

      if(pw.section.portfolio.current === filter){
        return;
      }      

      const toRemove = document.querySelector(classes[pw.section.portfolio.current]);
      toRemove.classList.remove('pw-current');
      const toAdd = document.querySelector(classes[filter]);
      toAdd.classList.add('pw-current');
      pw.section.portfolio.current = filter;

      let filtered = filter === 'all' ? projects : projects.filter((project) =>{       
        return project.type.indexOf(filter) != -1;
      });

      const cards = document.querySelectorAll('.pw-component-card-project');

      for(let i = 0; i < cards.length; i++){
        const project = i < filtered.length ? filtered[i] : null;
        pw.component.cardProject.updateHandler(cards[i], project);
      }
    }
    
    section.querySelector('.pw-all')
      .addEventListener('click', ()=> update('all'));
    
    section.querySelector('.pw-wordpress')
      .addEventListener('click', ()=> update('Wordpress'));

    section.querySelector('.pw-apps')
      .addEventListener('click', ()=> update('Aplicativo Web'));

    section.querySelector('.pw-landing')
      .addEventListener('click', ()=> update('Landing Page'));

    section.querySelector('.pw-stores')
      .addEventListener('click', ()=> update('Loja Online'));
  }

};


pw.section.portfolio.filterHandler();

</script>

<style lang='scss'>
@import "src/scss/utilities.scss";

//drible 356 x 252

.pw-section-projects{
  @include container;

  .pw-filter{
    display: grid;
    justify-content: center;
    grid-auto-flow: column;
    gap: 30px;
    margin-top: -20px;
    margin-bottom: 60px;
    

    button{
      color: inherit;
      border: none;
      background-color: inherit;
      cursor: pointer;
      font-size: 15px;
      font-weight: 300;
      font-family: inherit;

      &.pw-current{
        color: $primary-light;
      }
    }
  }  

  .pw-cards-container{
    display: grid;
    grid-template-columns: repeat(3, Calc(33% - 40px));
    justify-content: space-between;
    gap: 60px;

    @include media($tablet){
      grid-template-columns: repeat(2, Calc(50% - 30px));
    }

    @include media($mobile){
      grid-template-columns: 320px;
      justify-content: center;
    }

    @include media($small-mobile){
      grid-template-columns: 100%;
    }    
  }
}

</style>