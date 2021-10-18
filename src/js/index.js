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
