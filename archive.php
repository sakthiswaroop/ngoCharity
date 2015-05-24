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
			<?php if ( have_posts() ) : ?>

				<?php if(!empty($cat_event) && is_category() && is_category($cat_event)): ?>
				<div class="events">
			        <h2>Upcoming <strong>Events</strong></h2>
			        <ul class="events-list">
			        	<li>
			              	<div class="event-box event-box-featured">
			                	<figure class="image">
			                  		<a href="events-detail.html"><img src="<?php bloginfo('template_directory'); ?>/images/resource/pic-1.jpg" alt="pic"></a>
			                	</figure>
			                	<div class="detail">
			                  		<h5><a href="events-detail.html">Et et odio aenean odio facilisis ac turpis urna porta et!</a></h5>
			                  		<ul>
			                    		<li><span><i class="icon-date"></i>25 - 02 - 2013</span><span>08:00am - 12:00pm</span></li>
			                    		<li><span><i class="icon-location"></i>Washington, United States</span></li>
			                  		</ul>
			                	</div>
			              	</div><!-- event-box ends -->
			            </li>
			    <?php endif; ?>
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
			<?php endif; ?>
    		</div>
			
			<div class="span3">
		    	<?php get_sidebar('right'); ?>
		    </div>
		</div>
  	</div><!-- /container --> 
<?php get_footer(); ?>