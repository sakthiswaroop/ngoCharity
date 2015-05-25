<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package NgoCharity
 */

global $ngoCharity_options;
$ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);

if ( ! function_exists( 'ngoCharity_post_meta' ) ) :
/**
 * Prints HTML with meta information for the posted date and author info for posts
 */
function ngoCharity_post_meta() {
	$date_string = '<span><i class="icon-date"></i>%1$s</span>';
	$date_string = sprintf($date_string, esc_html(get_the_date()));

	$author_string = '<span><a href="%1$s"><i class="icon-user"></i>%2$s</a></span>';
	$author_string = sprintf($author_string, esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) );
	
	printf( __( '<li> %1$s</li> <li>%2$s</li>' ),
		$author_string, 
		$date_string
	);
}
endif;

if ( ! function_exists( 'ngoCharity_event_post_meta' ) ) :
/**
 * Prints HTML with meta information for the posted date and author info for event posts
 */
function ngoCharity_event_post_meta() {
	$event_date = get_post_meta( get_the_ID(), 'ngoCharity_event_date', true );
	$event_time = get_post_meta( get_the_ID(), 'ngoCharity_event_time', true ).' '. get_post_meta( get_the_ID(), 'ngoCharity_event_time_md', true );
	$event_venue = get_post_meta( get_the_ID(), 'ngoCharity_event_venue', true );

	$date_string = '<span><i class="icon-date"></i>%1$s</span>';
	$date_string = sprintf($date_string, esc_html($event_date));
	
	$time_string = '<span>%1$s</span>';
	$time_string = sprintf($time_string, esc_html($event_time));

	$venue_string = '<span><i class="icon-location"></i>%1$s</span>';
	$venue_string = sprintf($venue_string, esc_html($event_venue));

	printf( __( '<li> %1$s | %2$s</li> <li>%3$s</li>' ),
		$date_string, 
		$time_string,
		$venue_string
	);
}
endif;

if ( ! function_exists( 'ngoCharity_posts_author' ) ) :
/**
 * Prints HTML with meta information for the posted date and author info for event posts
 */
function ngoCharity_posts_author() {
	$image = '<figure class="snap"><img src="'.get_template_directory_uri().'/images/resource/thumbs/snap-3.jpg" alt="%1$s"></figure>';
	$authorName = get_the_author();
	$authorBio = get_the_author_meta('description');

	$image = sprintf($image, esc_html($authorName));


	printf( __( '<div class="author-box"><a href="%1$s">%2$s</a><div class="auth-details"><h4>Author - %3$s</h4><p>%4$s</p></div></div>' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		$image, 
		$authorName,
		$authorBio
	);
}
endif;