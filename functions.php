<?php
define('PUBLIC_FOLDER', get_template_directory_uri());

if(!function_exists('theme_setup')) {
  function theme_setup() {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
      'search-form',
      'gallery',
      'caption',
    ]);
    add_image_size('example', 1600, 750, true);

    register_nav_menus([
      'main_menu' => 'Main Menu'
    ]);
  }
}
add_action('after_setup_theme', 'theme_setup');

function theme_scripts() {
  $template_uri = PUBLIC_FOLDER;
  $stylesheet_uri = get_stylesheet_uri();
  wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', false, '1.8.1' );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script('owl-js', $template_uri . '/scripts/owl.carousel.min.js', array('jquery'), '2.2.1', true );
  wp_enqueue_script('owl-js');
  wp_enqueue_script('wow-js', $template_uri . '/scripts/wow.js', array('jquery'), '0.1.0', true );
  wp_enqueue_script('wow-js');
  wp_enqueue_script('bootstrap-js', $template_uri . '/scripts/bootstrap.min.js', array('jquery'), '3.3.7', true );
  wp_enqueue_script('bootstrap-js');
  wp_register_script('scripts', $template_uri . '/scripts.js', ['jquery'], '', true);
  wp_enqueue_script('scripts');
  wp_register_style('theme-style', $stylesheet_uri);
  wp_enqueue_style('theme-style');
}
add_action('wp_enqueue_scripts', 'theme_scripts');

function async_script_load($tag, $handle) {
  if(is_admin()) return $tag;

  $excluded_scripts = [
    'jquery-core'
  ];

  if(!is_admin()) {
    if(in_array($handle, $excluded_scripts)) {
      return $tag;
    } else {
      return str_replace(' src', ' defer src', $tag);
    }
  }
}
add_filter('script_loader_tag', 'async_script_load', 10, 2);

function include_additional_files() {
  $template_url = get_template_directory();

  require_once $template_url . '/includes/acf-options.php';
}
add_action('init', 'include_additional_files', 1);

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'THEMENAME' ),
) );

// Remove Query Strings From Static Resources in WordPress
function _remove_script_version( $src ){ 
$parts = explode( '?', $src );  
return $parts[0]; 
} 
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 ); 
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


// Custom Login Page stuff
function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function login_checked_remember_me() {
add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
echo "<script>document.getElementById('rememberme').checked = true;</script>";
}
