

  function SidebarDropdown(){

    const parents = document.querySelectorAll('.menu-item-has-children');
    
    parents.forEach(parent =>{
      const arrow = parent.querySelector('.pw-arrow');
      const submenu = parent.querySelector('.sub-menu');
      arrow.addEventListener('click', ()=>{
        submenu.classList.toggle('pw-open');
      });
    })


  }
 
  SidebarDropdown();


