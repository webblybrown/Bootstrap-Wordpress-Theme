<?php get_header(); ?>
		<section class="main-content">
			<div class="inside-wrap">
				<div class="w">
					<div class="g">
						<div class="full-feed">
						<?php if ( have_posts() ) : ?>

							<header class="page-header">
								<h1 class="page-title">
									<?php
										if ( is_category() ) :
											single_cat_title();

										elseif ( is_tag() ) :
											single_tag_title();

										elseif ( is_author() ) :
											printf( __( 'Author: %s', 'orchard_hill' ), '<span class="vcard">' . get_the_author() . '</span>' );

										elseif ( is_day() ) :
											printf( __( 'Day: %s', 'orchard_hill' ), '<span>' . get_the_date() . '</span>' );

										elseif ( is_month() ) :
											printf( __( 'Month: %s', 'orchard_hill' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'orchard_hill' ) ) . '</span>' );

										elseif ( is_year() ) :
											printf( __( 'Year: %s', 'orchard_hill' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'orchard_hill' ) ) . '</span>' );

										elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
											_e( 'Asides', 'orchard_hill' );

										elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
											_e( 'Galleries', 'orchard_hill');

										elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
											_e( 'Images', 'orchard_hill');

										elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
											_e( 'Videos', 'orchard_hill' );

										elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
											_e( 'Quotes', 'orchard_hill' );

										elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
											_e( 'Links', 'orchard_hill' );

										elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
											_e( 'Statuses', 'orchard_hill' );

										elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
											_e( 'Audios', 'orchard_hill' );

										elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
											_e( 'Chats', 'orchard_hill' );

										else :
											_e( 'Archives', 'orchard_hill' );

										endif;
									?>
								</h1>
								<?php
									// Show an optional term description.
									$term_description = term_description();
									if ( ! empty( $term_description ) ) :
										printf( '<div class="taxonomy-description">%s</div>', $term_description );
									endif;
								?>
							</header><!-- .page-header -->

								<?php /* Start the Loop */ ?>
									<?php while ( have_posts() ) : the_post(); ?>

										<?php
											/* Include the Post-Format-specific template for the content.
											 * If you want to override this in a child theme, then include a file
											 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
											 */
											get_template_part( 'content', get_post_format() );
										?>

									<?php endwhile; ?>


							<?php else : ?>

									<?php get_template_part( 'content', 'none' ); ?>

							<?php endif; ?>
						</div>
						<?php orchard_hill_paging_nav(); ?>
						<div class="full-width">
							<div class="widget-area widget-area--base">
							<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

								
								<aside id="archives" class="widget">
									<h1 class="widget-title"><?php _e( 'Archives', 'orchard_hill' ); ?></h1>
									<ul>
										<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
									</ul>
								</aside>
								
								<aside id="search" class="widget widget_search">
									<h3 class="widget-title">Still can't find what you're looking for?</h3>
									<?php get_search_form(); ?>
								</aside>

								

							<?php endif; // end sidebar widget area ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php get_footer(); ?>


