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

    //enable shortcode
    add_filter('widget_text', 'do_shortcode');
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

    // prettyphoto css
    wp_register_style( 'preetyPhoto-style', get_template_directory_uri() . '/css/prettyPhoto.css');
    wp_enqueue_style( 'preetyPhoto-style' );

}
add_action( 'wp_enqueue_scripts', 'ngo_charity_styles' );

/* add scripts for themes */
function ngo_charity_scripts()
{
    // jquery
    wp_register_script( 'jquery-script', get_template_directory_uri() . '/js/jquery-1.10.2.min.js', array(), null, false );
    wp_enqueue_script( 'jquery-script');
    
    // jquery ui
    wp_register_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js', array(), null, true );
    wp_enqueue_script( 'jquery-ui');

    // preetyPhoto
    wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), null, true );
    wp_enqueue_script( 'prettyPhoto');

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

/**
* Implement the Theme Option feature.
*/

require get_template_directory() . '/inc/admin-panel/theme-options.php';

/*
* Implementing custom meta box
*/
require get_template_directory() . '/inc/custom-metabox.php';

/*
* Custom functions for theme
*/
require get_template_directory() . '/inc/extras.php';

/*
* Custom template tags for this theme
*/
require get_template_directory() . '/inc/template-tags.php';

/*
* Custom widgets
*/
require get_template_directory() . '/widgets/custom-widget.php';
 
/*
* Custom Page builder tweaks
*/
require get_template_directory() . '/inc/page-builder.php';

/**
 *TGM Plugin activation.
 */
require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'ngoCharity_recommend_plugin' );
function ngoCharity_recommend_plugin() {
 
    $plugins = array(
        array(
            'name'               => 'Page Builder by SiteOrigin',
            'slug'               => 'siteorigin-panels',
            'required'           => true,
        ),
        array(
            'name'               => 'Newsletter - Manage your site subscriptions with ease',
            'slug'               => 'newsletter',
            'required'           => true,
        ),
        array(
            'name'               => 'Php code widget',
            'slug'               => 'php-code-widget',
            'required'           => true,
        ), 
        array(
            'name'               => 'Visual Editor - Black Studio Tiny Mice Widget',
            'slug'               => 'black-studio-tinymce-widget',
            'required'           => true,
        ),          
    );
    tgmpa( $plugins);
}
?>

