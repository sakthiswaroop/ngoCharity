<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php bloginfo('name'); ?><?php wp_title('::'); ?></title>
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property="fb:app_id" content="1664420240444578" />
    <?php wp_head(); ?>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1664420240444578";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php
    global $ngoCharity_options;
    $ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );
?>
    <div class="wrap">
        <div class="tp-bar">
            <div class="container">
                <div class="logo"> 
                    <a href="<?php bloginfo('url'); ?>">
                        <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" alt="logo">
                    </a> 
                    <span class="slogan"> <?php bloginfo('description'); ?> </span> 
                </div>
                <!-- logo ends -->
                <?php if(function_exists('ngoCharity_social_links')) ngoCharity_social_links('header'); ?>
            </div>
        </div><!-- tp-bar ends -->

        <nav class="menu-bar">
            <div class="container">
                <a href="#" class="tablet-menu"></a>
                <?php wp_nav_menu(array('container'=>'', 'menu_class'=>'menu', 'menu_id'=>'')) ?>
          
            <div class="user-controls">
                <a href="#" class="user-search"></a>
            </div>
            </div>
        </nav><!-- menu-bar ends -->

        <?php if( !(is_home() || is_front_page())  ): ?>
            <?php if(is_page() && has_post_thumbnail() ){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'featured-thumbnail', false );
                $url = esc_url($image[0]);
            }else{
                $url = get_bloginfo('template_directory').'/images/banner.jpg';
            } ?>
        <div class="banner" style="background:url(<?php echo $url; ?>);">
            <div class="container">
                <h1>
                    <?php
                        if ( is_category() ) :
                            single_cat_title();

                        elseif ( is_page() ) :
                            the_title();

                        elseif ( is_single() ) :
                            the_title();

                        elseif ( is_author() ) :
                            printf( __( 'Author <i>(%s)</i>', 'ngoCharity' ), '<span class="vcard">' . get_the_author() . '</span>' );

                        elseif ( is_search() ) :
                            echo "Search";

                        elseif ( is_tag() ) :
                            single_tag_title();

                        elseif ( is_day() ) :
                            printf( __( '%s', 'ngoCharity' ), '<span>' . get_the_date() . '</span>' );

                        elseif ( is_month() ) :
                            printf( __( '%s', 'ngoCharity' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ngoCharity' ) ) . '</span>' );

                        elseif ( is_year() ) :
                            printf( __( 'Year %s', 'ngoCharity' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ngoCharity' ) ) . '</span>' );

                        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                            _e( 'Asides', 'ngoCharity' );

                        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
                            _e( 'Galleries', 'ngoCharity');

                        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                            _e( 'Images', 'ngoCharity');

                        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                            _e( 'Videos', 'ngoCharity' );

                        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                            _e( 'Quotes', 'ngoCharity' );

                        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                            _e( 'Links', 'ngoCharity' );

                        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
                            _e( 'Statuses', 'ngoCharity' );

                        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
                            _e( 'Audios', 'ngoCharity' );

                        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
                            _e( 'Chats', 'ngoCharity' );

                        elseif ( is_404() ) :
                            _e( 'Page not found', 'ngoCharity' );

                        else :
                            _e( 'Archives', 'ngoCharity' );

                        endif;
                    ?>
                </h1>
                <?php if(function_exists('the_breadcrumb')) the_breadcrumb(); ?>
            </div>
        </div><!-- banner ends -->
        <?php endif; ?>

        <?php 
        if(is_home() || is_front_page() ){
            do_action( 'ngoCharity_slider' ); 
        }?>