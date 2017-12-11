<?php
/*
Template Name: Home
*/
get_header(); 
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

<div class="welcome container">
			<h1>Head Teachers Welcome</h1>
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


			

<?php get_footer(); ?>


