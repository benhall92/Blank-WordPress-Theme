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

	<?php if ( have_posts() ) : ?>

		<!-- GRID -->
		<div class="grid">

		<?php while ( have_posts() ) : the_post(); ?>

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

							<p>
								<small><i class="fa fa-user" aria-hidden="true"></i> <?php the_author(); ?></small> | <small><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_date(); ?></small>
							</p>

							<p><?php the_excerpt(); ?></p>

							<button class="btn">Read More</button>

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
			'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
			'next_text'          => __( 'Next page', 'twentyfifteen' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
		) );

	else :
	// No posts found

	endif; ?>

<?php get_footer(); ?>
