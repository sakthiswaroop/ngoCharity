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
        <div class="social-links">
          <ul>
            <li><a href="#" class="icon-yahoo tooltip" title="yahoo"></a></li>
            <li><a href="#" class="icon-facebook tooltip" title="facebook"></a></li>
            <li><a href="#" class="icon-rss tooltip" title="rss"></a></li>
            <li><a href="#" class="icon-flickr tooltip" title="flickr"></a></li>
            <li><a href="#" class="icon-msn tooltip" title="msn"></a></li>
            <li><a href="#" class="icon-stumbleupon tooltip" title="stumbleupon"></a></li>
          </ul>
        </div>
        <div class="tweets">
          <ul id="tweet">
            <li>Here are 10 quality, affordable Zen Cart Templates, perfect for a wide variety of eCommerce needs. <a href="#">http://enva.to/XiCf5F</a></li>
            <li>perfect for a wide variety of eCommerce needs. <a href="#">http://enva.to/XiCf5F</a></li>
            <li>affordable Zen Cart Templates, perfect for a wide variety of eCommerce needs</li>
          </ul>
        </div>
      </div>
    </div>
  </div><!-- tp-bar ends -->

  <nav class="menu-bar">
    <div class="container">
      <a href="#" class="tablet-menu"></a>
      <?php wp_nav_menu(array('container'=>'', 'menu_class'=>'menu', 'menu_id'=>'')) ?>
      <!-- <ul class="menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="events.html">Events</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li>
          <a href="gallery.html">Gallery</a>
          <ul>
            <li><a href="gallery-2col.html">two colum</a></li>
            <li><a href="gallery.html">three colum</a></li>
            <li><a href="gallery-4col.html">four colum</a></li>
          </ul>
        </li>
        <li><a href="contact.html">Contact Us</a></li>
        <li>
          <a href="#">Pages</a>
          <ul>
            <li>
              <a href="events.html">Events</a>
              <ul>
                <li><a href="events-detail.html">Event Detail</a></li>
              </ul>
            </li>
            <li>
              <a href="blog.html">Blog</a>
              <ul>
                <li><a href="blog-detail.html">Blog Detail</a></li>
              </ul>
            </li>
            <li>
              <a href="gallery.html">Gallery</a>
              <ul>
                <li><a href="gallery-2col.html">two colum</a></li>
                <li><a href="gallery.html">three colum</a></li>
                <li><a href="gallery-4col.html">four colum</a></li>
              </ul>
            </li>
            <li><a href="contact.html">Contact Us</a></li>
            <li>
              <a href="#">Cursus Tempor</a>
              <ul>
                <li><a href="#">Ultrices augue dolor</a></li>
                <li>
                  <a href="#">Etiam risus et</a>
                  <ul>
                    <li><a href="#">Etiam risus et</a></li>
                    <li><a href="#">Ultrices augue dolor</a></li>
                    <li><a href="#">Cursus Tempor</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
      </ul> --><!-- menu ends --> 
      <div class="user-controls">
        <a href="#" class="user-login"></a>
        <a href="#" class="user-search"></a>
      </div>
    </div>
  </nav><!-- menu-bar ends -->