<?php
/**
 * @package orchard_hill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="news-item">
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
			<?php if(get_post_type() === 'post') : ?>
			<span class="date"><?php echo get_the_date('jS F Y'); ?></span>
			<?php else : ?>
			<span>Page</span>
			<?php endif; ?>
		</div>
	</div>
</article>
