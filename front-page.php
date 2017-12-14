<?php
/*
Template Name: Home
*/
get_header(); 
if(have_posts()):
  while(have_posts()): the_post();
  	$image = get_field('page_header');
?>		

<div class="owl-carousel owl-theme slider">
		<?php
		while( have_rows('slider') ): the_row();
		$image = get_sub_field('image');
		$text = get_sub_field('text');
		?>
		<div class="item" style="background-image: url('<?php echo $image; ?>'); ">
			    <div class="header-overlay">
			    	<div class="theme-box"><?php echo $text; ?></div>
			    </div>
    
		</div>
		<?php endwhile; ?>
</div>
<div class="container">
	<?php the_content(); ?>
</div>
<div class="welcome container">
			<h1><?php the_field('head_teachers_heading'); ?></h1>
			<div><?php the_field('head_teachers_welcome'); ?></div>
			<p><span class="name"><?php the_field('headteacher_name'); ?></span> - Headteacher</p>
</div>
<div class="slogan">
  <div class="container">
  	<hr />
    <span class="wow fadeIn" data-wow-duration="2s"><?php the_field('slogan_text'); ?></span>
    <hr />
  </div>
</div>
 <?php
  endwhile;
else:
  echo '<div class="container">Sorry, no posts matched your criteria</div>';
endif;
?>

			

<?php get_footer(); ?>


