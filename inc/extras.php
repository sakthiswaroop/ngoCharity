<?php

/**
* Custom functions for Ngo Charity Theme
*@package NgoCharity
*/

function the_breadcrumb () {     
    // Settings
    $separator  = '&gt;';
    $id         = 'breadcrumb';
    $class      = 'breadcrumb';
    $home_title = 'Home';
     
    // Get the query & post information
    global $post,$wp_query;
    $category = get_the_category();
     
    // Build the breadcrumbs
    echo '<div class="bread-bar clearfix">';
    echo '<ul id="' . $id . '" class="' . $class . '">';
     
    // Do not display on the homepage
    if ( !is_front_page() ) {
         
        // Home page
        echo '<li class="item-home"><a href="'.get_home_url().'" title="'.$home_title.'">'.$home_title.'</a></li>';
         
        if ( is_single() ) {
             
            // Single post (Only display the first category)
            echo '<li class="item-cat item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><a href="'.get_category_link($category[0]->term_id ).'" title="'.$category[0]->cat_name.'">'.$category[0]->cat_name.'</a></li>';
            // echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
             
        } else if ( is_category() ) {
             
            // Category page
            echo '<li class="item-cat item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><a href="'.get_category_link($category[0]->term_id ).'" title="'.$category[0]->cat_name.'">'.$category[0]->cat_name.'</a></li>';
            // echo '<li class="item-current item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><strong class="bread-current bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '">' . $category[0]->cat_name . '</strong></li>';
             
        } else if ( is_page() ) {
             
            // Standard page
            if( $post->post_parent ){
                 
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                 
                // Get parents in the right order
                $anc = array_reverse($anc);
                 
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                 
                // Display parent pages
                echo $parents;
                 
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                 
            } else {
                 
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><a href="'.get_page_link().'">' . get_the_title() . '</a></li>';
                 
            }
             
        } else if ( is_tag() ) {
             
            // Tag page
             
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
             
            // Display the tag name
            echo '<li class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';
         
        } elseif ( is_day() ) {
             
            // Day archive
             
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . '</a></li>';
             
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . '</a></li>';
             
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><a class="bread-day bread-day-' . get_the_time('j') . '" href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('j') ) . '" title="' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . '</strong></a></li>';
             
        } else if ( is_month() ) {
             
            // Month Archive
             
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . '</a></li>';
             
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . '</a></li>';
             
        } else if ( is_year() ) {
             
            // Display year archive
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . '</a></li>';
             
        } else if ( is_author() ) {
             
            // Auhor archive
             
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
             
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><a href="'.$userdata->user_url.'" title="'.$userdata->display_name.'"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . $userdata->display_name . '</strong></a></li>';
         
        } else if ( get_query_var('paged') ) {
             
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
             
        } else if ( is_search() ) {
         
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><a href="'.get_search_link().'">Search</a></li>';
         
        } elseif ( is_404() ) {             
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
         
    }
     
    echo '</ul>';
    echo "</div>";
     
}

function ngoCharity_pagination_nav( $args = array() ) {
    
    $defaults = array(
        'range'           => 2,
        'custom_query'    => FALSE,
        'previous_string' => __( 'Prev', 'text-domain' ),
        'next_string'     => __( 'Next', 'text-domain' ),
        'before_output'   => '<div class="pagination"><ul>',
        'after_output'    => '</ul></div>'
    );
    
    $args = wp_parse_args( 
        $args, 
        apply_filters( 'ngoCharity_pagination_nav_defaults', $defaults )
    );
    
    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );
    
    if ( $count <= 1 )
        return FALSE;
    
    if ( !$page )
        $page = 1;
    
    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }
    
    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );
    
    $firstpage = esc_attr( get_pagenum_link(1) );
    if ( $firstpage && (1 != $page) )
        $echo .= '<li class="previous"><a href="' . $firstpage . '">' . __( 'First', 'text-domain' ) . '</a></li>';
    if ( $previous && (1 != $page) )
        $echo .= '<li><a href="' . $previous . '" title="' . __( 'previous', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';
    
    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
                $curPage = $page;
                $echo .= '<li class="active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
            } else {
                $echo .= sprintf( '<li><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }
    
    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page) )
        $echo .= '<li><a href="' . $next . '" title="' . __( 'next', 'text-domain') . '">' . $args['next_string'] . '</a></li>';
    
    $lastpage = esc_attr( get_pagenum_link($count) );
    if ( $lastpage ) {
        $echo .= '<li class="next"><a href="' . $lastpage . '">' . __( 'Last', 'text-domain' ) . '</a></li>';
    }
    $curPageInfo = '<span><strong>(Page '. $curPage.' of '. $count.')</strong></span>';
    if ( isset($echo) )
        echo $curPageInfo. $args['before_output'] . $echo . $args['after_output'];
}

function ngoCharity_excerpt( $ngoCharity_content , $ngoCharity_letter_count ){
	$ngoCharity_striped_content = strip_shortcodes($ngoCharity_content);
	$ngoCharity_striped_content = strip_tags($ngoCharity_striped_content);
	$ngoCharity_excerpt = mb_substr($ngoCharity_striped_content, 0, $ngoCharity_letter_count );
	if($ngoCharity_striped_content > $ngoCharity_excerpt){
		$ngoCharity_excerpt .= "...";
	}
	return $ngoCharity_excerpt;
}

