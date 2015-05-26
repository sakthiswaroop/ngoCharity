<?php
/*

Template Name: Full Width No Comment

*/

get_header(); 
global $post;
?>
	<div class="container">
    	<div class="row">
    		<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>
  	</div><!-- /container --> 
<?php get_footer(); ?>