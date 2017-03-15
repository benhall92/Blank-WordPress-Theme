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
 * @subpackage Blank
 * @since Blank 1.0
 */

get_header(); ?>

<!-- ARCHIVE -->
<div class="padding padding--medium padding--top-bottom">

	<?php if ( have_posts() ) : ?>

		<div class="grid">

			<div class="grid__item float-left">

				<div class="margin margin--small margin--top-bottom">
					<h1><?php echo _e('Your results for: ', 'blank-theme') . get_search_query() . _e(' returned the following results.', 'blank-theme');?></h1>
				</div>

				<div class="margin margin--small margin--bottom">
					<?php get_search_form(true); ?>
				</div>
				
			</div>

		</div>

		<!-- GRID -->
		<div class="grid">

			<?php while ( have_posts() ) : the_post();?>

				<?php if (has_post_thumbnail() ): ?>

				<div class="grid__item float-left" data-desk="desk-4-12" data-lap="lap-2-8">

					<?php the_post_thumbnail( 'medium' ); ?>

				</div>

				<div class="grid__item float-left" data-desk="desk-8-12" data-lap="lap-6-8">

				<?php else: ?>

				<div class="grid__item">

				<?php endif ?>

					<div class="search-result-item">

						<a href="<?php the_permalink();?>">

							<h3><?php the_title(); ?></h3>

							<p><?php the_excerpt(); ?></p>

							<button class="btn btn--medium">Read More</button>

						</a>
						
					</div>
				
				<!-- /GRID ITEM -->
				</div>
				
			<?php
			// End the loop.
			endwhile; ?>

		<!-- /GRID -->
		</div>

		<?php 
		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => __( 'Previous page', 'interpolate-restaurant-theme' ),
			'next_text'          => __( 'Next page', 'interpolate-restaurant-theme' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'interpolate-restaurant-theme' ) . ' </span>',
		) );

	else : ?>

	<div class="grid">

		<div class="grid__item float-left">

			<div class="margin margin--small margin--top-bottom">
				<h1><?php echo _e('Your results for: ', 'blank-theme') . get_search_query() . _e(' returned no results.', 'blank-theme');?></h1>
			</div>

			<div class="margin margin--small margin--bottom">
				<?php get_search_form(true); ?>
			</div>

			<div class="grid__item float-left">

				<div class="margin margin--small margin--bottom">

					<p><?php echo _e('Sorry, but it looks like your search returned no results.', 'blank-theme'); ?></p>

				</div>

			</div>
			
		</div>

	</div>

	<?php endif; ?>

</div>

<?php
	
	get_sidebar();
	get_footer();

?>