/*
*Front page slider
*/
function ngoCharity_slider_cb()
{
    global $ngoCharity_options, $post;
    $ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);
    if($ngoCharity_settings['show_slider'] == 'yes')
    { 
        if($ngoCharity_settings['slider_options'] == 'single_post_slider')
        {
            if(!empty($ngoCharity_settings['slider1']) || !empty($ngoCharity_settings['slider2']) || !empty($ngoCharity_settings['slider3']))
            {
                $sliders = array($ngoCharity_settings['slider1'],$ngoCharity_settings['slider2'],$ngoCharity_settings['slider3']);
                $remove = array(0);
                $sliders = array_diff($sliders, $remove); ?>
                <div class="fullwidthbanner-container">
                    <div class="fullwidthbanner">
                        <ul>
                        <?php    
                        foreach ($sliders as $slider){
                            $args = array ('p' => $slider);
                            $loop = new WP_query( $args );
                            if($loop->have_posts())
                            { 
                                while($loop->have_posts()) : 
                                    $loop-> the_post();
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); 
                                    ?>
                                    <li data-transition="papercut" data-slotamount="15" data-masterspeed="2300" data-delay="9400">
                                        <img alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url($image[0]); ?>">
                                        <div class="caption large_yallow lfl stl"
                                            data-x="left"
                                            data-y="170"
                                            data-speed="500"
                                            data-start="500"
                                            data-easing="easeOutExpo"><?php echo $post->post_title; ?>
                                        </div>
                                    </li>
                            <?php endwhile;
                            }
                        }?>
                        </ul>
                    </div>
                </div><?php
            }
        }
        elseif($ngoCharity_settings['slider_options'] == 'cat_post_slider')
        {
        ?>
            <div class="fullwidthbanner-container">
                <div class="fullwidthbanner">
                    <ul>
                    <?php
                    $loop = new WP_Query(array(
                        'cat' => $ngoCharity_settings['slider_cat'],
                        'posts_per_page' => 3
                    ));
                    if($loop->have_posts()){ 
                        while($loop->have_posts()) : 
                            $loop-> the_post(); 
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); 
                            ?>
                            <li data-transition="papercut" data-slotamount="15" data-masterspeed="2300" data-delay="9400">
                                <img alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url($image[0]); ?>">
                                <div class="caption large_yallow lfl stl"
                                    data-x="left"
                                    data-y="170"
                                    data-speed="500"
                                    data-start="500"
                                    data-easing="easeOutExpo"><?php the_title(); ?>
                                </div>
                            </li><?php 
                        endwhile;
                    }
                    ?>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                var tpj=jQuery;
                tpj.noConflict();
                tpj(document).ready(function() {

                if (tpj.fn.cssOriginal!=undefined)
                    tpj.fn.css = tpj.fn.cssOriginal;

                    tpj('.fullwidthbanner').revolution(
                    {
                        delay:9000,
                        startwidth:1170,
                        startheight:550,

                        onHoverStop:"on",           // Stop Banner Timet at Hover on Slide on/off

                        thumbWidth:100,             // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                        thumbHeight:50,
                        thumbAmount:3,

                        hideThumbs:0,
                        navigationType:"none",        // bullet, thumb, none
                        navigationArrows:"solo",        // nexttobullets, solo (old name verticalcentered), none

                        navigationStyle:"round",        // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


                        navigationHAlign:"center",        // Vertical Align top,center,bottom
                        navigationVAlign:"top",         // Horizontal Align left,center,right
                        navigationHOffset:0,
                        navigationVOffset:20,

                        soloArrowLeftHalign:"left",
                        soloArrowLeftValign:"center",
                        soloArrowLeftHOffset:20,
                        soloArrowLeftVOffset:0,

                        soloArrowRightHalign:"right",
                        soloArrowRightValign:"center",
                        soloArrowRightHOffset:20,
                        soloArrowRightVOffset:0,

                        touchenabled:"on",            // Enable Swipe Function : on/off



                        stopAtSlide:-1,             // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                        stopAfterLoops:-1,            // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

                        hideCaptionAtLimit:0,         // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                        hideAllCaptionAtLilmit:0,       // Hide all The Captions if Width of Browser is less then this value
                        hideSliderAtLimit:0,          // Hide the whole slider, and stop also functions if Width of Browser is less than this value


                        fullWidth:"on",
                        shadow:0                //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

                    });
                });
            </script>
        <?php
        }
        else{

        }
    }
    wp_reset_query();
}
add_action('ngoCharity_slider','ngoCharity_slider_cb', 10);

/*
*Social Icons template
*/
function ngoCharity_social_links($area='')
{
    global $ngoCharity_options, $post;
    $ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);
    if($area=='header')
    {
        $show = $ngoCharity_settings['show_social_header'];
    }
    if($area=='footer')
    {
        $show = $ngoCharity_settings['show_social_footer'];
    }
    if(!$show)
    { ?>
    
    <?php if($area=='header') echo'<div class="tp-right">'; ?>

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
    <?php if($area=='header') echo'</div>'; ?>
    <?php  }
}

                
