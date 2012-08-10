<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/css/bootstrap.css
 * 2. /theme/css/bootstrap-responsive.css      (if enabled in config.php)
 * 3. /theme/css/app.css
 * 4. /child-theme/style.css                   (if a child theme is activated)
 *
 * Enqueue scripts in the following order:
 * 1. /theme/js/vendor/modernizr-2.5.3.min.js  (in header.php)
 * 2. jquery-1.7.2.min.js via Google CDN       (in header.php)
 * 3. /theme/js/plugins.js
 * 4. /theme/js/main.js
 */

function roots_scripts() {
  wp_enqueue_style('roots_bootstrap', get_template_directory_uri() . '/css/bootstrap.css', false, null);

  if (current_theme_supports('bootstrap-responsive')) {
    wp_enqueue_style('roots_bootstrap_responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css', array('roots_bootstrap'), null);
  }

  // If you're not using Bootstrap, include HTML5 Boilerplate's main.css:
  // wp_enqueue_style('roots_h5bp', get_template_directory_uri() . '/css/main.css', false, null);

  wp_enqueue_style('roots_app', get_template_directory_uri() . '/css/app.css', false, null);

  // Load style.css from child theme
  if (is_child_theme()) {
    wp_enqueue_style('roots_child', get_stylesheet_uri(), false, null);
  }

  // jQuery is loaded in header.php using the same method from HTML5 Boilerplate:
  // Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '', '', '', false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('roots_plugins', get_template_directory_uri() . '/js/plugins.js', false, null, false);

  function pixl_bootstrap_scripts() {

    //Bootstrap tab plugin
    wp_register_script('pixl_scripts',get_template_directory_uri() . '/js/bootstrap/bootstrap-tab.js');   
    wp_register_script('pixl_scripts',get_template_directory_uri() . '/js/bootstrap/bootstrap-carousel.js');
   
  }  
  
  wp_register_script('roots_main', get_template_directory_uri() . '/js/main.js', false, null, false);
  wp_enqueue_script('roots_plugins');
  wp_enqueue_script('roots_main');
}

add_action('wp_enqueue_scripts', 'roots_scripts', 100);
add_action('wp_enqueue_scripts','pixl_bootstrap_scripts',110);

//regsiter fancy box scripts on blog page
function fancybox_scripts() {
    wp_register_script('fancybox', get_template_directory_uri() . '/js/fancybox/fancybox-pack.js',array('jquery'),null,false);
    wp_register_style('fancybox',get_template_directory_uri().'/css/fancybox/fancybox.css',false,null);

    if( is_single() ) {
      wp_enqueue_script('fancybox');
      wp_enqueue_style('fancybox');
    }
}


function syntax_highlighter() {
  if(is_single()) :

  wp_register_script('syntax_highlighter',get_template_directory_uri() . '/js/highlight.pack.js', false,null,false);
  wp_register_style('syntax_highlighter',get_template_directory_uri() . '/css/code.css', false,null,false);
  wp_enqueue_script('syntax_highlighter');
  wp_enqueue_style('syntax_highlighter');
  ?>

<?php endif;

}
?>
<?php 
add_action('wp_enqueue_scripts','fancybox_scripts');
add_action('wp_enqueue_scripts','syntax_highlighter',1);
remove_filter('the_content', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');

function lphpjs_code( $atts, $content = null ) {
  $content = strtr($content,array("\r\n"=>'',"\r"=>'',"\n"=>'')); // ou tirar os brs
  $c = false;
  if( isset( $atts["class"] ) ){
    $c = $atts["class"];
  }else if( isset( $atts["lang"] ) ){
    $c = $atts["lang"];
  }
  if( $c )
    return "<pre><code class=\"$c\">".$content."</code></pre>";
  else
    return "<pre><code>".$content."</code></pre>";
}

// add_shortcode('code', 'lphpjs_code');

