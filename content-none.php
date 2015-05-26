<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package NgoCharity
 */
?>
<section class="blog-box">
	<div class="blog-info clearfix">
		<div class="blog-left">
			<figure class="snap-edits"><img src="<?php bloginfo('template_directory'); ?>/images/no-content.png" alt="no-content"></figure>
		</div><!-- blog-left ends -->
		<div class="blog-details">
			<h2><?php _e( 'Nothing Found', 'ngoCharity' ); ?></h2>
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ngoCharity' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ngoCharity' ); ?></p>
				<?php //get_search_form(); ?>

			<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ngoCharity' ); ?></p>
				<?php //get_search_form(); ?>

			<?php endif; ?>
		</div><!-- details end -->
	</div><!-- blog-info ends -->
</section><!-- blog-box ends -->