<?php

/**
* Theme options page functions and definations
* @package NgoCharity
*/


if ( is_admin() ) : // Load only if we are viewing an admin page

function ngoCharity_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_script( 'ngo_custom_js', get_template_directory_uri().'/inc/admin-panel/js/custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'of-media-uploader', get_template_directory_uri().'/inc/admin-panel/js/media-uploader.js', array( 'jquery' ) );
	
	wp_enqueue_style( 'ngo_admin_style',get_template_directory_uri().'/inc/admin-panel/css/admin.css', '1.0', 'screen' );

}
add_action('admin_print_styles-appearance_page_theme_options', 'ngoCharity_admin_scripts');



$ngoCharity_options = array(
	'ngoCharity_favicon'=> '',
	'header_text'=>__('Call us : 984187523XX','ngoCharity'),
	// 'show_search'=> true,
	'post_readmore_text' => __('Read More','ngoCharity'),
	'post_char_length' => '400',
	
	'featured_post1' => '',
	'featured_post2' => '',
	'featured_post3' => '',
	'featured_event' => '',
	'show_event_number' => '3',
	
	'event_cat' => '',
	'testimonial_cat' => '',
	'gallery_cat' => '',
	'blog_cat'=>'',
	
	'footer_copyright' => get_bloginfo('name').' - All rights reserved',

	'slider_options' => 'single_post_slider',
    'slider_cat' => '',
    'show_slider' => 'yes',
	'slider1'=>'',
	'slider2'=>'',
	'slider3'=>'',
	
	'ngoCharity_facebook' => '',
	'ngoCharity_twitter' => '',
	'ngoCharity_gplus' => '',
	'ngoCharity_youtube' => '',
	// 'ngoCharity_pinterest' => '',
	'ngoCharity_linkedin' => '',
	// 'ngoCharity_flickr' => '',
	'ngoCharity_vimeo' => '',
	// 'ngoCharity_stumbleupon' => '',
	// 'ngoCharity_instagram' => '',
	// 'ngoCharity_sound_cloud' => '',
	// 'ngoCharity_skype' => '',
	'ngoCharity_rss' => '',
	// 'ngoCharity_tumblr' => '',
	// 'ngoCharity_myspace' =>'',
	'show_social_header'=>'',
	'show_social_footer'=>'',

	'contactEmai'=> '',
	'contactGoogleMap' => '',

	'notification_text'=>'',
	'show_notification' => 'yes',

);


add_action( 'admin_init', 'ngoCharity_register_settings' );
add_action( 'admin_menu', 'ngoCharity_theme_options' );

function ngoCharity_register_settings() {
	register_setting( 'ngoCharity_theme_options', 'ngoCharity_options', 'ngoCharity_validate_options' );
}

function ngoCharity_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( __( 'Theme Options', 'ngoCharity' ), __( 'Theme Options', 'ngoCharity' ), 'edit_theme_options', 'theme_options', 'ngoCharity_theme_options_page' );
}


// Store Posts in array
$ngoCharity_postlist[0] = array(
	'value' => 0,
	'label' =>  __('--choose--','ngoCharity')
);
$arg = array('posts_per_page'   => -1);
$ngoCharity_posts = get_posts($arg);
foreach( $ngoCharity_posts as $ngoCharity_post ) :
	$ngoCharity_postlist[$ngoCharity_post->ID] = array(
		'value' => $ngoCharity_post->ID,
		'label' => $ngoCharity_post->post_title
	);
endforeach;

// Store Pages in array
$ngoCharity_pagelist[0] = array(
	'value' => 0,
	'label' => __('--choose--','ngoCharity')
);
$arg = array('posts_per_page'   => -1);
$ngoCharity_pages = get_pages($arg);
foreach( $ngoCharity_pages as $ngoCharity_page ) :
	$ngoCharity_pagelist[$ngoCharity_page->ID] = array(
		'value' => $ngoCharity_page->ID,
		'label' => $ngoCharity_page->post_title
	);
endforeach;

$ngoCharity_pagelist1 = array();
foreach( $ngoCharity_pages as $ngoCharity_page ) :
	$ngoCharity_pagelist1[$ngoCharity_page->ID] = array(
		'value' => $ngoCharity_page->ID,
		'label' => $ngoCharity_page->post_title
	);
endforeach;


$ngoCharity_postpagelist = array_merge($ngoCharity_postlist, $ngoCharity_pagelist1);

