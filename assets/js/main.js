
const pw = {};

  pw.navbar = {};
 
  pw.navbar.dropdownHandler = () =>{

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

  pw.navbar.sidebarHandler = ()=>{
    const sidebar = document.querySelector('.pw-navbar');

    const menuBtn = document.querySelector('.pw-sidebar-bar .pw-hamburger-menu');
    menuBtn.addEventListener('click', ()=>{
      sidebar.classList.add('pw-open');
    });

    const closeBtn = document.querySelector('.pw-navbar .pw-close-btn');
    closeBtn.addEventListener('click', ()=>{
      sidebar.classList.remove('pw-open');

    });
  }
 
  pw.navbar.dropdownHandler();
  pw.navbar.sidebarHandler();


