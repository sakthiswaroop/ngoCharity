<?php

/**
 * NGO functions and definitions
 *
 * @package WordPress
 * @subpackage Ngo_Charity
 */

/*intial setup of ngo charity*/
function ngoCharity_setup() 
{
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    /*
     * This theme supports all available post formats by default.
     * See https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'standard', 'gallery', 'video'
    ) );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Navigation Menu', 'ngoCharity' ) );

    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 604, 270, true );

    // This theme uses its own gallery styles.
    // add_filter( 'use_default_gallery_style', '__return_false' );

    //add custome header image
    $imageArgs = array(
        'height'        => 43,
        'uploads'       => true,
        'default-image' => get_template_directory_uri() . '/images/logo.png',
    );
    add_theme_support( 'custom-header', $imageArgs );
}
add_action( 'after_setup_theme', 'ngoCharity_setup' );

/* add styles css for theme */
function ngo_charity_styles()
{
    //font style
    wp_register_style( 'font-style', get_template_directory_uri() . '/css/fonts.css?family=Droid+Sans:400,700');
    wp_enqueue_style( 'font-style' );

    // common css
    wp_register_style( 'common-style', get_template_directory_uri() . '/css/common.css');
    wp_enqueue_style( 'common-style' );

    // style css
    wp_register_style( 'custom-style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style( 'custom-style' );

    // camera css
    wp_register_style( 'camera-style', get_template_directory_uri() . '/css/camera.css');
    wp_enqueue_style( 'camera-style' );

    // slider css
    wp_register_style( 'slider-style', get_template_directory_uri() . '/css/slider.css');
    wp_enqueue_style( 'slider-style' );

    // responsive css
    wp_register_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style( 'responsive-style' );

}
add_action( 'wp_enqueue_scripts', 'ngo_charity_styles' );

/* add scripts for themes */
function ngo_charity_scripts()
{
    // jquery
    wp_register_script( 'jquery-script', get_template_directory_uri() . '/js/jquery-1.10.2.min.js', array(), null, true );
    wp_enqueue_script( 'jquery-script');

    // jquery ui
    wp_register_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js', array(), null, true );
    wp_enqueue_script( 'jquery-ui');

    // jquery countdown
    wp_register_script( 'jquery-countdown', get_template_directory_uri() . '/js/jquery.countdown.js', array(), null, true );
    wp_enqueue_script( 'jquery-countdown');

    // jquery bxslider
    wp_register_script( 'jquery-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', array(), null, true );
    wp_enqueue_script( 'jquery-bxslider');

    // custom script
    wp_register_script( 'custom-script', get_template_directory_uri() . '/js/script.js', array(), null, true );
    wp_enqueue_script( 'custom-script');

    // jquery rev slider
    wp_register_script( 'jquery-rev-slider', get_template_directory_uri() . '/js/jquery.themepunch.revolution.min.js', array(), null, true );
    wp_enqueue_script( 'jquery-rev-slider');
}
add_action( 'wp_enqueue_scripts', 'ngo_charity_scripts' );

/** adding menu on wp dashboard settings */
// add_action( 'admin_menu', 'custom_menu' );

// function custom_menu() {
//     add_options_page( 'Options', 'Theme Settings', 'manage_options', 'my-unique-identifier', 'options_menu' );
// }

// /** Step 3. */
// function options_menu() {
//     if ( !current_user_can( 'manage_options' ) )  {
//         wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
//     }
//     echo '<div class="wrap">';
//     echo '<p>Here is where the form would go if I actually had options.</p>';
//     echo '</div>';
// }

/**
 * Implement the Theme Option feature. currently disabled
 */
// require get_template_directory() . '/inc/admin-panel1/theme-settings.php';

require get_template_directory() . '/inc/admin-panel/theme-options.php';

/*
* Implementing custom meta box
*/
require get_template_directory() . '/inc/custom-metabox.php';



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
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                 
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
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
             
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
             
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
             
        } else if ( is_month() ) {
             
            // Month Archive
             
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
             
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
             
        } else if ( is_year() ) {
             
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
             
        } else if ( is_author() ) {
             
            // Auhor archive
             
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
             
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
         
        } else if ( get_query_var('paged') ) {
             
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
             
        } else if ( is_search() ) {
         
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
         
        } elseif ( is_404() ) {
             
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
         
    }
     
    echo '</ul>';
    echo "</div>";
     
}
 
?>

