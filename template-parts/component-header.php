<?php namespace pwcode\com\theme;
  if(!isset($args['icon'])):
   throw new \Exception("icon not defined");
  else:
    $icon = $args['icon'];
  endif;
?>

<header class='pw-component-header'>
  <h2>SERVIÇOS</h2>
  <div class="pw-delimiter">    
    <span></span>
    <?php if($icon == 'tools'): ?>     
      <svg xmlns="http://www.w3.org/2000/svg" width="16.346" height="16" viewBox="0 0 16.346 16">
        <path id="Icon_metro-tools" data-name="Icon metro-tools" d="M21.237,8.3a4.07,4.07,0,0,1-5.768,5.105l-1.126,1.229.8.806.48-.48a.627.627,0,0,1,.888,0L20.407,18.9a.627.627,0,0,1,0,.888L18.63,21.562a.627.627,0,0,1-.888,0L13.849,17.63a.627.627,0,0,1,0-.888l.438-.438-.765-.767L8.139,21.417a1.256,1.256,0,0,1-1.777,0l-.444-.444a1.256,1.256,0,0,1,0-1.777l6.133-5.136L7.978,9.976H6.691L5.2,7.581l1.2-1.2,2.448,1.5.016,1.26,4.12,4.136,1.2-1A4.074,4.074,0,0,1,19.01,6.087l-2.639,2.6,2.221,2.221L21.237,8.3ZM7.391,19.822a.628.628,0,1,0,0,.889A.628.628,0,0,0,7.391,19.822Z" transform="translate(-5.203 -5.785)" fill="#00bb94"/>
      </svg>      
    <?php endif; ?>
    <span></span>
  </div>
</header>

