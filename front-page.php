<?php
/**
 * The front page file.
 * @package NgoCharity
 */

get_header(); ?>

	<?php 
		global $ngoCharity_options;
		$ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );

		if ( 'page' == get_option( 'show_on_front' ) ) {
		    include( get_page_template() );
		} else {
			get_template_part( 'index', 'one' ); 
		}
		
		
	?>
	
<?php get_footer(); ?>
