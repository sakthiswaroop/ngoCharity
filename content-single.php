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


























<?php /* ?>
    <section class="blog-box">
          <div class="details">
            <div class="image">
            <a href="blog-detail.html"><img src="images/resource/blog-pic-1.jpg" alt="pic"></a>
          </div>
            <h4>Integer tempor etiam sagittis phasellus, adipiscing scelerisque</h4>
            <ul class="list">
              <li><span><a href="#"><i class="icon-user"></i>Dan Clark</a></span></li>
              <li><span><i class="icon-date"></i>25 - 02 - 2013</span></li>
              <li><span><i class="icon-list"></i>Ngo, Annual Funding, People</span></li>
            </ul>
            <h6>
              <a href="blog-detail.html">Aenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagittis laoreet felis id cursus. Aliquam aliquet ante a ante sagittis viverra. Ut id odio quis purus lacinia varius vitae eu purus. Integer ac elit at nisi ultrices condimentum.</a>
            </h6>
            <p>Aenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagittis laoreet felis id cursus. Aliquam aliquet ante a ante sagittis viverra. Ut id odio quis purus lacinia varius vitae eu purus. Integer ac elit at nisi ultrices condimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus arta tempor velit.</p>
            <p>Aenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagittis laoreet felis id cursus. Aliquam aliquet ante a ante sagittis viverra. Ut id odio quis purus lacinia varius vitae eu purus. Integer ac elit at nisi ultrices conteger ac elit at nisi ultrices condimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus accumsan arcu nec convallis. ndimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus accumsan arcu nec convallis. Aliquam porta volutpat quam id vehicAenean et adipiscing mi. tellus tincidunAenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagnteger ac elit at nisi ultrices condimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus accumsan arcu nec convallis. ittis laoreet felis id cursus.</p>
            <blockquote>
              <h3>Blockquote</h3>
              <p>Aenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagittis laoreet felis id cursus. Aliquam aliquet ante a ante sagittis viverra. Ut id odio quis purus lacinia varius vitae eu purus. Integer ac elit at nisi ultrices condimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus arta tempor velit.</p>
            </blockquote>
            <p>Aenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagittis laoreet felis id cursus. Aliquam aliquet ante a ante sagittis viverra. Ut id odio quis purus lacinia varius vitae eu purus. Integer ac elit at nisi ultrices conteger ac elit at nisi ultrices condimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus accumsan arcu nec convallis. ndimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus accumsan arcu nec convallis. Aliquam porta volutpat quam id vehicAenean et adipiscing mi. tellus tincidunAenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagnteger ac elit at nisi ultrices condimentum. Integer malesuada leo eu mi cursus vel sagittis tellus tincidunt. Quisque cursus accumsan arcu nec convallis. ittis laoreet felis id cursus.</p>
            <div class="author-box">
              <figure class="snap"><img src="images/resource/thumbs/snap-3.jpg" alt="author"></figure>
              <div class="auth-details">
                <h4>Author - Craig Bryant</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget neque non dolor semper egestas. Fusce ullamcorper, dolor eleifend egestas luctus, velit ligula ultricies risus, vitae adipiscing magna neque vitae risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
              </div>
            </div><!-- author-box ends -->
          </div><!-- details end -->
        </section><!-- blog-box ends -->
<?php */ ?>