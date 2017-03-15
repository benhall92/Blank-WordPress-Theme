<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Blank
 * @since Blank 1.0
 */
?>

<!-- PAGE -->
<?php

get_header();

wp_reset_query();

if ( have_posts() ) :

	while ( have_posts() ) : the_post(); 

		the_content(); ?>
	
	<?php endwhile; // end while

endif; // end if

get_sidebar();

get_footer(); ?>