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
</template>

<script>

pw.Portfolio = class {
  
  constructor(){
    pw.Portfolio.current = "all";
    pw.Portfolio.filterHandler();
  }

  static filterHandler(){

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

      if(this.current === filter){
        return;
      }      

      const toRemove = document.querySelector(classes[this.current]);
      toRemove.classList.remove('pw-current');
      const toAdd = document.querySelector(classes[filter]);
      toAdd.classList.add('pw-current');
      this.current = filter;

      let filtered = filter === 'all' ? projects : projects.filter((project) =>{       
        return project.type.indexOf(filter) != -1;
      });

      const cards = document.querySelectorAll('.pw-component-card-project');

      for(let i = 0; i < cards.length; i++){
        const project = i < filtered.length ? filtered[i] : null;
        pw.CardProject.updateHandler(cards[i], project);
      }
    }

    for(let item in classes){
      section.querySelector(classes[item])
        .addEventListener('click', ()=> update(item));
    }

    const select = section.querySelector("#pw-select-filter");
    select.addEventListener('change', (e)=> update(e.currentTarget.value));
  }
}
</script>

<style lang='scss'>
@import "src/scss/utilities.scss";

//drible 356 x 252

.pw-section-projects{
  @include container;

  .pw-select-container{
    display: none;
    @include media($mobile){
      @include flexbox(row, flex-end, center);
      margin-bottom: 20px;
      padding-right: calc(50% - 155px);

      label{

        font-size: 15px;
        font-weight: 300;
        margin-right: 20px;
      }

      select{
        box-sizing: border-box;
        padding: 4px 6px;
        border-radius: 5px;
        color: $primary-light;
        font-family: 'Nunito Sans';
        background-color: inherit;
        
      }
    } 
    @include media($small-mobile){
      padding-right: 5px;
    } 
  }


  .pw-filter{
    display: grid;
    justify-content: center;
    grid-auto-flow: column;
    gap: 30px;
    margin: -20px 0px 60px 0px;
    padding-left: 0px;    
    list-style-type: none; 
    

    @include media($tablet){
      gap: 20px;
    }

    @include media($mobile){
      display: none;  
    }

    button{
      color: inherit;
      border: none;
      background-color: inherit;
      cursor: pointer;
      font-size: 15px;
      font-weight: 300;
      font-family: inherit;
     
      @include media($tablet){
        font-size: 14px;
      }

     
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