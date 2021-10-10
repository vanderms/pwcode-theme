<?php namespace pwcode\com\theme;


add_action('init', function(){

  register_post_type('pw-services', 
    [
      'labels' => [
        'name' => 'Serviços',
        'singular_name' => 'Serviço'
      ],
      'hierarchical' => true,
      'public' => true,
      'menu_icon' => "data:image/svg+xml;base64, PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzNiIgaGVpZ2h0PSIzMS41IiB2aWV3Qm94PSIwIDAgMzYgMzEuNSI+CiAgICA8cGF0aCBpZD0iSWNvbl9hd2Vzb21lLXRvb2xib3giIGRhdGEtbmFtZT0iSWNvbiBhd2Vzb21lLXRvb2xib3giIGQ9Ik0zNS4zNDEsMTUuMDkxLDMyLjE2LDExLjkxYTIuMjUsMi4yNSwwLDAsMC0xLjU5MS0uNjU5SDI3VjUuNjI1QTMuMzc1LDMuMzc1LDAsMCwwLDIzLjYyNSwyLjI1SDEyLjM3NUEzLjM3NSwzLjM3NSwwLDAsMCw5LDUuNjI1VjExLjI1SDUuNDMyYTIuMjUxLDIuMjUxLDAsMCwwLTEuNTkxLjY1OUwuNjU5LDE1LjA5MUEyLjI1LDIuMjUsMCwwLDAsMCwxNi42ODJWMjIuNUg5VjIxLjM3NWExLjEyNSwxLjEyNSwwLDAsMSwxLjEyNS0xLjEyNWgyLjI1QTEuMTI1LDEuMTI1LDAsMCwxLDEzLjUsMjEuMzc1VjIyLjVoOVYyMS4zNzVhMS4xMjUsMS4xMjUsMCwwLDEsMS4xMjUtMS4xMjVoMi4yNUExLjEyNSwxLjEyNSwwLDAsMSwyNywyMS4zNzVWMjIuNWg5VjE2LjY4MkEyLjI1LDIuMjUsMCwwLDAsMzUuMzQxLDE1LjA5MVpNMjIuNSwxMS4yNWgtOVY2Ljc1aDlaTTI3LDI1Ljg3NUExLjEyNSwxLjEyNSwwLDAsMSwyNS44NzUsMjdoLTIuMjVBMS4xMjUsMS4xMjUsMCwwLDEsMjIuNSwyNS44NzVWMjQuNzVoLTl2MS4xMjVBMS4xMjUsMS4xMjUsMCwwLDEsMTIuMzc1LDI3aC0yLjI1QTEuMTI1LDEuMTI1LDAsMCwxLDksMjUuODc1VjI0Ljc1SDBWMzEuNWEyLjI1LDIuMjUsMCwwLDAsMi4yNSwyLjI1aDMxLjVBMi4yNSwyLjI1LDAsMCwwLDM2LDMxLjVWMjQuNzVIMjdaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIC0yLjI1KSIgZmlsbD0icmdiYSgyNDAsMjQ2LDI1MiwwLjYpIi8+CiAgPC9zdmc+",
      'has_archive' => false,
      'supports' => ['title', 'editor'],
      'rewrite' => ['slug' => 'servicos']
    ]
  );
});


add_action('add_meta_boxes', function(){
  
  $callback = function(){
    component("service-icon-field");
  };

  add_meta_box('pw-service-field', "Font Awesome icone", $callback, 'pw-services', 'side');

});


add_action('save_post_pw-services', function($post_id) {
  
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  if (isset($_POST['pw-service-icon'])){
    $post_id = wp_is_post_revision($post_id) ?: $post_id;
    $value = sanitize_text_field($_POST['pw-service-icon']);
    update_post_meta($post_id, "pw-service-icon", $value);
  }
});

?>