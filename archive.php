<?php
/**
 * The template for displaying Archive pages.
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
      		<?php if(!empty($cat_event) && is_category() && is_category($cat_event)): ?>
				<div class="events">
			        <!-- <h2>Upcoming <strong>Events</strong></h2> -->
			        <ul class="events-list">
			        	<?php 
							query_posts('posts_per_page=1&meta_key=ngoCharity_event_featured&meta_value=1&order=DESC&cat='.$cat_event);
							if ( have_posts() ) :
								while ( have_posts() ) : the_post(); 
								$featuredId = get_the_ID();
								?>
						        	<li>
						              	<div class="event-box event-box-featured">
						              	<?php 
											if( has_post_thumbnail() ){
												$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
										?>
						                	<figure class="image">
						                  		<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>"></a>
						                	</figure>
						                <?php } ?>
						                	<div class="detail">
						                  		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						                  		<ul><?php ngoCharity_event_post_meta(); ?></ul>
						                	</div>
						              	</div><!-- event-box ends -->
						            </li>
								<?php endwhile; 
							endif;
							wp_reset_query();	
							?>
		    <?php endif; ?>

		    <?php if(!empty($cat_gallery) && is_category() && is_category($cat_gallery)): 
					query_posts('posts_per_page=6&cat='.$cat_gallery.'&paged='.$paged);
				endif;
				if(!empty($cat_event) && is_category() && is_category($cat_event)): 
					$featuredId = (isset($featuredId))? $featuredId : 0;
					$args = array(
						'post__not_in' => array($featuredId),
						'cat' => $cat_event,
						'posts_per_page'=> 3,
						'paged' => $paged
					);
					query_posts($args);
				endif;
				?>
			<?php if ( have_posts() ) : ?>
				<?php if(!empty($cat_gallery) && is_category() && is_category($cat_gallery)): ?>
			    <div class="row">
				<?php endif; ?>

				<?php 
					while ( have_posts() ) : the_post(); ?>
					<?php
						get_template_part( 'content' );
					?>
				<?php endwhile; ?>

				<?php if(!empty($cat_event) && is_category() && is_category($cat_event)): ?>
					</ul><!-- events-list ends -->
    			</div><!-- events end -->
			    <?php endif; ?>
    			<?php if(!empty($cat_gallery) && is_category() && is_category($cat_gallery)): ?>
			    </div>
				<?php endif; ?>
				<?php //ngoCharity_paging_nav(); ?>
				<?php 
					if (function_exists("ngoCharity_pagination_nav"))
					{
					    ngoCharity_pagination_nav();
					}
				?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; wp_reset_query(); ?>
    		</div>
			
			<div class="span3">
		    	<?php get_sidebar('right'); ?>
		    </div>
		</div>
  	</div><!-- /container --> 
<?php get_footer(); ?>