<div class="nav-boxes container">
   
		<?php
    $i =1;
		while( have_rows('nav_boxes', 'options') ): the_row();
		$image = get_sub_field('image');
		$text = get_sub_field('text');
		$link = get_sub_field('link');
		?>
        <div class="col-md-4 wow fadeIn" data-wow-duration="<?php echo $i; ?>s">
        <a href="<?php echo $link; ?>">
        <div class="overlay">
         <img src="<?php echo $image; ?>" class="img-responsive" />
         <div class="overlay-content">
         <div><?php echo $text; ?></div>
        </div>
       </div></a>
      </div>
		<?php $i++; endwhile; ?>
 
</div>
<div class="testimonial">
<div class="container">
  <div class="pad wow fadeIn" data-wow-duration="2s"><?php the_field('testimonials', 'options'); ?></div>
  <img src="<?php echo get_template_directory_uri(); ?>/images/quote-left.png" class="left" />
  <img src="<?php echo get_template_directory_uri(); ?>/images/quote-right.png" class="right" />
 </div>
 </div>
</div>

<div class="container news">
      <h1>Latest News</h1>
      <?php $x = 1; ?>
      <?php query_posts('showposts=4'); if (have_posts()) : while (have_posts()) : the_post(); ?>

	        <div class="wow fadeIn col-md-3" data-wow-duration="<?php echo $x; ?>s">
        <a href="<?php the_permalink(); ?>">
        <img src="<?php the_field('post_thumbnail'); ?>" class="img-responsive" />
        <h2><?php the_title(); ?></h2></a>
        <div class="excerpt"><?php the_excerpt(); ?></div>
        <a class="read-more" href="<?php the_permalink(); ?>">Read more</a>

        </div>

<?php $x++; endwhile;?>


<?php else : ?>

	<h1>Not Found</h1>

<?php endif; wp_reset_query(); ?>
	</div>

  <div class="container logos">
 <div class="owl-carousel owl-theme footer-logos">
		<?php
		while( have_rows('footer_logos', 'options') ): the_row();
		$image = get_sub_field('image');
		?>
		<div class="item">
           <img src="<?php echo $image; ?>" />
		</div>
		<?php endwhile; ?>
</div>
</div>



 <footer>
  <div class="footer">
 <div class="container">
<div class="col-md-6">
	<img src="<?php the_field('footer_logo','options') ?>" />
	<p><?php the_field('text_left','options') ?></p>
</div>
<div class="col-md-6 text-right">
	<div class="footer-right"><?php the_field('text_right','options') ?></div>
</div>
 </div>
  </div>
 <div class="copyright">
 	<div class="container">
<p>If you would like a paper copy of the information on this website, we will provide this free of charge</p>
<p>Website Deisgn and Development by <a href="" target="_blank">Design Image</a></p>
 </div>
 </div>
 </footer>   

    <?php wp_footer(); ?>
<script>
  (function($) {
  $("#menu-main-menu").prepend("<li><a href='<?php echo site_url(); ?>'><i class='fa fa-home' aria-hidden='true'></i></a></li>");
  })(jQuery);
</script>
  </body>
</html>
