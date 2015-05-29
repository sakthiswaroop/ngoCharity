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
            <?php if(function_exists('ngoCharity_social_links')) ngoCharity_social_links('footer'); ?>
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
