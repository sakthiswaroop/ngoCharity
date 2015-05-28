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
            		<?php ngoCharity_event_post_meta();  ?>
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
				<figure class="snap"><?php echo get_avatar(get_the_author_meta('ID')); ?></figure>
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a>
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
	<div class="span2">
	<div class="gallery">
	<?php 
		if( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
	?>
		<div class="image">
	        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> gallery"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?> gallery">
	        	<div class="image-info">
	            	<p><?php the_title(); ?></p>
	        	</div>
	        </a>
	    </div>
	<?php } ?>
    </div>
    </div>
<?php //elseif(!empty($cat_testimonial) && is_category() && is_category($cat_testimonial)): ?>
<?php else: ?>
	<section class="blog-box">
		<div class="blog-info clearfix">
			<?php 
			if( has_post_thumbnail() ){
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
				$image_src = esc_url($image[0]);
			}else{
				$image_src = get_bloginfo('template_directory').'/images/no-thumb.png';
			}
			?>
			<div class="blog-left">
				<figure class="snap-edits"><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_src; ?>" alt="<?php the_title(); ?>"></a></figure>
			</div><!-- blog-left ends -->
			<?php //} ?>
			<div class="blog-details">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<p class="date">
					<?php echo get_the_date('l, j F, Y'); ?> | 
					Posted on
					<?php
						$categories = get_the_category();
						$separator = ', ';
						$output = '';
						if($categories){
							foreach($categories as $category) {
								$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
							}
						echo trim($output, $separator);
						}
					?> 
				</p>
				<p><?php echo ngoCharity_excerpt(get_the_content() , $ngoCharity_settings['post_char_length']? : 400 ); ?></p>
				<a href="<?php the_permalink(); ?>" class="readmore"><?php echo $ngoCharity_settings['post_readmore_text']? : 'Read More'; ?></a>
			</div><!-- details end -->
		</div><!-- blog-info ends -->
	</section><!-- blog-box ends -->
<?php endif; ?>

