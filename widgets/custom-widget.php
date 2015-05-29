<?php
/**
* Register widgets area and custom widgets
* @package NgoCharity
*/

/*
 * Register our sidebars and widgetized areas.
 *
 */
function ngoCharity_widgets_init() {

	// registering widget for footer
    register_sidebar( array(
        'name'          => 'Footer Widget',
        'id'            => 'widget_footer',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));

    // registering widget for right sidebar
    register_sidebar( array(
        'name'          => 'Right Sidebar Widget',
        'id'            => 'widget_right',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'ngoCharity_widgets_init' );



//Custom widgets for ngoCharity
add_action( 'widgets_init', 'ngoCharity_custom_widget' );

function ngoCharity_custom_widget() {
	//Custom widgets for event countdown
	register_widget( 'CustomPostWidget' );
}

/*
* Custom Recent Posts widget
*/
require get_template_directory() . '/widgets/custom-recent-post.php';