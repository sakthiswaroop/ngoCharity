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
	$event_datetime = get_post_meta( get_the_ID(), 'ngoCharity_event_datetime', true );
	$event_venue = get_post_meta( get_the_ID(), 'ngoCharity_event_venue', true );

	$date_string = '<span><i class="icon-date"></i>%1$s</span><span><em>(Nepal Standard Time)</em></span>';
	$date_string = sprintf($date_string, esc_html($event_datetime));

	$venue_string = '<span><i class="icon-location"></i>%1$s</span>';
	$venue_string = sprintf($venue_string, esc_html($event_venue));

	printf( __( '<li> %1$s</li> <li>%2$s</li>' ),
		$date_string,
		$venue_string
	);
}
endif;

if ( ! function_exists( 'ngoCharity_posts_author' ) ) :
/**
 * Prints HTML with meta information for the posted date and author info for event posts
 */
function ngoCharity_posts_author() {
	$image = '<figure class="snap">%1$s</figure>';
	$authorName = get_the_author();
	$authorBio = get_the_author_meta('description');

	$image = sprintf($image, get_avatar(get_the_author_meta('ID')));


	printf( __( '<div class="author-box"><a href="%1$s">%2$s</a><div class="auth-details"><h4>Author - %3$s</h4><p>%4$s</p></div></div>' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		$image, 
		$authorName,
		$authorBio
	);
}
endif;


if ( ! function_exists( 'ngoCharity_user_comment_box' ) ) :
/**
 * Layout for user comments
 */
function ngoCharity_user_comment_box($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$gravatar = '<figure class="snap">%1$s</figure>';
	$comment_meta = '<strong>%1$s</strong><p>%2$s</p>';
	$reply_link = '<a href="%s" class="reply-link">Reply</a>';


	printf( '<li id="comment-%5$s"><div class="comment-box">%1$s<div class="comment-tp">%2$s</div><p>%3$s</p>%4$s</div></li>' ,
			sprintf($gravatar, get_avatar( $comment)),
			sprintf($comment_meta, esc_attr( get_comment_author() ) , esc_attr(get_comment_date()) ),
			esc_html(get_comment_text()),
			sprintf($reply_link, esc_url( get_comment_link( $comment->comment_ID )) ),
			$comment->comment_ID
		);
}
endif;