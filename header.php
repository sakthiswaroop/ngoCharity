<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php bloginfo('name'); ?> : <?php bloginfo('description'); ?></title>
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php wp_head(); ?>
</head>

<body>
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
                <div class="tp-right">
                    <?php
                        if(!$ngoCharity_settings['show_social_header'])
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
            </div>
        </div><!-- tp-bar ends -->

        <nav class="menu-bar">
            <div class="container">
                <a href="#" class="tablet-menu"></a>
                <?php wp_nav_menu(array('container'=>'', 'menu_class'=>'menu', 'menu_id'=>'')) ?>
          
            <div class="user-controls">
                <a href="#" class="user-login"></a>
                <a href="#" class="user-search"></a>
            </div>
            </div>
        </nav><!-- menu-bar ends -->

        <?php if(!is_home()): ?>
        <div class="banner" style="background:url(<?php bloginfo('template_directory'); ?>/images/resource/banner-1.jpg);">
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
                            printf( __( 'Day: %s', 'ngoCharity' ), '<span>' . get_the_date() . '</span>' );

                        elseif ( is_month() ) :
                            printf( __( 'Month: %s', 'ngoCharity' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ngoCharity' ) ) . '</span>' );

                        elseif ( is_year() ) :
                            printf( __( 'Year: %s', 'ngoCharity' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ngoCharity' ) ) . '</span>' );

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

                        else :
                            _e( 'Archives', 'ngoCharity' );

                        endif;
                    ?>
                </h1>
                <?php if(function_exists('the_breadcrumb')) the_breadcrumb(); ?>
            </div>
        </div><!-- banner ends -->
        <?php endif; ?>