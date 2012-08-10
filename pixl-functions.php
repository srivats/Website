<?php 
// slider custom post type
function slider_register() {

  $args = array(
    'label' => __('Slider'),
    'public' => true,
    'show_ui'=> true,
    'rewrite' => true,    
    'supports' => array('title', 'editor', 'thumbnail'),
    'capability_type' => 'post',
    );
  register_post_type('image-slider' , $args);
}

add_action('init', 'slider_register');  

// get slider images 
function get_image_slider() {
  $image_slider = '<div id="image-slider" class="image-carousel carousel slide">
                  <div class="carousel-inner">';
  $slider_query = 'post_type=image-slider';

  query_posts($slider_query);
  if (have_posts())
  {
    while (have_posts()) {
       the_post();
       $img= get_the_post_thumbnail( $post->ID, 'large' );       
       $image_slider.= '<div class="item">'.$img .'</div>';
    }
  }
  wp_reset_query();
  
  $image_slider.='</div>';
  // add prev & next arrows
  $image_slider.='<a class="carousel-control left" href="#image-slider" data-slide="prev">&lsaquo;</a>';
  $image_slider.='<a class="carousel-control right" href="#image-slider" data-slide="next">&rsaquo;</a>';
  $image_slider.='</div>';
  return $image_slider;
}

function insert_image_slider($att,$content=null) {
  $slider=get_image_slider();
  return $slider;
}

function image_slider() {
  print get_image_slider();
}

//testimonials custom type

function testimonial_register() {
  $args = array(
        'label' => 'Client Testimonials',
        'public' => 'true',
        'show_ui'=> true,
        'supports' => array('title','editor','custom-fields'),
        'capability_type' => 'post'
  );
  register_post_type('testimonials', $args);
}

add_action('init','testimonial_register');

function set_testimonial_custom_fields($post_id) {
  if($_GET['post_type']=='testimonials') {
    add_post_meta($post_id, 'Client Name', '', true);
    add_post_meta($post_id, 'Website', '', true);
  }

  return true;
}

add_action('wp_insert_post', 'set_testimonial_custom_fields');

function display_testimonials() {
  
  $testimonials_slider = '<div id="testimonials-slider" class="testimonials-carousel carousel slide">
                  <div class="carousel-inner">';
  $testimonials_query = 'post_type=testimonials';
  $result=new WP_Query($testimonials_query);
    while($result->have_posts()) {
      $result->the_post();
      $client_name = get_post_meta(get_the_ID(), 'Client Name', true);
      $website_link = get_post_meta(get_the_ID(),'Website',true);
      $testimonials_slider.= '<div class="item">';
      $testimonials_slider.= '<div>'.get_the_content().'</div>';
      $testimonials_slider.='<div class="client-name">'.$client_name.'</div>';
      $testimonials_slider.='<div class="website-link"><a href="http://'.$website_link.'" rel="nofollow">'.$website_link.'</a></div>';
      $testimonials_slider.='</div></div>';
      $testimonials_slider.='<a class="carousel-control left" href="#testimonials-slider" data-slide="prev">&lsaquo;</a>';
      $testimonials_slider.='<a class="carousel-control right" href="#testimonials-slider" data-slide="next">&rsaquo;</a>';
      $testimonials_slider.='</div>';
  }
  return $testimonials_slider;
}


add_action('init','add_code_button');

function add_code_button() {
  if( !current_user_can('edit_posts') && !current_user_can('edit_pages')) {
    return;
  }
    if ( get_user_option('rich_editing') == 'true') {
    add_filter('mce_external_plugins','add_code_plugin');
    add_filter('mce_buttons','register_code_button');
  }
  
}

function register_code_button($buttons) {
  array_push($buttons,"separator", 'code');
  return $buttons;
}

function add_code_plugin($plugin_array) {
  $plugin_array['code'] = get_template_directory_uri().'/js/code_plugin.js';
  return $plugin_array;
}

function pixl_code( $atts,$content = null) {
  extract(shortcode_atts(array(
      'class' => $atts['class']
    ), $atts));
  return '<pre><code class='.$class.'>'.$content.'</code></pre>';
}

add_shortcode('code','pixl_code');