<?php 

/**
* Template for displaying all single posts
* @package NgoCharity
*/

get_header();

global $ngoCharity_options;
$ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);

$cat_blog = $ngoCharity_settings['blog_cat'];

get_footer();
?>

single