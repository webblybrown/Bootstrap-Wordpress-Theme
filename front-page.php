<?php get_header(); ?>		
		<section class="main-content">
			<div class="inside-wrap">
				<div class="w">
					<div class="g">
						<div class="content collapsable">
							<ul class="featured-links featured-links--horz">
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
									<a href="/parents/">
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
							<div class="blocked">
								<?php while (have_posts()) : the_post(); ?>
								<h1 class="mega-title"><?php the_title(); ?></h1>
								<div class="center-align">
									<?php get_template_part( 'content', 'page' ); ?>
								</div>
								<?php endwhile; ?>
							</div>
						</div>
						<div class="sidebar collapsable">
							<div class="sidebar-item">
								<div class="box">
									<div class="flexslider featured-news">
										<ul class="slides">
										<?php 
											$title_red = get_field('title_red');
											$subtitle_red = get_field('subtitle_red');
											$image_red = get_field('image_red');
											$text_red = get_field('text_red');
											$link_red = get_field('link_red');

											if ($title_red || $subtitle_red || $image_red || $text_red || $link_red) {
												echo '<li>';
												echo '	<div class="blocked">';
												if ($title_red)
													echo '		<h2 class="featured-news-title">'.$title_red.'</h2>';
												if ($subtitle_red) {
													echo ' 		<h4>';
													if ($link_red)
														echo '<a href="'.$link_red.'">';
													echo $subtitle_red;
													if ($link_red)
														echo '</a>';
													echo '</h4>';
												}
												if ($image_red) {
													echo '		<p>';
													if ($link_red)
														echo '<a href="'.$link_red.'">';
													echo wp_get_attachment_image( $image_red, 'medium' );
													if ($link_red)
														echo '</a>';
													echo '		</p>';
												}
												if ($text_red)
													echo '		<p>'.$text_red.'</p>';
												
												echo ' 	</div>';
												if ($link_red)
													echo '		<div class="blocked button"><a href="'.$link_red.'">Read more</a></div>';
												echo '</li>';
											}
										

											// WP_Query arguments
											$args = array (
												'post_type' => 'post',
												'posts_per_page' => 1,
												'post_status' => 'publish'
											);

											// The Query
											$query = new WP_Query( $args );

											// The Loop
											if ( $query->have_posts() ) {
												while ( $query->have_posts() ) {
													$query->the_post(); ?>
											<li>
												<div class="blocked">
													<h2 class="featured-news-title teal">Latest News</h2>
													<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
													<?php if (has_post_thumbnail()) : ?>
													<p><?php the_post_thumbnail('post-header'); ?></p>
													<?php excerpt('15'); ?>
													<?php else: ?>
													<p><?php the_excerpt(); ?></p>
													<?php endif; ?>
												</div>
												<div class="blocked button teal">
													<a href="<?php the_permalink(); ?>">Read more</a>
												</div>
											</li>
											<?php
												}
											}
											// Restore original Post Data
											wp_reset_postdata();
										
											$title_orange = get_field('title_orange');
											$subtitle_orange = get_field('subtitle_orange');
											$image_orange = get_field('image_orange');
											$text_orange = get_field('text_orange');
											$link_orange = get_field('link_orange');

											if ($title_orange || $subtitle_orange || $image_orange || $text_orange || $link_orange) {
												echo '<li>';
												echo '	<div class="blocked">';
												if ($title_orange)
													echo '		<h2 class="featured-news-title orange">'.$title_orange.'</h2>';
												if ($subtitle_orange) {
													echo ' 		<h4>';
													if ($link_orange)
														echo '<a href="'.$link_orange.'">';
													echo $subtitle_orange;
													if ($link_orange)
														echo '</a>';
													echo '</h4>';
												}
												if ($image_orange) {
													echo '		<p>';
													if ($link_orange)
														echo '<a href="'.$link_orange.'">';
													echo wp_get_attachment_image( $image_orange, 'medium' );
													if ($link_orange)
														echo '</a>';
													echo '		</p>';
												}
												if ($text_orange)
													echo '		<p>'.$text_orange.'</p>';
												echo ' 	</div>';
												if ($link_orange)
													echo '		<div class="blocked button orange"><a href="'.$link_orange.'">Read more</a></div>';
												echo '</li>';
											}
										?>
										</ul>
									</div>
								</div>
							</div>
							<div class="sidebar-item">
								<div class="box">
									<?php if(get_field('extrabox_title') || get_field('extrabox_text')): ?>
									<div class="blocked">
										<?php if (get_field('extrabox_title')) : ?>
										<h2><?php the_field('extrabox_title'); ?></h2>
										<?php endif; ?>
										<?php the_field('extrabox_text'); ?>
									</div>
									<?php endif; ?>
									<!--<div class="blocked red">
										<h2><?php the_field('downloads_title'); ?></h2>
										<ul class="download-list">
											<?php if(get_post_status(398) === 'publish') : ?>
											<li>
												<a href="<?php echo get_the_permalink(398); ?>"><span class="icon-brochure"> </span>Order by post</a>
											</li>
											<?php endif; ?>
											<?php if(get_field('downloads_item_download')) : ?>
											<li>
												<a href="<?php the_field('downloads_item_download'); ?>"><span class="icon-pdf"> </span><?php the_field('downloads_item_title'); ?></a>
											</li>
											<?php endif; ?>
										</ul>
									</div>-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		

		<section class="blocked-content">
			<div class="w">
				<div class="g">
					<h2 class="helper-title">The latest at <?php bloginfo( 'name' ); ?></h2>
				</div>
				<div class="news-feed flexslider">
					<ul class="slides">
					<?php 
							// WP_Query arguments
							$args = array (
								'post_type' => 'post',
								'posts_per_page' => 9,
								'post_status' => 'publish'
							);

							// The Query
							$query = new WP_Query( $args );

							// The Loop
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post(); ?>
									<li class="news-item">
										<a href="<?php the_permalink(); ?>">
											<?php if (has_post_thumbnail()) : ?>
												<div class="header">
													<?php the_post_thumbnail('post-header'); ?>
												</div>
											<?php endif; ?>
											<div class="blocked">
												<h3><?php the_title(); ?></h3>
												<?php if (has_post_thumbnail()) : ?>
												<p><?php excerpt('15'); ?></p>
												<?php else: ?>
												<p><?php the_excerpt(); ?></p>
												<?php endif; ?>
											</div>
										</a>
										<div class="news-meta">
											<span class="date"><?php echo get_the_date('jS F Y'); ?></span>
										</div>
									</li>
								<?php }
							}
							// Restore original Post Data
							wp_reset_postdata();


						?>
					</ul>
				</div>
			</div>
		</section>
<?php get_footer(); ?>
