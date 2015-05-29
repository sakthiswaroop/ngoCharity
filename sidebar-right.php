<!-- Custom code for featured event -->
<?php 
    global $ngoCharity_options;
    $ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );
    $cat_event = $ngoCharity_settings['event_cat'];
    query_posts('posts_per_page=1&meta_key=ngoCharity_event_featured&meta_value=1&order=DESC&cat='.$cat_event);
    if ( have_posts() ) : 
    ?>
    <div class="events">
        <h2>Upcoming Event</h2>
        <?php while ( have_posts() ) : the_post();
            $event_datetime = get_post_meta( get_the_ID(), 'ngoCharity_event_datetime', true );
            $dt = str_replace(array(' ', '|'), '', $event_datetime);
            
            date_default_timezone_set('Asia/Kathmandu');
            $datetime = new DateTime($dt);
            $ddt = $datetime->getTimestamp();
        ?>
            <div class="event-countdown">
                <h3><?php the_title(); ?></h3>
                <div class="counter">
                    <div class="count-down"></div>
                </div>
                <p><?php echo ngoCharity_excerpt(get_the_content() , 100); ?></p>
                <ul class="list"><?php ngoCharity_event_post_meta(); ?></ul>
            </div><!-- event-countdown ends -->
        <?php endwhile;
        ?>
    </div><!-- events-->
    <?php 
    endif;
    wp_reset_query();   
?>


<script type="text/javascript">
    jQuery(document).ready(function(e) {
        "use strict";
        var counter = "<?php echo $ddt; ?>";

        if (e(".count-down").length !== 0) {
            e(".count-down").countdown({
                // timestamp: (new Date).getTime() + 10 * 24 * 60 * 60 * 1e3
                timestamp:  counter * 1e3
            })
        }
    })
</script>

<!-- dynamic widget based on  widget bar -->

<?php if ( is_active_sidebar( 'widget_right' ) ) : ?>
  <?php dynamic_sidebar( 'widget_right' ); ?>
<?php endif; ?>