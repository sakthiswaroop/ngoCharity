<?php
/*
Template Name: Contact Us Page
*/

get_header(); 
global $post, $ngoCharity_options;
$ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);

?>
    <?php if(trim($ngoCharity_settings['contactGoogleMap'] != null)){ ?>
    <div class="banner">
        <div class="location-map">
            <?php echo $ngoCharity_settings['contactGoogleMap'];  ?>
        </div><br>
    </div>
    <?php } ?>
    <div class="container">
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>
        </div>
    </div><!-- /container --> 
<?php get_footer(); ?>