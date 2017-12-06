<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package orchard_hill
 */

get_header(); ?>
	<section class="main-content">
		<div class="inside-wrap">
			<div class="w">
				<div class="g">
					<div class="full-feed">

					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'orchard_hill' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'content', 'search' );
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
