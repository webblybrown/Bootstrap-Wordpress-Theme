<?php 
/*
Template Name: Contact
*/
get_header(); ?>
		<img src="<?php the_field('header_image'); ?>" style="width: 100%"/>
			<div class="container page">
							<ul class="breadcrumb">
								<li><a href="/"><span>Home</span></a></li>
								<?php
									$ancestors_array = array_reverse(array_map('get_post', get_post_ancestors($post )));
									$ancestors_array[] = $post;
									$i = 1;
									$count = count($ancestors_array);
									foreach ($ancestors_array as $value) {
										if ($count == $i++) {
											echo '<li><span>' . get_the_title($post) . '</span></li>';
										} else {
											echo '<li><a href="' . get_permalink($value) . '">' . get_the_title($value) . '</a></li>';
										}
									}
								?> 
							</ul>
				<div class="col-md-3 no-pad-left">
											<div class="sidebar">
							<div class="sidebar-item">
								<div class="sub-nav">
									<?php
										if ($post->post_parent)	{
											$ancestors=get_post_ancestors($post->ID);
											$root=count($ancestors)-1;
											$parent = $ancestors[$root];
										} else {
											$parent = $post->ID;
										}

										$extra_pages = get_field('extra_sub_links', $parent);

										$args = array(
											'child_of'     => $parent,
											'echo'         => 0,
											'exclude'      => '',
											'include'      => '',
											'post_type'    => 'page',
											'post_status'  => 'publish',
											'sort_column'  => 'post_date',
											'title_li'     => ''
										);

										$children = '								<h3 class="sub-nav-parent"><a href="'.get_permalink($parent).'">' . get_the_title($parent) . '</a></h3>';
										$children .= wp_list_pages($args);

										if ($children) { ?>

										<ul>
											<?php echo $children; ?>
											
											<?php if( $extra_pages ): ?>
										    <?php foreach( $extra_pages as $extra_page): ?>
										        <li>
										            <a href="<?php echo get_permalink($extra_page->ID); ?>"><?php echo get_the_title($extra_page->ID); ?></a>
										        </li>
										    <?php endforeach; ?>
											<?php endif; ?>
										</ul>
									<?php } ?>
								</div>
							</div>
							<div class="sidebar-item"> 
								<?php 

									$apply_pages = get_field('apply_now_button_pages', 'option');

									if( $apply_pages ):
										// Store the pages we've selected and push them into a new
										// array called $pages_array
										$pages_array = array();
										foreach( $apply_pages as $apply_page): 
											$pages_array[] = $apply_page->ID;
									    endforeach;
									    
									    $app_form_page = get_field('select_application_form_page', 'option');

									    if (is_page($pages_array)) : 
										    echo '<a href="';
											if ($app_form_page) {
												echo $app_form_page;
											} else {
												get_permalink(442);
											}
									    endif; 

									endif;

								?>
							</div>
                            

							
								<a href="/about/jobs">
									<div class="apply-now-button">                  
										Available Jobs
							    	</div>
							    </a>	 
                                

	
						</div>

				</div>
                <div class="col-md-9 content-page">
                	<?php while ( have_posts() ) : the_post(); ?>
                			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                		

									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<hr />
	<?php echo do_shortcode('[contact-form-7 id="429" title="Contact Form"]'); ?>
                		
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'orchard_hill' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

								<?php endwhile; // end of the loop. ?>
								<?php $id = get_queried_object_id(); ?>
                </div>

			</div>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPmK6ah9PPh8Vkt0oElKa5_Aq0ZeckAwc"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	
	// center map
	center_map( map );
	
	
	// return
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>
<?php 

$location = get_field('location');

if( !empty($location) ):
?>
<div class="acf-map" id="map">
	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
</div>
<?php endif; ?>
<?php get_footer(); ?>
