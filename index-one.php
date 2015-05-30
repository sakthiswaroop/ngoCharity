<?php

global $ngoCharity_options;
$ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );

$cat_event = $ngoCharity_settings['event_cat'];
?>

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
					        'posts_per_page'=> 3
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
			    	<form method="post" action="http://www.extracoding.com/demo/html/help/index.html">
				      	<div class="donate-detail">
				        	<h3>Turpis nisi ac integer, ridiculus, elit. Urna, mid</h3>
				        	<div class="ratio">
				          		79% Raised
				        	</div>
				        	<div class="progress">
					          	<div class="bar" style="width:79%"></div>
					        </div>
					    </div><!-- donate-detail ends -->
					    <ul>
					        <li>Funds Raised <span>$11,223</span></li>
					        <li>Goal <span>$25,000</span></li>
					    </ul>
					    <input type="submit" class="btn btn-donate" value="Donate Now">
				    </form>
			  	</div><!-- donate-box ends -->
			</div><!-- donate ends -->
			<div class="twitter">
			  	<h2>Twitter <strong>Feeds</strong></h2>
			  	<div class="tweets-box">
			    	<ul class="tweets-list">
				      	<li>
				        	<h6>Lenny Kravitz (15 hours ago)</h6>
				        	<p>The <a href="#">#blackandwhiteamerica</a> album cover will be revealed March 1st during my first appearance ever <a href="#">http://bit.ly/trg87z</a></p>        
				      	</li>
				      	<li>
					        <h6>Lenny Kravitz (15 hours ago)</h6>
				        	<p>The <a href="#">#blackandwhiteamerica</a> album cover will be revealed March 1st during my first appearance ever <a href="#">http://bit.ly/trg87z</a></p>        
				      	</li>
				      	<li>
				        	<h6>Lenny Kravitz (15 hours ago)</h6>
				        	<p>The <a href="#">#blackandwhiteamerica</a> album cover will be revealed March 1st during my first appearance ever <a href="#">http://bit.ly/trg87z</a></p>        
				      	</li>
				      	<li>
				        	<h6>Lenny Kravitz (15 hours ago)</h6>
				        	<p>The <a href="#">#blackandwhiteamerica</a> album cover will be revealed March 1st during my first appearance ever <a href="#">http://bit.ly/trg87z</a></p>        
				      	</li>
			    	</ul>
			  	</div><!-- tweets-box ends -->
			  	<div class="follow-twitter">Follow us on Twitter</div>
			</div><!-- twitter ends -->
    		</div>
    		<div class="span3">
    			<?php get_sidebar('right'); ?>
    		</div>
    		
		</div>
  	</div><!-- /container --> 


