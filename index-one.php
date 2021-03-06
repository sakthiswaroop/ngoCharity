<?php

global $ngoCharity_options;
$ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );

$cat_event = $ngoCharity_settings['event_cat'];
$about_id = $ngoCharity_settings['about_post'];
?>
<div class="front-quote">
    <div class="container">
		<blockquote>
          	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
          		<?php echo $ngoCharity_settings['donate_quote']; ?>&emsp;
          		<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="SDKZYWTX9PXTN">
          		<button type="submit" name="submit" class="btn btn-donate">Donate Now</button>
          	</form>
        </blockquote>
    </div>
</div>

<div class="front-about">
	<div class="container">
		<div class="row">
			<div class="span8" >
				<h2><strong>Rural Health Care Center</strong><br>
				<span class="caption">Dolakha, Nepal</span></h2>
				<div class="content">
					<?php $about = get_post($about_id, ARRAY_A) ?>
					<p><?php echo ngoCharity_excerpt($about['post_content'], 500 );  ?></p>
				</div>
			</div>
			<div class="span4">
				<img src="<?php echo get_bloginfo('template_directory').'/images/ruralgroup.jpg'; ?>">
			</div>
		</div>
		<a href="<?php echo get_permalink($about_id) ?>" class="readmore">Click here to know more!</a>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span6">
			<div class="events">
			    <h2><strong>Events</strong></h2>
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
			                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'featured-thumbnail', false ); 
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

			    <?php 
			         $featuredId = (isset($featuredId))? $featuredId : 0;
			         $args = array(
					'post__not_in' => array($featuredId),
					'cat' => $cat_event,
				    'posts_per_page'=> $ngoCharity_settings['show_event_number']
				);
				query_posts($args);
			        if ( have_posts() ) : ?>
			    
			        <?php 
			            while ( have_posts() ) : the_post(); ?>
			            <?php
			                get_template_part( 'content' );
			            ?>
			        <?php endwhile; ?>
			    </ul><!-- events-list ends -->
			    <br><p><a href="<?php echo get_category_link( $cat_event ); ?>" class="btn">View All</a></p>
			</div><!-- events end -->
			<?php endif; 
			    wp_reset_query();
			?>
		</div>
		<div class="span3">
			<div class="donate">
			  	<h2>Donate <strong>Now</strong></h2>
			  	<div class="donate-box">          			
		    	   	<div class="donate-detail">
			        	<p><?php echo $ngoCharity_settings['donate_box'] ?> </p>
				    </div><!-- donate-detail ends -->
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
					    <input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="SDKZYWTX9PXTN">
					    <input type="submit" name="submit" class="btn btn-donate" value="Donate Now">
				    </form>
			  	</div><!-- donate-box ends -->
			</div><!-- donate ends -->
		</div>
		<div class="span3">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div><!-- /container -->