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

									<?php get_template_part( 'content', 'page' ); ?>

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
                            
<!--
                            	<a href="/jobs/about-us/">
									<div class="">                  
										
							    	</div>
							    </a>	
-->
							
								<a href="/about/jobs">
									<div class="apply-now-button">                  
										Available Jobs
							    	</div>
							    </a>	 
                                
<!--
							    <a href="/students-apply-here">
									<div class="apply-now-button">
										Students Apply Here
							    	</div>
							    </a>
-->
							
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
