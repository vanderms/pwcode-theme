
   
  (function createSubmenuArrow(){    
   
    const parents = document.querySelectorAll('.menu-item-has-children');
    const arrows = [];
   
    parents.forEach(parent =>{
      const arrow = document.createElement('i');      
      parent.appendChild(arrow);
      arrows.push(arrow);
    });

    function watch(media){
      if(media.matches){
        arrows.forEach(arrow => arrow.className = "pwcode-arrow fa fa-angle-right");
      }
      else{
        arrows.forEach(arrow => arrow.className = "pwcode-arrow fa fa-angle-down");
      }     
    }
    const media = window.matchMedia('(max-width: 1079px)');
    watch(media);
    media.addListener(watch);    
    
  })();



