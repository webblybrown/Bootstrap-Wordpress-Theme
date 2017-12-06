<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package orchard_hill
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function orchard_hill_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'orchard_hill_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function orchard_hill_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'orchard_hill_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function orchard_hill_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'orchard_hill' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'orchard_hill_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function orchard_hill_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'orchard_hill_setup_author' );


// Add a div wrapper for embedded media ( youtube etc )
// This allows a trick to force ratio 
// * http://css-tricks.com/NetMag/FluidWidthVideo/Article-FluidWidthVideo.php
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  	return '<div class="video-wrapper">' . $html . '</div>';
}


/** 
 * Apply styles to the visual editor 
 */    
add_filter('mce_css', 'di_mcekit_editor_style');  
function di_mcekit_editor_style($url) {  
  
    if ( !empty($url) )  
        $url .= ',';  
  
    // Retrieves the plugin directory URL  
    // Change the path here if using different directories  
    $url .= trailingslashit( get_template_directory_uri() ) . 'editor-styles.css';  
  
    return $url;  
}  
  
/** 
 * Add "Styles" drop-down 
 */   
add_filter( 'mce_buttons_2', 'di_mce_editor_buttons' );  
  
function di_mce_editor_buttons( $buttons ) {  
    array_unshift( $buttons, 'styleselect' );  
    return $buttons;  
}  

add_filter('tiny_mce_before_init', 'orchard_hill_custom_tinymce_colours');

function orchard_hill_custom_tinymce_colours ( $init ) {
  $default_colours = '';
  $custom_colours = '
      "e43130", "Red", 
      "2bb0ad", "Teal", 
      "ee7316", "Orange", 
      "fdc02a", "Yellow"
  ';
  $init['textcolor_map'] = '['.$custom_colours.']'; // build colour grid default+custom colors
  $init['textcolor_rows'] = 1; // enable 6th row for custom colours in grid
  return $init;
}


add_filter( 'tiny_mce_before_init', 'di_mce_before_init' );  
  
function di_mce_before_init( $settings ) {  
  
    $style_formats = array(
        array(
            'title' => 'Larger Text',
            'classes' => 'larger-text',
            'inline' => 'span',
            'wrapper' => true,
        ),
        array(
            'title' => 'Blockquote Author',
            'classes' => 'cite',
            'selector' => 'p',
        )
    );  
  
    $settings['style_formats'] = json_encode( $style_formats );  
  
    return $settings;  
  
}

/* 
  Excerpt lengths 
  ----
  Usage
  Standard - "<?php the_excerpt(); ?>" 
  Standard "<?php orchard_hill_excerpt('orchard_hill_excerptlength_index', 'orchard_hill_excerptmore'); ?>" 

*/
function orchard_hill_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'orchard_hill_excerpt_length' );

function orchard_hill_excerptlength_teaser( $length ) {
  return 25;
}
function orchard_hill_excerptlength_index( $length ) {
  return 10;
}
function orchard_hill_excerptmore( $more ) {
  return '&hellip;';
}

function orchard_hill_excerpt( $length_callback = '', $more_callback = '' ) {
  
  if ( function_exists( $length_callback ) )
    add_filter( 'excerpt_length', $length_callback );
  
  if ( function_exists( $more_callback ) )
    add_filter( 'excerpt_more', $more_callback );
  
  $output = get_the_excerpt();
  $output = apply_filters( 'wptexturize', $output );
  $output = apply_filters( 'convert_chars', $output );
  $output = '<p>' . $output . '</p>'; // maybe wpautop( $foo, $br )
  echo $output;
}

function excerpt($num) {
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."...";
    echo $excerpt;
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis
function orchard_hill_auto_excerpt_more( $more ) {
  return ' &hellip;';
}
add_filter( 'excerpt_more', 'orchard_hill_auto_excerpt_more' );