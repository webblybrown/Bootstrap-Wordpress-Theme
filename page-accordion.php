<?php
/*
Template Name: College Centres
*/
?>
<?php get_header(); ?>

		<section class="main-content">
			<div class="inside-wrap">
				<div class="w">
					<div class="g rev">
						<div class="content">
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
							<div class="blocked">
								<?php while ( have_posts() ) : the_post(); ?>

									<?php get_template_part('content', 'page'); ?>
									<?php
										if(have_rows('centres')): ?>
								<div class="accordion">
											<?php while(have_rows('centres')): the_row(); ?>
									<div class="accordion-item">
										<div class="accordion-toggle">
											<h3 class="accordion-title"><?php the_sub_field('centre_name'); ?></h3>
										</div>
										<div class="accordion-content">
											<p><?php the_sub_field('centre_address'); ?></p>
											<?php
												$image = get_sub_field('centre_image');
												$size = 'medium'; // (thumbnail, medium, large, full or custom size)
												 
												if( $image ) {
													echo wp_get_attachment_image( $image, $size );
												}
											?>
											<ul class="inline-buttons">
												<li><a class="teal" href="https://www.google.co.uk/maps/?q=<?php the_sub_field('centre_postcode'); ?>">View Map</a></li>
												<!--<li><a class="teal" href="#">Virtual Tour</a></li>-->
											</ul>
											<?php the_sub_field('centre_description'); ?>
										</div>
									</div>
											<?php endwhile; ?>
								</div>
									<?php endif; ?> 
									
								<?php endwhile; // end of the loop. ?>
								<?php $id = get_queried_object_id(); ?>

							</div>
							
						</div>
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

										$children = '								<h3 class="sub-nav-parent">' . get_the_title($parent) . '</h3>';
										$children .= wp_list_pages("title_li=&child_of=" . $parent . "&echo=0");

										if ($children) { ?>

										<ul>
											<?php echo $children; ?>
										</ul>
									<?php } ?>
								</div>
							</div>
							<div class="sidebar-item">
								<div class="box">
									<div class="blocked">
										<ul class="featured-links">
										<?php if(get_field('featured_links', 'option')) : 
											while(have_rows('featured_links', 'option')): the_row();
												echo '<li>';
												echo '	<a href="'.get_sub_field('link').'">';
												echo '		<div class="link-image link-image--'.get_sub_field('image').'">';

												echo '		</div>';
												echo '		<div class="mask text">';
												echo '			'.get_sub_field('text');
												echo '		</div>';
												echo '	</a>';
												echo '</li>';	
											endwhile;
										else : ?>
											<li>
												<a href="/learners/">
													<div class="link-image link-image--orange">

													</div>
													<div class="mask text">
														Learners
													</div>
												</a>
											</li>
											<li>
												<a href="/academy-trust/">
													<div class="link-image link-image--red">

													</div>
													<div class="mask text">
														Parents
													</div>
												</a>
											</li>
											<li>
												<a href="/partnerships/">
													<div class="link-image link-image--yellow">

													</div>
													<div class="mask text">
														Partnerships
													</div>
												</a>
											</li>
										<?php endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

<?php get_footer(); ?>
