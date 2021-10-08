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
      'menu_icon' => 'dashicons-admin-page',
      'has_archive' => false,
      'supports' => ['title', 'editor'],
      'rewrite' => ['slug' => 'servicos']
    ]
  );

});


add_action('add_meta_boxes', function(){
  
  $callback = function(){
    get_template_part('inc/services/metabox');
  };

  add_meta_box('my-meta-box', "Font Awesome icone", $callback, 'pw-services', 'side');

});

add_action('save_post', function($post_id) {
  
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ):
    return;
  endif;
     
  $post_id = wp_is_post_revision($post_id) ?: $post_id;
  update_post_meta($post_id, "pw-icon", sanitize_text_field($_POST['pw-icon']));
});

?>