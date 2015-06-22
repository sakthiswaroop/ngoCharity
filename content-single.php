<?php 

/**
* @package NgoCharity
*/

global $ngoCharity_options;
$ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);

$cat_gallery = $ngoCharity_settings['gallery_cat'];
$cat_event = $ngoCharity_settings['event_cat'];
?>

<?php if(in_category($cat_gallery)): 
    $gallery_url = get_post_meta( get_the_ID(), 'ngoCharity_gallery_url', true );
    $gallery_url_html = '<a href="%s" class="readmore">Go to Gallery</a>';
endif; ?>

<section class="blog-box">
    <div class="details">
        <?php if(in_category($cat_event)): ?>
            <?php /* commented for now ?>
        <div class="location-map">
            <iframe src="https://www.google.com/maps/embed/v1/search?q=<?php echo str_replace(' ', '+', get_post_meta( get_the_ID(), 'ngoCharity_event_venue', true )) ?>&amp;key=AIzaSyBOABJ5W5jscx9Qvpd3BSkCtOpH6gKNuqM"></iframe>
        </div><!-- location-map ends -->
            <?php */ ?>
        <?php else: ?>
        <?php 
            if( has_post_thumbnail() ){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumbnail', false ); 
        ?>
        <div class="image">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>"></a>
        </div>
        <?php } ?>
        <?php endif; ?>
        
        <h4><?php the_title(); ?></h4>
            <ul class="list">
                <?php if(in_category($cat_event)): ?>
                    <?php ngoCharity_event_post_meta();  ?>
                <?php else: ?>
                    <?php ngoCharity_post_meta(); ?>
                <?php endif; ?>                
            </ul>
        <h6>
        <p><?php the_content(); ?></p>
        <?php if(in_category($cat_gallery) && $gallery_url!= null):  
            printf( '<h4>%s</h4>', sprintf($gallery_url_html, $gallery_url) );
        endif; ?>
            
        <?php ngoCharity_posts_author(); ?>
    </div><!-- details end -->
</section><!-- blog-box ends -->
