<?php namespace pwcode\com\theme;

add_action('init', function(){

  register_post_type('pw-projects', 
    [
      'labels' => [
        'name' => 'Projetos',
        'singular_name' => 'projeto'
      ],      
      'public' => true,
      'menu_icon' => 'data:image/svg+xml;base64, PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MC41IiBoZWlnaHQ9IjMxLjUiIHZpZXdCb3g9IjAgMCA0MC41IDMxLjUiPgogICAgPHBhdGggaWQ9Ikljb25fYXdlc29tZS1ib29rLW9wZW4iIGRhdGEtbmFtZT0iSWNvbiBhd2Vzb21lLWJvb2stb3BlbiIgZD0iTTM4LjEyNSwyLjI1NGMtMy44NTMuMjE5LTExLjUxMiwxLjAxNS0xNi4yMzksMy45MDlhMS4wODEsMS4wODEsMCwwLDAtLjUxMS45MjZWMzIuNjczYTEuMTEzLDEuMTEzLDAsMCwwLDEuNjM3Ljk0OWM0Ljg2NC0yLjQ0OCwxMS45LTMuMTE2LDE1LjM3Ny0zLjNBMi4xOTMsMi4xOTMsMCwwLDAsNDAuNSwyOC4xNjZWNC40MTJhMi4yLDIuMiwwLDAsMC0yLjM3NC0yLjE1OVpNMTguNjE0LDYuMTYyQzEzLjg4NywzLjI2OCw2LjIyOCwyLjQ3MywyLjM3NSwyLjI1NEEyLjIwNSwyLjIwNSwwLDAsMCwwLDQuNDEyVjI4LjE2N2EyLjE5MiwyLjE5MiwwLDAsMCwyLjExMSwyLjE1NmMzLjQ4LjE4MywxMC41MTguODUxLDE1LjM4MiwzLjNhMS4xMDksMS4xMDksMCwwLDAsMS42MzItLjk0NlY3LjA3NkExLjA1OSwxLjA1OSwwLDAsMCwxOC42MTQsNi4xNjJaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIC0yLjI1KSIgZmlsbD0icmdiYSgyNDAsMjQ2LDI1MiwwLjYpIi8+CiAgPC9zdmc+',
      'has_archive' => false,
      'supports' => ['title', 'editor', 'thumbnail'],
      'rewrite' => ['slug' => 'projetos']
    ]
  );  
});





?>