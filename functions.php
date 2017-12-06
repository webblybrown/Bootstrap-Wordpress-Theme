<?php
define('PUBLIC_FOLDER', get_template_directory_uri());

if(!function_exists('theme_setup')) {
  add_theme_support( 'html5', array(
    'comment-list',
    'search-form',
    'comment-form',
    'gallery',
    'caption',
  ) );
    add_image_size('logo', 255, 135, true);


  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'orchard_hill' ),
  ) );
}


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
  wp_register_style('theme-style', $stylesheet_uri);
  wp_enqueue_style('theme-style');
  wp_register_script( 'googlemapsapi', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), null, false );
  wp_register_script( 'modernizr', get_template_directory_uri() . '/static/js/vendor/modernizr-2.6.2.min.js', array(), null, false );
  wp_register_script( 'scripts', get_template_directory_uri() . '/static/js/all.min.js', array( 'jquery' ), 1.2, true );
  wp_register_style('fancybox', get_template_directory_uri() . '/scripts/fancybox/jquery.fancybox-1.3.4.css');
  wp_register_style('fonts', 'http://fast.fonts.net/cssapi/2e401f7d-c270-45e0-839f-9d502031fadd.css');
  wp_enqueue_style('fonts');
  // Enqueue the scripts
  wp_enqueue_script( 'modernizr' ); 
  if ( is_page_template('template-contact.php') ) { 
    wp_enqueue_script( 'googlemapsapi' ); 
  };
    wp_register_script('scripts', $template_uri . '/scripts.js', ['jquery'], '', true);
  wp_enqueue_script('scripts');
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
function orchard_hill_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'orchard_hill' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}


// Register Custom Post Type
function job_cpt() {

  $labels = array(
    'name'                => _x( 'Jobs', 'Post Type General Name', 'orchard_hill' ),
    'singular_name'       => _x( 'Job', 'Post Type Singular Name', 'orchard_hill' ),
    'menu_name'           => __( 'Jobs', 'orchard_hill' ),
    'parent_item_colon'   => __( 'Parent Job:', 'orchard_hill' ),
    'all_items'           => __( 'All Jobs', 'orchard_hill' ),
    'view_item'           => __( 'View Job', 'orchard_hill' ),
    'add_new_item'        => __( 'Add New Job', 'orchard_hill' ),
    'add_new'             => __( 'Add New', 'orchard_hill' ),
    'edit_item'           => __( 'Edit Job', 'orchard_hill' ),
    'update_item'         => __( 'Update Job', 'orchard_hill' ),
    'search_items'        => __( 'Search Job', 'orchard_hill' ),
    'not_found'           => __( 'Not found', 'orchard_hill' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'orchard_hill' ),
  );
  $args = array(
    'label'               => __( 'job', 'orchard_hill' ),
    'description'         => __( 'Job post type', 'orchard_hill' ),
    'labels'              => $labels,
    'supports'            => array( 'title' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true
  );
  register_post_type( 'job', $args );

}

// Hook into the 'init' action
add_action( 'init', 'job_cpt', 0 );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Extra shortcodes for this template.
 */
require get_template_directory() . '/inc/shortcodes.php';




/**
 * Added by Simon
 */
function register_my_menus() {
  register_nav_menus(array('mini-nav' => __('Top menu' ),));
  register_nav_menus(array('main-nav' => __('Main Menu' ),));
  register_nav_menus(array('q-links' => __('Quick Links' ),));
  register_nav_menus(array('footer-nav' => __('Footer Menu' ),));
}
add_action( 'init', 'register_my_menus' );

function get_custom_breadcrumb($post_parent) {
  $output = '';
  $parent_title = get_the_title($post_parent);
  //echo '#' . $parent_title . '#';
  $output .= '<li><a href=' . get_permalink($post->post_parent) . ' ' . 'title=' . $parent_title . '>' . $parent_title . '</a> » </li>' . "\n";
  return $output;
}

function get_breadcrumb($post_parent) {
  $output = '';
  $parent_title = get_the_title($post_parent);
  $output .= '<li><a href=' . get_permalink($post->post_parent) . ' ' . 'title=' . $parent_title . '>' . $parent_title . '</a> » </li>' . "\n";
  return $output;
}

// define( 'ACF' , true );
// include_once( get_template_directory() . '/acf/advanced-custom-fields/acf.php' );

// add_action('acf/register_fields', 'my_register_fields');
// function my_register_fields() {
//   include_once( get_template_directory() . '/acf/acf-repeater/repeater.php');
//   include_once( get_template_directory() . '/acf/acf-flexible-content/flexible-content.php');
// }

// include_once( get_template_directory() . '/acf/acf-options-page/acf-options-page.php');