// Store categories in array
$ngoCharity_catlist[0] = array(
	'value' => 0,
	'label' => __('--choose--','ngoCharity')
);
$arg1 = array(
	'hide_empty' => 0,
	'orderby' => 'name',
  	'parent' => 0,
  	);
$ngoCharity_cats = get_categories($arg1);

foreach( $ngoCharity_cats as $ngoCharity_cat ) :
	$ngoCharity_catlist[$ngoCharity_cat->cat_ID] = array(
		'value' => $ngoCharity_cat->cat_ID,
		'label' => $ngoCharity_cat->cat_name
	);
endforeach;
wp_reset_postdata();

// Store slider setting in array
$ngoCharity_slider = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __('show','ngoCharity')
	),
	'no' => array(
		'value' => 'no',
		'label' => __('hide','ngoCharity')
	),
);

// Store slider setting in array
$ngoCharity_notification = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __('show','ngoCharity')
	),
	'no' => array(
		'value' => 'no',
		'label' => __('hide','ngoCharity')
	),
);

// Function to generate options page
function ngoCharity_theme_options_page() {
	global $ngoCharity_options, $ngoCharity_postlist, $ngoCharity_postpagelist, $ngoCharity_slider, $ngoCharity_notification, $ngoCharity_catlist;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap" id="optionsframework-wrap">

		<div class="ngoCharity-header">
			<h3 class="ngoCharity_title">Advanced <?php _e( ' Theme Options', 'ngoCharity' );  echo " ("; bloginfo('name'); echo ")";?></h3>
		</div>
		<div class="clear"></div>

		<?php 	if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved' , 'ngoCharity' ); ?></strong></p></div>
		<?php endif; // If the form has just been submitted, this shows the notification ?>

		<?php // Shows all the tabs of the theme options ?>
		<div class="nav-tab-wrapper">
		<a id="options-group-1-tab" class="nav-tab nav-tab-active" href="#options-group-1"><?php _e('Basic Settings','ngoCharity'); ?></a>
		<a id="options-group-2-tab" class="nav-tab" href="#options-group-2"><?php _e('Slider Settings','ngoCharity'); ?></a>
		<a id="options-group-3-tab" class="nav-tab" href="#options-group-3"><?php _e('Social Links','ngoCharity'); ?></a>
		<a id="options-group-4-tab" class="nav-tab" href="#options-group-4"><?php _e('Contact Us','ngoCharity'); ?></a>
		<a id="options-group-5-tab" class="nav-tab" href="#options-group-5"><?php _e('Miscellaneous','ngoCharity'); ?></a>
		</div>

		<div id="optionsframework-metabox" class="metabox-holder clearfix">
			<div id="optionsframework" class="postbox">
				<form id="form_options" method="POST" action="options.php" enctype="multipart/form-data">

				<?php $settings = get_option( 'ngoCharity_options', $ngoCharity_options ); ?>
				
				<?php settings_fields( 'ngoCharity_theme_options' );
				/* This function outputs some hidden fields required by the form,
				including a nonce, a unique number used to ensure the form has been submitted from the admin page
				and not somewhere else, very important for security */ ?>

				<!-- Basic Settings -->
				<div id="options-group-1" class="group">
					<h3><?php _e('Basic Settings','ngoCharity'); ?></h3>
					<table class="form-table">
						<tr>
							<th><label for="ngoCharity_favicon"><?php _e('Upload Favicon','ngoCharity'); ?></label></th>
							<td>
								<div class="ngoCharity_fav_icon">
								  <input type="text" name="ngoCharity_options[media_upload]" id="ngoCharity_media_upload" value="<?php if(!empty($settings['media_upload'])){ echo esc_url($settings['media_upload']); }?>" />
								  <input class="button" name="media_upload_button" id="ngoCharity_media_upload_button" value="<?php _e('Upload','ngoCharity'); ?>" type="button" /><br />
								  <em class="f13"><?php _e('Upload favicon(.png) with size of 16px X 16px', 'ngoCharity'); ?></em>

								  <?php if(!empty($settings['media_upload'])){ ?>
								  <div id="ngoCharity_media_image">
								  <img src="<?php echo esc_url($settings['media_upload']) ?>" id="ngoCharity_show_image">
								  <div id="ngoCharity_fav_icon_remove"><?php _e('Remove','ngoCharity'); ?></div>
								  </div>
								  <?php }else{ ?>
								  <div id="ngoCharity_media_image" style="display:none">
								  <img src="<?php if(isset($settings['media_upload'])) { echo esc_url($settings['media_upload']); } ?>" id="ngoCharity_show_image">
								  <a href="javascript:void(0)" id="ngoCharity_fav_icon_remove" title="remove"><?php _e('Remove','ngoCharity'); ?></a>
								  </div>
								  <?php	} ?>
								</div>
							</td>
						</tr>

						<tr>
							<th><label for="upload_log"><?php _e('Upload Logo','ngoCharity'); ?></label></th>
							<td>
								<a class="button" target="_blank" href="<?php echo admin_url('/themes.php?page=custom-header'); ?>"><?php _e('Upload','ngoCharity'); ?></a>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="header_text"><?php _e('Header Text','ngoCharity'); ?></label></th>
							<td>
								<textarea id="header_text" name="ngoCharity_options[header_text]" rows="5" cols="30" placeholder="<?php _e('Example.. Call Us : 985XXX9856XX','ngoCharity')?>"><?php echo wp_kses_post($settings['header_text']); ?></textarea><br />
			                    <em class="f13"><?php _e('Html content allowed','ngoCharity'); ?></em> 
		                    </td>
	                    </tr>

	                    <tr>
							<th scope="row"><label for="post_readmore_text"><?php _e('Posts Read More Text','ngoCharity'); ?></label></th>
							<td>
								<input id="post_readmore_text" name="ngoCharity_options[post_readmore_text]" type="text" value="<?php esc_attr_e($settings['post_readmore_text']); ?>" />
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="post_char_length"><?php _e('Post Excerpt Length','ngoCharity'); ?></label></th>
							<td>
								<input id="post_char_length" name="ngoCharity_options[post_char_length]" type="text" value="<?php esc_attr_e($settings['post_char_length']); ?>" />
							</td>
						</tr>

						<tr><td colspan="2" class="seperator">&nbsp;</td></tr>

						<tr>
							<th scope="row"><label for="show_event_number"><?php _e('Events Displayed on Front Page','ngoCharity'); ?></label></th>
							<td>
								<input id="show_event_number" name="ngoCharity_options[show_event_number]" type="text" value="<?php esc_attr_e($settings['show_event_number']); ?>" />
							</td>
						</tr>
						
						<tr><td colspan="2" class="seperator">&nbsp;</td></tr>

						<tr><th scope="row"><label for="event_cat"><?php _e('Select the category to display as Events','ngoCharity'); ?></label></th>
							<td>
								<select id="event_cat" name="ngoCharity_options[event_cat]">
									<?php
									foreach ( $ngoCharity_catlist as $single_cat ) :
										$label = $single_cat['label']; ?>
										<option value="<?php esc_attr_e($single_cat['value']) ?>" <?php selected( $single_cat['value'], $settings['event_cat'] ); ?>><?php esc_attr_e($label); ?></option>
									<?php 
									endforeach;
									?>
								</select>
							</td>
						</tr>

						<tr><th scope="row"><label for="testimonial_cat"><?php _e('Select the category to display as Testimonials','ngoCharity'); ?></label></th>
							<td>
								<select id="testimonial_cat" name="ngoCharity_options[testimonial_cat]">
									<?php
									foreach ( $ngoCharity_catlist as $single_cat ) :
										$label = $single_cat['label']; ?>
										<option value="<?php esc_attr_e($single_cat['value']) ?>" <?php selected( $single_cat['value'], $settings['testimonial_cat'] ); ?>><?php esc_attr_e($label); ?></option>
									<?php 
									endforeach;
									?>
								</select>
							</td>
						</tr>

						<tr><th scope="row"><label for="gallery_cat"><?php _e('Select the category to display as Gallery','ngoCharity'); ?></label></th>
							<td>
								<select id="gallery_cat" name="ngoCharity_options[gallery_cat]">
									<?php
									foreach ( $ngoCharity_catlist as $single_cat ) :
										$label = $single_cat['label']; ?>
										<option value="<?php esc_attr_e($single_cat['value']) ?>" <?php selected( $single_cat['value'], $settings['gallery_cat'] ); ?>><?php esc_attr_e($label); ?></option>
									<?php 
									endforeach;
									?>
								</select>
							</td>
						</tr>

						<tr><th scope="row"><label for="blog_cat"><?php _e('Select the category to display as Blog','ngoCharity'); ?></label></th>
							<td>
								<select id="blog_cat" name="ngoCharity_options[blog_cat]">
									<?php
									foreach ( $ngoCharity_catlist as $single_cat ) :
										$label = $single_cat['label']; ?>
										<option value="<?php esc_attr_e($single_cat['value']) ?>" <?php selected( $single_cat['value'], $settings['blog_cat'] ); ?>><?php esc_attr_e($label); ?></option>
									<?php 
									endforeach;
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<em><?php _e('You can show these categories in the menu by configuring','ngoCharity'); ?> <a target="_blank" href="<?php echo admin_url('nav-menus.php'); ?>">Menus</a> <?php _e('Page.','ngoCharity'); ?></em>
							</td>
						</tr>

						<tr><td colspan="2" class="seperator">&nbsp;</td></tr>

						<tr>
							<th scope="row"><label for="footer_copyright"><?php _e('Footer Copyright Text','ngoCharity'); ?></label></th>
							<td>
								<textarea id="footer_copyright" name="ngoCharity_options[footer_copyright]" rows="5" cols="30" placeholder="<?php _e('All rights reserved.','ngoCharity')?>"><?php echo wp_kses_post($settings['footer_copyright']); ?></textarea><br />
			                    <em class="f13"><?php _e('Html content allowed','ngoCharity'); ?></em> 
		                    </td>
						</tr>
					</table>
				</div>
	           
				<!-- Slider Settings-->
				<div id="options-group-2" class="group" style="display: none;">
				<h3><?php _e('Slider Settings','ngoCharity'); ?></h3>
					<table class="form-table">
					<tbody>
						<tr class="slider-options">
							<th>
								<?php _e('Show','ngoCharity'); ?>
							</th>
							<td>
								<?php 
								if(!isset($settings['slider_options'])){
									$settings['slider_options']='single_post_slider';
								}
								?>
								<label class="checkbox" id="single_post_slider">
									<input value="single_post_slider" type="radio" name="ngoCharity_options[slider_options]" <?php checked($settings['slider_options'],'single_post_slider'); ?> ><?php _e('Single Posts as a Slider','ngoCharity'); ?>
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<label class="checkbox" id="cat_post_slider">
									<input value="cat_post_slider" name="ngoCharity_options[slider_options]" type="radio" <?php checked($settings['slider_options'],'cat_post_slider'); ?> ><?php _e('Category Posts as a Slider','ngoCharity'); ?>
								</label>
							</td>
						</tr>

						<tr><td colspan="2" class="seperator">&nbsp;</td></tr>
					</tbody>

					<tbody class="post-as-slider">
						<tr>
							<td colspan="2"><em class="f13"><?php _e('Select the post that you want to display as a Slider','ngoCharity'); ?></em></td>
						</tr>

						<tr>
						
							<th scope="row"><label for="slider1"><?php _e('Silder 1','ngoCharity'); ?></label></th>
							<td>
								<select id="slider1" name="ngoCharity_options[slider1]">
									<?php
									foreach ( $ngoCharity_postlist as $single_post ) :
										$label = $single_post['label']; ?>
										<option value="<?php esc_attr_e($single_post['value']); ?>" <?php selected($single_post['value'] , $settings['slider1'] ) ?>><?php esc_attr_e($label); ?></option>
									<?php
									endforeach;
									?>
								</select>
							</td>
						</tr>

						<tr><th scope="row"><label for="slider2"><?php _e('Silder 2','ngoCharity'); ?></label></th>
							<td>
								<select id="slider2" name="ngoCharity_options[slider2]">
									<?php
									foreach ( $ngoCharity_postlist as $single_post ) :
										$label = $single_post['label']; ?>
				                        <option value="<?php esc_attr_e($single_post['value']); ?>" <?php selected($single_post['value'] , $settings['slider2'] ) ?>><?php esc_attr_e($label); ?></option>
									<?php
									endforeach;
									?>
								</select>
							</td>
						</tr>

						<tr><th scope="row"><label for="slider3"><?php _e('Silder 3','ngoCharity'); ?></label></th>
							<td>
								<select id="slider3" name="ngoCharity_options[slider3]">
									<?php
									foreach ( $ngoCharity_postlist as $single_post ) :
										$label = $single_post['label']; ?>
										<option value="<?php esc_attr_e($single_post['value']); ?>" <?php selected($single_post['value'] , $settings['slider3'] ) ?>><?php esc_attr_e($label); ?></option>
									<?php
									endforeach;
									?>
								</select>
							</td>
						</tr>
						</tbody>

						<tbody class="cat-as-slider">
							<tr>
								<th><?php _e('Select the Category','ngoCharity'); ?></th>
								<td>
									<?php 
									if(!isset($settings['slider_cat'])){
										$settings['slider_cat']=0;
									}
									?>
									<select id="slider_cat" name="ngoCharity_options[slider_cat]">
										<?php
										foreach ( $ngoCharity_catlist as $single_cat ) :
											$label = $single_cat['label']; ?>
											<option value="<?php esc_attr_e($single_cat['value']) ?>" <?php selected( $single_cat['value'] , $settings['slider_cat'] )  ?>><?php esc_attr_e($label); ?></option>
										<?php
										endforeach;
										?>
									</select>
								</td>
							</tr>
						</tbody>
						
						<tbody>
							<tr><td colspan="2" class="seperator">&nbsp;</td></tr>
							
							<tr>
								<td colspan="2"><em class="f13"><?php _e('Adjust the slider as per your need.','ngoCharity'); ?></em></td>
							</tr>

							<tr><th scope="row"><?php _e('Show Slider','ngoCharity'); ?></th>
								<td>
									<?php foreach( $ngoCharity_slider as $slider ) : ?>
									<input type="radio" id="<?php esc_attr_e($slider['value']); ?>" name="ngoCharity_options[show_slider]" value="<?php esc_attr_e($slider['value']); ?>" <?php checked( $settings['show_slider'], $slider['value'] ); ?> />
									<label for="<?php esc_attr_e($slider['value']); ?>"><?php esc_attr_e($slider['label']); ?></label><br />
									<?php endforeach; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Social Settings-->
				<div id="options-group-3" class="group" style="display: none;">
				<h3><?php _e('Social links - Put your social url','ngoCharity'); ?></h3>
					<table class="form-table social-urls">
						<tr>
							<td colspan="2"><em class="f13"><?php _e('Put your social url below.. Leave blank if you don\'t want to show it.','ngoCharity'); ?></em></td>
						</tr>

						<tr>
							<th><label for="show_social_header"><?php _e('Disable Social icons in header?','ngoCharity'); ?></label></th>
							<td>
								<input type="checkbox" id="show_social_header" name="ngoCharity_options[show_social_header]" value="1" <?php checked( true, $settings['show_social_header'] ); ?> />
								<label for="show_social_header"><?php _e('Check to disable','ngoCharity'); ?></label>
							</td>
						</tr>

						<tr>
							<th><label for="show_social_footer"><?php _e('Disable Social icons in Footer?','ngoCharity'); ?></label></th>
							<td>
								<input type="checkbox" id="show_social_footer" name="ngoCharity_options[show_social_footer]" value="1" <?php checked( true, $settings['show_social_footer'] ); ?> />
								<label for="show_social_footer"><?php _e('Check to disable','ngoCharity'); ?></label>
							</td>
						</tr>

						<tr><th scope="row"><label for="ngoCharity_facebook">Facebook</label></th>
						<td>
						<input id="ngoCharity_facebook" name="ngoCharity_options[ngoCharity_facebook]" type="text" value="<?php echo esc_url($settings['ngoCharity_facebook']); ?>" />
						</td>
						</tr>

						<tr><th scope="row"><label for="ngoCharity_twitter">Twitter</label></th>
						<td>
						<input id="ngoCharity_twitter" name="ngoCharity_options[ngoCharity_twitter]" type="text" value="<?php echo esc_url($settings['ngoCharity_twitter']); ?>" />
						</td>
						</tr>

						<tr><th scope="row"><label for="ngoCharity_gplus">Google plus</label></th>
						<td>
						<input id="ngoCharity_gplus" name="ngoCharity_options[ngoCharity_gplus]" type="text" value="<?php echo esc_url($settings['ngoCharity_gplus']); ?>" />
						</td>
						</tr>

						<tr><th scope="row"><label for="ngoCharity_youtube">Youtube</label></th>
						<td>
						<input id="ngoCharity_youtube" name="ngoCharity_options[ngoCharity_youtube]" type="text" value="<?php echo esc_url($settings['ngoCharity_youtube']); ?>" />
						</td>
						</tr>

						<!-- <tr><th scope="row"><label for="ngoCharity_pinterest">Pinterest</label></th>
						<td>
						<input id="ngoCharity_pinterest" name="ngoCharity_options[ngoCharity_pinterest]" type="text" value="<?php echo esc_url($settings['ngoCharity_pinterest']); ?>" />
						</td>
						</tr> -->

						<tr><th scope="row"><label for="ngoCharity_linkedin">Linkedin</label></th>
						<td>
						<input id="ngoCharity_linkedin" name="ngoCharity_options[ngoCharity_linkedin]" type="text" value="<?php echo esc_url($settings['ngoCharity_linkedin']); ?>" />
						</td>
						</tr>

						<!-- <tr><th scope="row"><label for="ngoCharity_flickr">Flickr</label></th>
						<td>
						<input id="ngoCharity_flickr" name="ngoCharity_options[ngoCharity_flickr]" type="text" value="<?php echo esc_url($settings['ngoCharity_flickr']); ?>" />
						</td>
						</tr> -->

						<tr><th scope="row"><label for="ngoCharity_vimeo">Vimeo</label></th>
						<td>
						<input id="ngoCharity_vimeo" name="ngoCharity_options[ngoCharity_vimeo]" type="text" value="<?php echo esc_url($settings['ngoCharity_vimeo']); ?>" />
						</td>
						</tr>

						<!-- <tr><th scope="row"><label for="ngoCharity_stumbleupon">Stumbleupon</label></th>
						<td>
						<input id="ngoCharity_stumbleupon" name="ngoCharity_options[ngoCharity_stumbleupon]" type="text" value="<?php echo esc_url($settings['ngoCharity_stumbleupon']); ?>" />
						</td>
						</tr> -->

						<!-- <tr><th scope="row"><label for="ngoCharity_instagram">Instagram</label></th>
						<td>
						<input id="ngoCharity_instagram" name="ngoCharity_options[ngoCharity_instagram]" type="text" value="<?php if(isset($settings['ngoCharity_instagram'])) { echo esc_url($settings['ngoCharity_instagram']); } ?>" />
						</td>
						</tr>

						<tr><th scope="row"><label for="ngoCharity_sound_cloud">Sound Cloud</label></th>
						<td>
						<input id="ngoCharity_sound_cloud" name="ngoCharity_options[ngoCharity_sound_cloud]" type="text" value="<?php if(isset($settings['ngoCharity_sound_cloud'])) { echo esc_url($settings['ngoCharity_sound_cloud']); } ?>" />
						</td>
						</tr> -->

						<!-- <tr><th scope="row"><label for="ngoCharity_skype">Skype</label></th>
						<td>
						<input id="ngoCharity_skype" name="ngoCharity_options[ngoCharity_skype]" type="text" value="<?php esc_attr_e($settings['ngoCharity_skype']); ?>" />
						</td>
						</tr>

						<tr><th scope="row"><label for="ngoCharity_skype">Tumblr</label></th>
						<td>
						<input id="ngoCharity_tumblr" name="ngoCharity_options[ngoCharity_tumblr]" type="text" value="<?php esc_attr_e($settings['ngoCharity_tumblr']); ?>" />
						</td>
						</tr>

						<tr><th scope="row"><label for="ngoCharity_skype">Myspace</label></th>
						<td>
						<input id="ngoCharity_myspace" name="ngoCharity_options[ngoCharity_myspace]" type="text" value="<?php esc_attr_e($settings['ngoCharity_myspace']); ?>" />
						</td>
						</tr> -->

						<tr><th scope="row"><label for="ngoCharity_rss">RSS</label></th>
						<td>
						<input id="ngoCharity_rss" name="ngoCharity_options[ngoCharity_rss]" type="text" value="<?php echo esc_url($settings['ngoCharity_rss']); ?>" />
						</td>
						</tr>
					</table>
				</div>

				<!-- Contacts Email Server-->
				<div id="options-group-4" class="group" style="display: none;">
				<h3><?php _e('Configuration for Contact Us Page','ngoCharity'); ?></h3>
					<table class="form-table">
						<tr>
							<th scope="row"><label for="google_map_iframe"><?php _e('Google Map Iframe','ngoCharity'); ?></label></th>
							<td>
								<textarea id="google_map_iframe" name="ngoCharity_options[contactGoogleMap]" rows="5" cols="30" placeholder="<?php _e('Copy and paste google map ifrmae embed code','ngoCharity')?>"><?php echo wp_kses_post($settings['contactGoogleMap']); ?></textarea><br />
			                    <em class="f13"><?php _e('Leave blank if you don\'t want to show. ','ngoCharity'); ?></em> 
		                    </td>
	                    </tr>
	                    <tr>
	                    	<th scope="row"><label for="ngoCharity_contactEmail">Contact Email Address</label></th>
							<td>
								<input id="ngoCharity_contactEmail" name="ngoCharity_options[contactEmail]" type="email" value="<?php echo esc_url($settings['contactEmail']); ?>" />
							</td>
	                    </tr>
					</table>
				</div>

				<!-- Miscellaneous-->
				<div id="options-group-5" class="group" style="display: none;">
				<h3><?php _e('Miscellaneous Settings for your theme','ngoCharity'); ?></h3>
					<table class="form-table">
						<tr>
							<th scope="row"><label for="notification_text"><?php _e('Notification Text','ngoCharity'); ?></label></th>
							<td>
								<textarea id="notification_text" name="ngoCharity_options[notification_text]" rows="5" cols="30" placeholder="<?php _e('Important notification alert on home page','ngoCharity')?>"><?php echo wp_kses_post($settings['notification_text']); ?></textarea><br />
			                    <em class="f13"><?php _e('Html content allowed','ngoCharity'); ?></em> 
		                    </td>
	                    </tr>
	                    <tr><th scope="row"><?php _e('Show Notification','ngoCharity'); ?></th>
								<td>
									<?php foreach( $ngoCharity_notification as $notification ) : ?>
									<input type="radio" id="<?php esc_attr_e($notification['value']); ?>" name="ngoCharity_options[show_notification]" value="<?php esc_attr_e($notification['value']); ?>" <?php checked( $settings['show_notification'], $notification['value'] ); ?> />
									<label for="<?php esc_attr_e($notification['value']); ?>"><?php esc_attr_e($notification['label']); ?></label><br />
									<?php endforeach; ?>
								</td>
							</tr>
					</table>
				</div>

				<div id="optionsframework-submit">
				<input type="submit" class="button-primary" value="<?php esc_attr_e('Save Options','ngoCharity'); ?>" />
				</div>

				</form>
			</div><!-- #optionsframework -->
		</div><!-- #optionsframework-metabox -->
	</div>

	<?php
}


