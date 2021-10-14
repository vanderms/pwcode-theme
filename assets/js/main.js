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

pw.component.cardProject = {

  getLocalStorageKey: id => "like: " + id,

  likeHandler: ()=>{
    const section = document.querySelector('.pw-section-projects');
    const all = document.querySelectorAll('.pw-component-card-project .pw-like');
    const nonce = section.dataset.nonce;
    const url = section.dataset.url;
    const action = section.dataset.action;
    const likes = [];  
    const key = pw.component.cardProject.getLocalStorageKey;

    for(let i = 0; i < all.length; i++){
      const like = all[i];
      if(localStorage.getItem(key(like.dataset.id))){
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
        localStorage.setItem(key(id), true);
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
  },
  updateHandler: (card, project)=>{
    
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
    const key = pw.component.cardProject.getLocalStorageKey;
    const like = card.querySelector('.pw-like');
    like.dataset.id = project['id'];

    if(localStorage.getItem(key(like.dataset.id))){
        like.classList.remove("far");
        like.classList.add("fas");
    }

    //set like value
    const likeValue = card.querySelector('.pw-like-value');
    likeValue.textContent = project.likes;
  }
};
  

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
    
    for(let item in classes){
      section.querySelector(classes[item])
        .addEventListener('click', ()=> update(item));
    }

    const select = section.querySelector("#pw-select-filter");
    select.addEventListener('change', (e)=> update(e.currentTarget.value));
  }
};


pw.section.portfolio.filterHandler();





