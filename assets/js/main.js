"use strict";

const pw = {
  component: {}, 
  section: {}, 
  page: {},
  util: {}
};


pw.util.setEllipsis = (elem, text)=>{ 
  
  const span = document.createElement("span");
  span.textContent = " [...]";
  
  let min = 0;
  let max = text.length - 1;
 
  while(max > min) {

    const middle = Math.ceil((min + max) / 2);
    elem.textContent = text.substring(0, middle);
    elem.appendChild(span);
    const spanRect = span.getBoundingClientRect();
    const elemRect = elem.getBoundingClientRect();   

    const interval = spanRect.height - 5;
    
    if(spanRect.bottom - elemRect.bottom > interval){
      max = middle;      
    }

    else if(elemRect.bottom - spanRect.bottom > interval){
      min = middle;      
    }
    
    else if(elemRect.right - spanRect.right > 30){
      min = middle;      
    }

    else {
      const lastSpace = text.lastIndexOf(" ", middle);
      elem.textContent = text.substring(0, lastSpace);
      elem.appendChild(span);     
      return true;
    }
  }
  
  elem.textContent = text;
  return false;
}
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



pw.component.iconCard = {};

pw.component.iconCard.ellipsisHandler = ()=>{
  
  const paragraphs = document.querySelectorAll('.pw-component-icon-card p');
  const items = [];

  paragraphs.forEach(paragraph => {
    items.push({p : paragraph, text: paragraph.textContent});
  });

  const setup = ()=>{
    items.forEach(item => {
      pw.util.setEllipsis(item.p, item.text);     
      item.p.classList.add('pw-ready');
    });
  }
  
  window.addEventListener('load', setup);
  window.addEventListener('resize', setup);  
}

pw.component.iconCard.hoverHandler = ()=>{
  const cards = document.querySelectorAll('.pw-component-icon-card');
  
  const showReadMore = (e) =>{     
    const card = e.currentTarget;
    card.classList.add('pw-hover');
  }

  const hideReadMore = (e) =>{
    const card = e.currentTarget;
    card.classList.remove('pw-hover');
  }
  
  cards.forEach(card => {
    card.addEventListener('mouseenter', showReadMore);
  })

  

}

pw.component.iconCard.hoverHandler();
pw.component.iconCard.ellipsisHandler();


  
  pw.component.navbar = {};
 
  pw.component.navbar.dropdownHandler = () =>{

    const parents = document.querySelectorAll('.menu-item-has-children');
    
    parents.forEach(parent =>{
      const arrow = parent.querySelector('.pw-dynamic-arrow');
      const submenu = parent.querySelector('.sub-menu');

      arrow.addEventListener('click', ()=>{
        submenu.classList.toggle('pw-open');
        arrow.querySelectorAll('span').forEach(span =>{
          span.classList.toggle('pw-open');
        })
      });
    })

  }

  pw.component.navbar.sidebarHandler = ()=>{

    const sidebar = document.querySelector('.pw-navbar');

    const backdrop = document.querySelector('.pw-navbar-backdrop');
    
    const menuBtn = document.querySelector('.pw-sidebar-bar .pw-hamburger-menu');

    const closeBtn = document.querySelector('.pw-navbar .pw-close-btn');

    const close = () => {
      sidebar.classList.remove('pw-open');
      backdrop.classList.remove('pw-open');
    }

    const open = () => {
      sidebar.classList.add('pw-open');
      backdrop.classList.add('pw-open');
    }

    menuBtn.addEventListener('click', open);    
    closeBtn.addEventListener('click', close);
    backdrop.addEventListener('click', close);

  }

  pw.component.navbar.wpadminHandler = ()=>{
    const wpadmin = document.querySelector("#wpadminbar");
    if(wpadmin){
      let running = false;
      document.addEventListener("scroll", ()=>{
        if(!running){
          running = true;
          window.requestAnimationFrame(()=>{
            let pos = wpadmin.getBoundingClientRect().bottom;
            pos = pos >= 0 ? `${Math.round(pos)}px` : "0px";
            const sidebar = document.querySelector('.pw-sidebar-bar');
            const navbar = document.querySelector('.pw-navbar');
            sidebar.style.top = pos;
            navbar.style.top = pos;
            running = false;
            console.log(pos);
          });
        }           
      });
    }
  }

  //pw.component.navbar.wpadminHandler()
  pw.component.navbar.dropdownHandler();
  pw.component.navbar.sidebarHandler();








