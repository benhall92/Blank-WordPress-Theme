<?php
/**
 * The single post template file
 *
 * This is the template that will be used for single posts.
 * To make this more specific to a post type, copy this page
 * and rename it 'single-post-type.php'
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Blank
 * @since Blank 1.0
 */
?>

<!-- SINGLE -->

<!--
- SCHEMA
-
- Source = https://schema.org/Article
-
<div itemscope itemtype="http://schema.org/Article">
	<img itemprop="thumbnailUrl" src="" alt="">
	<span itemprop="name">How to Tie a Reef Knot</span>
	<span itemprop="author">John Doe</span>
	<span itemprop="datePublished">2012</span>
	<span itemprop="description">The library catalog as a catalog of works
      was an infectious idea, which together with research led to
      reconceptualization in the form of the FRBR conceptual model.
	</span>
</div>
-
-->

<?php

get_header();

wp_reset_query();

if ( have_posts() ) :

	while ( have_posts() ) : the_post();

		the_content();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	
	endwhile // end while

endif // end if

get_sidebar();
get_footer();

?>