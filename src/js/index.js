
const pw = {
  component: {}, 
  section: {}, 
  page: {},
  util: {}
};

pw.util.setEllipsis = function(elem){
 
  const text = elem.textContent; 
  const span = document.createElement("span");
  span.textContent = " [...]";
  
  let min = 0;
  let max = text.length - 1;
 
  while(max > min) {

    const middle = (min + max) / 2;
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