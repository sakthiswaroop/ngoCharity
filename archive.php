<?php
/**
 * The template for displaying Archive pages.
 * @package NgoCharity
 */

get_header(); 
global $ngoCharity_options;
$ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );
?>

	<div class="banner" style="background:url(<?php bloginfo('template_directory'); ?>/images/resource/banner-1.jpg);">
		<div class="container">
			<h1>
				<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						printf( __( 'Author: %s', 'ngoCharity' ), '<span class="vcard">' . get_the_author() . '</span>' );

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

	<div class="container">
    	<div class="row">
      		<div class="span9">
			<?php if ( have_posts() ) : ?>


				<?php 
					while ( have_posts() ) : the_post(); ?>
					<?php
						get_template_part( 'content' );
					?>
				<?php endwhile; ?>

				<?php //ngoCharity_paging_nav(); ?>
				<div class="pagination">
          			<ul>
			            <li class="previous"><a href="#">Prev</a></li>
			            <li><a href="#">1</a></li>
			            <li><a href="#">2</a></li>
			            <li><a href="#">3</a></li>
			            <li class="active"><a href="#">4</a></li>
			            <li><a href="#">5</a></li>
			            <li><a href="#">6</a></li>
			            <li><a href="#">...</a></li>
			            <li><a href="#">22</a></li>
			            <li class="next"><a href="#">Next</a></li>
          			</ul>
        		</div><!-- pagination ends --> 
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
    		</div>
			
			<div class="span3">
		    	<?php get_sidebar('right'); ?>
		    </div>
		</div>
  	</div><!-- /container --> 
<?php get_footer(); ?>