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
    <div class="pw-bg-image" style='background-image: url(<?php echo $args['thumbnail']?>)'>    
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
        <i class="fas fa-eye"></i>
        <span><?php echo $args['views'] ?></span>
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
  pw.component.cardProject = {};

  pw.component.cardProject.likes = {};

  pw.component.cardProject.likeHandler = ()=>{
    const section = document.querySelector('.pw-section-projects');
    const likes = document.querySelectorAll('.pw-component-card-project .pw-like');
    const nonce = section.dataset.nonce;
    const url = section.dataset.url;  

    likes.forEach(like => {

      like.addEventListener('click', ()=> {
        const id = like.dataset.id;
        if(pw.component.cardProject.likes[id.toString()]){
          return;
        }
        pw.component.cardProject.likes[id.toString()] = true;
        const data = new FormData();

        data.append('_ajax_nonce', nonce);
        data.append('action', 'projects_likes');
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

  pw.component.cardProject.likeHandler();

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

  .pw-bg-image{
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    padding-bottom: 71.875%;    
    border-radius: 5px;
  }

  .pw-info {
    @include flexbox(row, space-between, center);
    margin-top: 6px;

    i {
      font-size: 14px;
      color: $primary-light;       
    }

    .pw-info-id{
      @include flexbox(row, flex-start, center);
     i{
      margin-right: 6px;
     }

      h4{
        margin: 0px 0px 0px 5px;
        font-size: 14px;
        font-weight: 400;    
      }
    }
    .pw-info-interaction{
      @include flexbox('row, flex-end, center');

      
      span{
        font-size: 13px;
        font-weight: 300;
        margin-left: 6px;
      }
      i{
        &:not(:first-child){
          margin-left: 12px;
        }
      }

    }
   
  }  
}
</style>