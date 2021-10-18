<template>
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
</template>

<script>

pw.CardProject = class {

  constructor(){
    pw.CardProject.likeHandler();
  }
  
  static key(id){
    return "like: " + id;
  }

  static likeHandler(){
    const section = document.querySelector('.pw-section-projects');
    const all = document.querySelectorAll('.pw-component-card-project .pw-like');
    const nonce = section.dataset.nonce;
    const url = section.dataset.url;
    const action = section.dataset.action;
    const likes = [];  
    

    for(let i = 0; i < all.length; i++){
      const like = all[i];
      if(localStorage.getItem(this.key(like.dataset.id))){
        like.classList.remove("far");
        like.classList.add("fas");
      }
      else{
        likes.push(like);
      }      
    }

    likes.forEach(like => {

      like.addEventListener('click', ()=> {
        const id = like.dataset.id;           
        localStorage.setItem(this.key(id), true);
        const data = new FormData();

        data.append('_ajax_nonce', nonce);
        data.append('action', action);
        data.append('id', id);

        fetch(url, {
          body: data,
          method : 'post'
        })
        .then(response => response.text())
        .then(text => console.log(text))
        .catch(error => console.log(error.message));

        const value = like.parentNode.querySelector('.pw-like-value');

        value.textContent = parseInt(value.textContent) + 1;
        like.classList.remove('far');
        like.classList.add('fas');

      });
    });
  }

  static updateHandler(card, project){
    
    //if project is null set visibility to hidden and return
    if(project === null){
      card.classList.add('hidden');
      return;
    }
    card.classList.remove('hidden');

    //set thumbnail
    const image = card.querySelector('.pw-image');
    image.src = project.thumbnail;

    //set thumbnail link
    const imageLink = card.querySelector('.pw-component-card-project-link');
    imageLink.href = project['link'];

    //set type icons
    const icons = {
      "Wordpress" : 'fab fa-wordpress',
      'Landing Page' : 'fas fa-laptop-code',
      'Aplicativo Web' : 'fab fa-react',
      'Loja Online' : 'fas fa-store',
    };

    const pwInfoId = card.querySelector('.pw-info-id');
    pwInfoId.innerHTML = '';
    project.type.sort().reverse();
    for(let type of project.type){
      const icon = document.createElement('i');
      icon.className = icons[type];
      pwInfoId.appendChild(icon);
    }

    //set title
    const title = document.createElement('h4');
    title.className = "pw-title";
    title.textContent = project['title'];
    pwInfoId.appendChild(title);

    //set view link
    const viewsLink = card.querySelector(".pw-eye-link");
    viewsLink.href = project['link'];

    //set views
    const views = card.querySelector('.pw-views-value');
    views.textContent = project['views'];

    //set like icon
   
    const like = card.querySelector('.pw-like');
    like.dataset.id = project['id'];

    if(localStorage.getItem(this.key(like.dataset.id))){
        like.classList.remove("far");
        like.classList.add("fas");
    }

    //set like value
    const likeValue = card.querySelector('.pw-like-value');
    likeValue.textContent = project.likes;
  }
}

</script>

<style lang='scss'>
@import "src/scss/utilities.scss";

.pw-component-card-project-link{
  @include link-no-decoration;
}

.pw-component-card-project{  

  padding: 5px;
  border: 1px solid transparent;

  &:hover{
    border: 1px solid $primary-dark;
  }

  border-radius: 5px;
  
  .pw-image-container{
    position: relative;    
    width: 100%;
    padding-bottom: 71.6%;


    i {
      font-size: 60px;
      color: #222;
      position: absolute;
      top: 50%;
      left: 50%;
      z-index: 1;
      transform: translate(-50%, -50%);
    }

    .pw-image {    
      position: absolute;
      object-fit: cover;
      object-position: center;      
      width: 100%;
      height: 100%;   
      border-radius: 5px;
      z-index: 2; 
    }
  }
  

  .pw-info {
    @include flexbox(row, space-between, center);
    margin-top: 6px;

    i {      
      color: $primary-light;       
    }

    .pw-info-id{
      @include flexbox(row, flex-start, center);
     i{
       font-size: 14px;
      margin-right: 6px;
     }

      h4{
        margin: 0px 0px 0px 5px;
        font-size: 13px;
        font-weight: 400;  
        max-width: 140px;
        max-height: 22px;
        line-height: 22px;
        overflow: hidden;
          
      }
    }
    .pw-info-interaction{
      @include flexbox('row, flex-end, center');

      .pw-eye-link{
        @include link-no-decoration;
        display: inline-flex;
        justify-content: center;
        align-items: center;
      }
      
      span{
        font-size: 12px;
        font-weight: 300;
        margin-left: 4px;
      }
      i{
        font-size: 13px;
        cursor: pointer;

        &:not(:first-child){
          margin-left: 8px;
        }
      }
    }   
  }  
}
</style>