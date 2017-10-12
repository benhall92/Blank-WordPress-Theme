<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Oakworld
 * @since Oakworld 1.0
 */

get_header(); ?>

	<!-- GRID -->
	<div class="grid">

	<?php while ( have_posts() ) : the_post();

		$term_name 	= __( get_queried_object()->name, 'oakworld');

		echo $term_name;

		$term_id 	= get_queried_object()->term_id;
		$term 		= $term_name . '_' . $term_id;
		$image 		= get_field('term_image', $term); ?>

		<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-1/3" data-palm="palm-2-4">

			<a href="<?php echo get_term_link(); ?>">

			<?php if( !empty($image) ): ?>

				<img src="<?php echo $image['url']; ?>" title="<?php echo $term_name; ?>" alt="<?php echo $term_name; ?>">

			<?php endif; ?>

				<h2><?php echo $term_name; ?></h2>

			</a>

		</div>

	<?php
	// End the loop.
	endwhile; ?>

	<!-- /GRID -->
	</div>

	<?php
	// Previous/next page navigation.
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
		'next_text'          => __( 'Next page', 'twentyfifteen' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
	) ); ?>

<?php get_footer(); ?>
