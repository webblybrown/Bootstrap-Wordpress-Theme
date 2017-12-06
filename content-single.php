<?php
/**
 * @package orchard_hill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( get_post_type() === 'job' ) : ?>
		<div class="job-list">
			<div class="job">
			<?php 
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
				echo '	<div class="job-inner--singular">';
				echo '		<header class="job-header">';
				echo '			<h1>';
				the_title();
				if($salary) {
					echo ' <span class="salary">('.$salary.')</span>';
				}
				echo '			</h1>';
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
				echo '		<p><strong>Closing Date:</strong> '.$endDate.'</p>';
				echo '		<div class="description">';
				if ($description) {
					echo '			<hr>';
					echo '			<h2>Job Description</h2>';
				}
				echo '			'.$description;
				if ($personSpec) {
					echo '			<h2>Person Specification</h2>';
					echo '			'.$personSpec;
				}
				if ($appForm) {
					echo ' 			<div class="action-apply">';
					echo '				<p><a class="button" href="'.$appForm.'">Download Application Form</a></p>';	
					echo '			</div>';
				}
				if ($furtherInfo) {
					echo '			<h4>Further Information</h4>';
					echo '			'.$furtherInfo;
				}
				if ($guidance) {
					echo '			<h4>Application Guidance</h4>';
					echo '			'.$guidance;
				}
				if ($guidance && $appForm || $furtherInfor && $appForm) {
					echo ' 			<div class="action-apply">';
					echo '				<p><a class="button" href="'.$appForm.'">Download Application Form</a></p>';	
					echo '			</div>';
				}
				echo '		</div>';
				echo '	</div>';
				echo '</div>'; 
			?>
			</div>
			
		</div>

	<?php else : ?>
	
	<div class="news-item singular">
		<?php if (has_post_thumbnail()) : ?>
		<div class="header">
			<?php the_post_thumbnail('post-header-singular'); ?>
		</div>
		<?php endif; ?>

		<div class="blocked">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="news-meta">
			<?php
				// Display post date & author
				orchard_hill_posted_on();

				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'orchard_hill' ) );

				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'orchard_hill' ) );

				if ( ! orchard_hill_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="tags">%2$s</span>', 'orchard_hill' );
					}

				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="cats">%1$s</span> <span class="tags">%2$s</span>', 'orchard_hill' );
					} else {
						$meta_text = __( '<span class="cats">%1$s</span>', 'orchard_hill' );
					}

				} // end check for categories on this blog

				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
				);
			?>

			<?php edit_post_link( __( 'Edit', 'orchard_hill' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</div>
	<?php endif; ?>
</article><!-- #post-## -->
