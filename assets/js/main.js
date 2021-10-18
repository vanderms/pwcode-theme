"use strict";

const pw = {};

pw.Util = class {
  
  static setEllipis(elem, text){
    
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
}


window.addEventListener('DOMContentLoaded', ()=>{
  for(let module in pw){ new pw[module]; }
})


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




pw.IconCard = class {

  constructor(){
    pw.IconCard.hoverHandler();
    pw.IconCard.ellipsisHandler();
  }

  static ellipsisHandler(){
  
    const paragraphs = document.querySelectorAll('.pw-component-icon-card p');
    const items = [];

    paragraphs.forEach(paragraph => {
      items.push({p : paragraph, text: paragraph.textContent});
    });

    const setup = ()=>{
      items.forEach(item => {
        
        pw.Util.setEllipis(item.p, item.text);     
        item.p.classList.add('pw-ready');
      });
    }
    
    window.addEventListener('load', setup);
    window.addEventListener('resize', setup);  
  }

  
  static hoverHandler = ()=>{
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
}



pw.Navbar = class {
  
  constructor(){
    pw.Navbar.dropdownHandler();
    pw.Navbar.sidebarHandler();
  }

  static dropdownHandler = () =>{

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
    });
  }
  
  static sidebarHandler = ()=>{

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
}
  




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




