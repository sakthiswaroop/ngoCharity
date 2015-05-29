<?php
    global $ngoCharity_options;
    $ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );
?>

    <?php get_sidebar('footer'); ?>

    <div class="bottom">
        <div class="container">
            <div class="bottom-left">
                <p>&copy;2013 <?php echo $ngoCharity_settings['footer_copyright']; ?></p>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Environment</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="#">Site Map</a></li>
                </ul>
            </div>
            <?php
                if(!$ngoCharity_settings['show_social_footer'])
                { ?>
                <div class="social-links">
                    <ul>
                        <?php if($ngoCharity_settings['ngoCharity_facebook']) { ?>
                        <li><a href="<?php echo $ngoCharity_settings['ngoCharity_facebook']; ?>" class="social-icon-facebook tooltip" title="facebook"></a></li>
                        <?php } ?>
                        <?php if($ngoCharity_settings['ngoCharity_twitter']) { ?>
                        <li><a href="<?php echo $ngoCharity_settings['ngoCharity_twitter']; ?>" class="social-icon-twitter tooltip" title="twitter"></a></li>
                        <?php } ?>
                        <?php if($ngoCharity_settings['ngoCharity_gplus']) { ?>
                        <li><a href="<?php echo $ngoCharity_settings['ngoCharity_gplus']; ?>" class="social-icon-gplus tooltip" title="gplus"></a></li>
                        <?php } ?>
                        <?php if($ngoCharity_settings['ngoCharity_youtube']) { ?>
                        <li><a href="<?php echo $ngoCharity_settings['ngoCharity_youtube']; ?>" class="social-icon-youtube tooltip" title="youtube"></a></li>
                        <?php } ?>
                        <?php if($ngoCharity_settings['ngoCharity_linkedin']) { ?>
                        <li><a href="<?php echo $ngoCharity_settings['ngoCharity_linkedin']; ?>" class="social-icon-linkedin tooltip" title="linkedin"></a></li>
                        <?php } ?>
                        <?php if($ngoCharity_settings['ngoCharity_rss']) { ?>
                        <li><a href="<?php echo $ngoCharity_settings['ngoCharity_rss']; ?>" class="social-icon-rss tooltip" title="rss"></a></li>
                        <?php } ?>
                        <?php if($ngoCharity_settings['ngoCharity_vimeo']) { ?>
                        <li><a href="<?php echo $ngoCharity_settings['ngoCharity_vimeo']; ?>" class="social-icon-vimeo tooltip" title="vimeo"></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php  }
            ?>
        </div>
    </div><!-- bottom ends -->
</div><!-- wrap ends -->

<div id="dialog-search">
    <div class="heading">Search</div>
    <div class="dialog-block">
        <form method="get" action="<?php bloginfo('url'); ?>/" class="user-search-form">
            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="input-block-level" placeholder="Enter Any Keyword">
            <input type="submit" class="btn" value="Search">
        </form>
    </div>
    <!-- dialog-block ends --> 
</div><!-- dialog ends -->
<div class="dialog-overlay"></div>
<?php wp_footer(); ?>
</body>
</html>
