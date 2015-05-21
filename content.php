<?php 

/**
* @package NgoCharity
*/

global $ngoCharity_options;
$ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);

$cat_blog = $ngoCharity_settings['blog_cat'];
$cat_gallery = $ngoCharity_settings['gallery_cat'];
$cat_testimonial = $ngoCharity_settings['testimonial_cat'];
$cat_event = $ngoCharity_settings['event_cat'];
?>

<?php if(!empty($cat_event) && is_category() && is_category($cat_event)): ?>
	
    <li>
      	<div class="event-box">
        	<?php 
				if( has_post_thumbnail() ){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
			?>
        	<figure class="image">
          		<a href="<?php the_permalink(); ?>">
          			<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
          		</a>
        	</figure>
        	<?php } 
        		$event_date = get_post_meta( get_the_ID(), 'ngoCharity_event_date', true );
        		$event_time = get_post_meta( get_the_ID(), 'ngoCharity_event_time', true );
        		$event_time_md = get_post_meta( get_the_ID(), 'ngoCharity_event_time_md', true );
        		$event_venue = get_post_meta( get_the_ID(), 'ngoCharity_event_venue', true );
        	?>

        	<div class="detail">
          		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          		<ul>
            		<li>
            			<span><i class="icon-date"></i><?php echo $event_date; ?></span>
            			<span><?php echo $event_time." ". $event_time_md; ?></span>
            		</li>
            		<li><span><i class="icon-location"></i><?php echo $event_venue; ?></span></li>
          		</ul>
        	</div>
      	</div><!-- event-box ends -->
    </li>
<?php elseif(!empty($cat_blog) && is_category() && is_category($cat_blog)): ?>
	<section class="blog-box">
		<?php 
			if( has_post_thumbnail() ){
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
		?>
		<div class="image">
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>"></a>
		</div>
		<?php } ?>
		<div class="blog-info clearfix">
			<div class="blog-left">
				<figure class="snap"><img src="<?php bloginfo('template_directory'); ?>/images/resource/thumbs/snap-6.jpg" alt="snap"></figure>
				<a href="<?php the_permalink(); ?>">Dan Clark</a>
				<!-- <p><span class="text-yallow">Ngo</span>, Annual Funding, People</p> -->
			</div><!-- blog-left ends -->
			<div class="blog-details">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<p class="date"><?php the_date('l, j F, Y'); ?></p>
				<p><?php echo ngoCharity_excerpt(get_the_content() , $ngoCharity_settings['post_char_length']? : 400 ); ?></p>
				<a href="<?php the_permalink(); ?>" class="readmore"><?php echo $ngoCharity_settings['post_readmore_text']? : 'Read More'; ?></a>
			</div><!-- details end -->
		</div><!-- blog-info ends -->
	</section><!-- blog-box ends -->
<?php elseif(!empty($cat_gallery) && is_category() && is_category($cat_gallery)): ?>
<?php elseif(!empty($cat_testimonial) && is_category() && is_category($cat_testimonial)): ?>
<?php else: ?>
<?php endif; ?>