function ngoCharity_validate_options( $input ) {
	global $ngoCharity_options, $ngoCharity_postlist, $ngoCharity_slider;

	$settings = get_option( 'ngoCharity_options', $ngoCharity_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties.
    $input['slider_options'] = wp_filter_nohtml_kses( $input['slider_options'] );
    $input['featured_post1'] = wp_filter_nohtml_kses( $input['featured_post1'] );
    $input['featured_post2'] = wp_filter_nohtml_kses( $input['featured_post2'] );
    $input['featured_post3'] = wp_filter_nohtml_kses( $input['featured_post3'] );
    $input['event_cat'] = wp_filter_nohtml_kses( $input['event_cat'] );
    $input['testimonial_cat'] = wp_filter_nohtml_kses( $input['testimonial_cat'] );
    $input['gallery_cat'] = wp_filter_nohtml_kses( $input['gallery_cat'] );
    $input['blog_cat'] = wp_filter_nohtml_kses( $input['blog_cat'] );
    $input['slider_cat'] = wp_filter_nohtml_kses( $input['slider_cat'] );
    // $input['footer_copyright'] = sanitize_text_field( $input['footer_copyright'] );
    $input['post_readmore_text'] = sanitize_text_field( $input['post_readmore_text'] );

    $input['notification_text'] = sanitize_text_field( $input['notification_text'] );
    $input['contactGoogleMap'] = sanitize_text_field( $input['contactGoogleMap'] );
    $input['contactEmail'] = sanitize_email( $input['contactEmail'] );


    // We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['featured_post1'];
	// We verify if the given value exists in the layouts array	
	
	$prev = $settings['show_slider'];
	if ( !array_key_exists( $input['show_slider'], $ngoCharity_slider ) )
		$input['show_slider'] = $prev;

	$prev = $settings['show_notification'];
	if ( !array_key_exists( $input['show_notification'], $ngoCharity_slider ) )
		$input['show_notification'] = $prev;

    if (!isset( $input['post_char_length'] ) || empty( $input['post_char_length'] ) ){
        $input['post_char_length']= "650";
    }else{
    	if(intval($input['post_char_length'])){
            $input['post_char_length'] = absint($input['post_char_length']);
        }
    }

    if (!isset( $input['show_event_number'] ) || empty( $input['show_event_number'] )){
       	$input['show_event_number']= "3";
    }else{
    	 if(intval($input['show_event_number'])){
            $input['show_event_number'] = absint($input['show_event_number']);
        }
    }

	if ( ! isset( $input['show_social_header'] ) )
		$input['show_social_header'] = null;
	$input['show_social_header'] = ( $input['show_social_header'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_social_footer'] ) )
		$input['show_social_footer'] = null;
	$input['show_social_footer'] = ( $input['show_social_footer'] == 1 ? 1 : 0 );

	
	 // data validation for Social Icons
	if( isset( $input[ 'ngoCharity_facebook' ] ) ) {
		$input[ 'ngoCharity_facebook' ] = esc_url_raw( $input[ 'ngoCharity_facebook' ] );
	};
	if( isset( $input[ 'ngoCharity_twitter' ] ) ) {
		$input[ 'ngoCharity_twitter' ] = esc_url_raw( $input[ 'ngoCharity_twitter' ] );
	};
	if( isset( $input[ 'ngoCharity_gplus' ] ) ) {
		$input[ 'ngoCharity_gplus' ] = esc_url_raw( $input[ 'ngoCharity_gplus' ] );
	};
	if( isset( $input[ 'ngoCharity_youtube' ] ) ) {
		$input[ 'ngoCharity_youtube' ] = esc_url_raw( $input[ 'ngoCharity_youtube' ] );
	};
	// if( isset( $input[ 'ngoCharity_pinterest' ] ) ) {
	// 	$input[ 'ngoCharity_pinterest' ] = esc_url_raw( $input[ 'ngoCharity_pinterest' ] );
	// };
	if( isset( $input[ 'ngoCharity_linkedin' ] ) ) {
		$input[ 'ngoCharity_linkedin' ] = esc_url_raw( $input[ 'ngoCharity_linkedin' ] );
	};
	// if( isset( $input[ 'ngoCharity_flickr' ] ) ) {
	// 	$input[ 'ngoCharity_flickr' ] = esc_url_raw( $input[ 'ngoCharity_flickr' ] );
	// };
	if( isset( $input[ 'ngoCharity_vimeo' ] ) ) {
		$input[ 'ngoCharity_vimeo' ] = esc_url_raw( $input[ 'ngoCharity_vimeo' ] );
	};
	// if( isset( $input[ 'ngoCharity_stumbleupon' ] ) ) {
	// 	$input[ 'ngoCharity_stumbleupon' ] = esc_url_raw( $input[ 'ngoCharity_stumbleupon' ] );
	// };
	// if( isset( $input[ 'ngoCharity_instagram' ] ) ) {
	// 	$input[ 'ngoCharity_instagram' ] = esc_url_raw( $input[ 'ngoCharity_instagram' ] );
	// };
	// if( isset( $input[ 'ngoCharity_sound_cloud' ] ) ) {
	// 	$input[ 'ngoCharity_sound_cloud' ] = esc_url_raw( $input[ 'ngoCharity_sound_cloud' ] );
	// };
	// if( isset( $input[ 'ngoCharity_skype' ] ) ) {
	// 	$input[ 'ngoCharity_skype' ] = esc_attr( $input[ 'ngoCharity_skype' ] );
	// };
	// if( isset( $input[ 'ngoCharity_tumblr' ] ) ) {
	// 	$input[ 'ngoCharity_tumblr' ] = esc_url_raw( $input[ 'ngoCharity_tumblr' ] );
	// };
	// if( isset( $input[ 'ngoCharity_myspace' ] ) ) {
	// 	$input[ 'ngoCharity_myspace' ] = esc_url_raw( $input[ 'ngoCharity_myspace' ] );
	// };
	if( isset( $input[ 'ngoCharity_rss' ] ) ) {
		$input[ 'ngoCharity_rss' ] = esc_url_raw( $input[ 'ngoCharity_rss' ] );
	};

    if( isset( $input[ 'header_text' ] ) ) {
	   $input[ 'header_text' ] = wp_kses_post( $input[ 'header_text' ] );
    }
    if( isset( $input[ 'footer_copyright' ] ) ) {
	   $input[ 'footer_copyright' ] = wp_kses_post( $input[ 'footer_copyright' ] );
    }
    
	return $input;
}

endif;  // EndIf is_admin()
?>
