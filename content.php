<?php 

/**
* @package NgoCharity
*/

global $ngoCharity_options;
$ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);

$cat_blog = $ngoCharity_settings['blog_cat'];
$cat_gallery = $ngoCharity_settings['gallery_cat'];
$cat_testimonial = $ngoCharity_settings['testimonial_cat'];
$cat_event = $ngoCharity_settings['event_cat'];


?>

<section class="blog-box">
	<div class="image">
		<a href="blog-detail.html"><img src="<?php bloginfo('template_directory'); ?>/images/resource/blog-pic-1.jpg" alt="pic"></a>
	</div>
	<div class="blog-info clearfix">
		<div class="blog-left">
			<figure class="snap"><img src="<?php bloginfo('template_directory'); ?>/images/resource/thumbs/snap-6.jpg" alt="snap"></figure>
			<a href="blog-detail.html">Dan Clark</a>
			<p><span class="text-yallow">Ngo</span>, Annual Funding, People</p>
		</div><!-- blog-left ends -->
		<div class="blog-details">
			<h4><a href="blog-detail.html">Integer tempor etiam sagittis phasellus, adipiscing scelerisque</a></h4>
			<p class="date">Wednesday, 14 Nov 2012</p>
			<p>Aenean et adipiscing mi. Aenean at sapien metus, porta tempor velit. Fusce sagittis laoreet felis id cursus. Aliquam aliquet ante a ante sagittis viverra. Ut id odio quis purus lacinia varius vitae eu purus. Integer ac elit at nisi ultrices condimentum  Aliquam porta volutpat quam id vehicula...</p>
			<a href="blog-detail.html" class="readmore">Read More</a>
		</div><!-- details end -->
	</div><!-- blog-info ends -->
</section><!-- blog-box ends -->