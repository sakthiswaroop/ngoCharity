<?php
/**
 * 404 error Template
 * @package NgoCharity
 */

get_header();
?>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="not-found">                
                <img src="<?php echo get_bloginfo('template_directory').'/images/404.png'; ?>" align="middle">

                <p>It may be temporarily unavailable, moved or no longer exist.</p>
                <p>Check the URL you entered for any mistakes and try again.
                Alternatively, search for whatever is missing or take a look around
                the rest of our site.</p>
            </div>
        </div>
    </div>
</div><!-- /container --> 

<?php get_footer(); ?>