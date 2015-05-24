<?php
/**
 * The template for displaying Single pages.
 * @package NgoCharity
 */

get_header(); 
global $ngoCharity_options;
$ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );
$cat_event = $ngoCharity_settings['event_cat'];
$cat_gallery = $ngoCharity_settings['gallery_cat'];
?>
	<div class="container">
    	<div class="row">
      		<div class="span9">
      			<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>


		            <?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>
    		</div>
			
			<div class="span3">
		    	<?php get_sidebar('right'); ?>
		    </div>
		</div>
  	</div><!-- /container --> 
<?php get_footer(); ?>