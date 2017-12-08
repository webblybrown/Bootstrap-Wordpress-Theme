<?php
/*
Template Name: Available Jobs
*/
?>
<?php get_header(); ?>

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
											'sort_column'  => 'menu_order, post_title',
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
							</div>
						
		
  </div>
  <div class="col-md-9">
  				<?php while ( have_posts() ) : the_post(); ?>
								
								
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<header class="entry-header">
										<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
										<?php the_content(); ?><!-- .entry-content -->
									</header><!-- .entry-header -->

									<div class="job-list">
										<h2 class="job-block-title">Available Jobs</h2>
									<?php 
									// WP_Query arguments
										$today = date("Ymd");

										$args = array (
											'post_type'              => 'job',
											'pagination'             => false,
											'posts_per_page'         => '-1',
											'orderby' => 'meta_value', 
											'order' => 'DESC',
											'meta_query' => array(
												array(
													'key' => 'job_end_date',
													'value' => $today,
													'type' => 'numeric',
													'compare' => '>=',
												)
											),
										);

										// The Query
										$query = new WP_Query( $args );

									// The Loop
									if ( $query->have_posts() ) {
										while ( $query->have_posts() ) {
											$query->the_post();



											$endDateField = get_field('job_end_date');
												$endDate = date("d/m/y", strtotime($endDateField));
											$salary = get_field('job_salary');
											$location = get_field('job_location');
											$hours = get_field('job_hours');
											$appForm = get_field('job_app_form');
											$advert = get_field('job_advert_text');
											$description = get_field('job_description');
											$personSpec = get_field('job_person_specification');
											$furtherInfo = get_field('job_further_info');
											$guidance = get_field('job_guidance');
											
											echo '<div class="job">';
											echo '	<div class="job-inner">';
											echo '		<header class="job-header">';
											echo '			<h2 class="job-title">';
											echo '<a href="'.get_permalink().'">';
											the_title();
											echo '</a>';
											if($salary) {
												echo ' <span class="salary">('.$salary.')</span>';
											}
											echo '			</h2>';
											if($location || $hours) {
												echo '		<div class="job-meta-wrap">';
												if($location) {
													echo '		<span class="job-meta  job-meta--location"><strong>Location:</strong> '.$location.'</span>';
												}
												if($hours) {
													echo '		<span class="job-meta  job-meta--hours"><strong>Hours:</strong> '.$hours.'</span>';
												}
												echo '		</div>';
											}
											echo '		</header>';
											echo '		<div class="description">';
											echo '			'.$advert;
											echo '		</div>';
											echo '		<p><strong>Closing Date:</strong> '.$endDate.'</p>';
											echo '	</div>';
											echo ' 	<div class="action-bar">';
											echo '		<span class="action-link"><a href="'.get_permalink().'">View details</a></span>';
											if ($appForm) {
												echo '		<span class="action-link action-link--download"><a href="'.$appForm.'">Download Application Form</a></span>';	
											}
											echo '	</div>';
											echo '</div>';
											
										}
										
									} else {
										echo '<div class="blocked"><p>Currently there aren\'t any vacancies.</p></div>';
									}

									// Restore original Post Data
									wp_reset_postdata();
									?>
									</div>
									
									
									<footer class="entry-footer">
										<?php edit_post_link( __( 'Edit', 'orchard_hill' ), '<span class="edit-link">', '</span>' ); ?>
									</footer><!-- .entry-footer -->
								</article><!-- #post-## -->
								<?php endwhile; // end of the loop. ?>
								<?php $id = get_queried_object_id(); ?>

  </div>
</div>


<?php get_footer(); ?>
