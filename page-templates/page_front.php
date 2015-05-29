<?php
/*

Template Name: Front Page

*/

get_header();
global $post;
?>
	<div class="container">
    	<div class="row">
    		<div class="span9">
    			<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>
    		</div>
    		<div class="span3">
    			<?php get_sidebar('right'); ?>
    		</div>
    		
		</div>
  	</div><!-- /container --> 
<?php get_footer(); ?>