<?php
/**
 * Plugin Name: Custom Recent Post
 * Description: A widget that displays authors name.
 * Version: 0.1
 * Author: Sanjip Thapa
 * Author URI: http://sanjipthapa.com.np
 */

class CustomPostWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'custom-recent-post', // Base ID
			__( 'Custom Recent Post', 'text-domain' ), // Name
			array( 
				'description' => __( 'Use this widget for displaying recent post based on theme.', 'text-domain' ),
                'panels_groups' => array('ngoCharity')
            ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = $instance['title'];
		$postsNo = $instance['postsNo'];

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		echo '<div class="posts-list"><ul>';

		$filter = array( 'numberposts' => $postsNo );
		$recent_posts = wp_get_recent_posts( $filter );
		foreach( $recent_posts as $recent ){
			if( has_post_thumbnail($recent["ID"]) ){
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'featured-thumbnail', false ); 
				$image_src = esc_url($image[0]);
			}else{
				$image_src = get_bloginfo('template_directory').'/images/no-thumb.png';
			}
			echo '<li>
				<img src="'.$image_src.'" alt="'.$recent["post_title"].'" width="50px">
				<div class="post-text">
					<h5><a href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a></h5>
					<p>'.ngoCharity_excerpt($recent["post_content"], 40).'</p>
				</div>
			</li>';
		}
		echo '</ul></div>';
		echo $args['after_widget'];

		wp_reset_query();
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['postsNo'] = ( ! empty( $new_instance['postsNo'] ) ) ? strip_tags( $new_instance['postsNo'] ) : '';

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Recent Posts', 'text-domain' );
		$postsNo = ! empty( $instance['postsNo'] ) ? $instance['postsNo'] : __( '', 'text-domain' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="Title for the event">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'postsNo' ); ?>"><?php _e( 'No of posts to show:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'postsNo' ); ?>" name="<?php echo $this->get_field_name( 'postsNo' ); ?>" type="text" value="<?php echo esc_attr( $postsNo ); ?>">
		</p>
		<?php 
	}
}

?>