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
						<?php if(get_post_type() === 'job'): ?>
							<div id="secondary" class="widget-area" role="complementary">
								<aside class="widget">		
									<h3 class="widget-title">Available Jobs</h3>		
									<ul>
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
											
											echo '<li> <a href="'.get_permalink().'">';
											the_title();
											if($salary) {
												echo ' <span class="salary">('.$salary.')</span>';
											}
											echo '</a></li>';
										}
										
									} else {
										echo '<li>Currently there aren\'t any vacancies.</li>';
									}

									// Restore original Post Data
									wp_reset_postdata();
									?>
									</ul>
								</aside>	
							</div>
						<?php else : ?>
							<?php get_sidebar(); ?>
						<?php endif; ?>
						</div>
				</div>
				 <div class="col-md-9 content">
				 		<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php if(!get_post_type() === 'job'): ?>
									<?php orchard_hill_post_nav(); ?>
								<?php endif; ?>
							<?php endwhile; ?>
				 </div>

</div>


<?php get_footer(); ?>
