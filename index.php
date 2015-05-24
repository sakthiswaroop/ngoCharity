<?php
/**
 * The main template file.
 * @package NgoCharity
 */

get_header(); ?>

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
