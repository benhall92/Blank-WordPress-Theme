<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Oakworld
 * @since Oakworld 1.0
 */
?>

<!-- INDEX -->

<?php

get_header();

wp_reset_query();

if ( have_posts() ) :

	while ( have_posts() ) : the_post(); 

		get_template_part('theme/includes/page_before');

		the_content();

		get_template_part('theme/includes/page_after');
	
	endwhile; // end while

endif; // end if

// get_sidebar();

get_footer(); ?>