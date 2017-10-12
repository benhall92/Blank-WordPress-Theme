<?php
/* Template Name: Ranges */
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

get_header();

$terms = $terms = get_terms(array(
    'taxonomy' => 'range',
    'hide_empty' => false,
)); ?>

<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>

<div class="wrapper">
 
    <!-- GRID -->
	<div class="grid">
 
 	<?php foreach ( $terms as $term ):

 		// var_dump($term);

 		$term_id 	= $term->term_id;
 		$term_name 	= $term->name;
 		$term_acf 	= 'term_'.$term_id;
 		$image 		= get_field('term_image', $term_acf); ?>

<<<<<<< HEAD
 		<?php echo $term_acf; ?>

=======
>>>>>>> 83e6d5ad49301160313cfe670a17c605ee24338f
        <div class="grid__item float-left" data-desk="desk-4-12" data-lap="lap-1/3" data-palm="palm-2-4">

			<a href="<?php echo get_term_link($term); ?>">

				<?php if ( !empty($image) ): ?>

					<img src="<?php echo $image['url']; ?>" alt="<?php _e('View the full '.$term_name. ' range.', 'oakworld'); ?>" title="<?php _e('View the full '.$term_name. ' range.', 'oakworld'); ?>">
					
				<?php endif ?>

				<p><?php echo $term_name; ?></p>

			</a>

		</div>
    
    <?php endforeach; ?>

	</div>

</div>

<?php endif; ?>

<?php get_footer(); ?>
