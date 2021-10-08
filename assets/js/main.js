
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
    console.log(middle);

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
 
  pw.component.navbar.dropdownHandler();
  pw.component.navbar.sidebarHandler();



pw.section.services = {};

pw.section.services.ellipsisHandler = ()=>{
  
  const paragraphs = document.querySelectorAll('.pw-icon-card p');
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

pw.section.services.ellipsisHandler();

