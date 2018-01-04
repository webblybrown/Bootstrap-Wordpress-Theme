<?php
/*
Template Name: Blank
*/
get_header(); 
?>



<div class="container">
	<?php the_content(); ?>
</div>

 <?php
  endwhile;
else:
  echo '<div class="container">Sorry, no posts matched your criteria</div>';
endif;
?>

			

<?php get_footer(); ?>


