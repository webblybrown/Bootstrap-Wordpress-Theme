<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package orchard_hill
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
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
	</div><!-- #secondary -->
