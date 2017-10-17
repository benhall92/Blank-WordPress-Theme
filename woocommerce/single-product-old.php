 <?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

wp_reset_query(); 

$post_id = get_the_ID(); ?>

<!-- SINGLE PRODUCT -->

<div class="woocommerce">

	<!-- WRAPPER -->
	<div class="wrapper">

		<!-- PRODUCT -->
		<div class="product product-single">

			<div class="product-single__header">

				<div class="grid">

					<div class="grid__item float-left">

						<?php if( wp_get_referer() ): ?>
  							
  							<a class="product-single__back btn btn--secondary btn--x-small" href="<?php echo wp_get_referer() ?>" >< <?php _e('Back', 'oakworld'); ?></a>

  						<?php endif; ?>

  						<?php woocommerce_breadcrumb(); ?>
						
					</div>
					
				</div>
				
			</div>

			<!-- GRID -->
			<div class="grid">

				<div class="grid__item float-left" data-desk="desk-6-12" data-lap="lap-4-8">

					<?php woocommerce_show_product_images(); ?>

				</div>

				<div class="grid__item float-left" data-desk="desk-5-12 desk-push-1" data-lap="lap-4-8">

					<div class="product-single__info">

						<h1><?php the_title(); ?></h1>

						<?php echo inter_show_sku('Product code'); ?>

						<?php woocommerce_template_single_rating(); ?>

						<?php woocommerce_template_single_price(); ?>

						<?php woocommerce_template_single_add_to_cart(); ?>

						<?php echo do_shortcode('[wc_in_stock]'); ?>

						<p class="product-single__delivery info__small">
							<strong>Delivery withing 7-10 days</strong>
						</p>

					</div>

					<?php if (have_rows('product_usps')): ?>

					<div class="product-usps">

						<?php while(have_rows('product_usps')): the_row(); ?>

							<?php
								$usp = get_sub_field('product_usp');
								$dir = get_template_directory_uri() . '/_assets/img/usps/';	?>

							<div class="product-usps__usp">

								<img src="<?php echo $dir.$usp['value']; ?>.png" alt="<?php echo $usp['label']; ?>">

								<p><?php echo $usp['label']; ?></p>
								
							</div>

						<?php endwhile; ?>
						
					</div>

					<?php endif ?>

				</div>

			<!-- /GRID -->
			</div>

			<div class="grid">

				<div class="grid__item float-left" data-desk="desk-6-12">

					<h3><strong><?php _e('Product Information', 'oakworld'); ?></strong></h3>

					<?php echo inter_show_sku('Product code'); ?>
					
					<?php

					$metric = get_post_meta($post_id, '_metric_dimensions', true);

					$imperial = get_post_meta($post_id, '_imperial_dimensions', true);

					if( $metric != "" ): ?>

					<p><strong>
						<?php echo __('Metric Dimensions: ', 'oakworld'); ?>
						<?php echo $metric; ?>
					</strong></p>

					<?php endif;

					if( $imperial != "" ): ?>

					<p><strong>
						<?php echo __('Metric Dimensions: ', 'oakworld'); ?>
						<?php echo $imperial; ?>
					</strong></p>

					<?php endif; ?>

					<?php the_content(); ?>
					
				</div>
				
			</div>

			<?php

			$terms = get_the_terms($post->ID, 'range');

			$the_query = new WP_Query(array(
				'post_type'			=> 'product',
				'posts_per_page' 	=> 4,
				'tax_query' 		=> array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'range',
						'field' => 'id',
						'terms' => array( $terms[0]->term_id ),
						'operator' => 'IN'
					)
				)
			));

			$term_link = get_term_link($terms[0]->term_id);
			
			// The Loop
			if ( $the_query->have_posts() ) : ?>

			<div class="margin margin--medium margin--top-bottom">

				<div class="grid">

					<div class="grid__item float-left">

						<?php $terms = get_the_terms($post->ID, 'range'); ?>

						<div class="align align--center">

							<div class="padding padding--small padding--bottom">

								<h3><?php echo __('View the ', 'oakworld') . $terms[0]->name.__(' range', 'oakworld'); ?></h3>

								<p>
									<strong><?php echo __('Products available ', 'oakworld').$terms[0]->count; ?></strong>
								</p>

							</div>

						</div>

						<div class="woocommerce related">

							<ul class="products">

								<?php while ( $the_query->have_posts() ) : $the_query->the_post();

									get_template_part('woocommerce/content-product');
								  
								// Do Stuff
								endwhile; ?>

							</ul>

						</div>

					</div>
					
				</div>

				<div class="align align--center">

					<a class="btn btn--quarternary btn--medium" href="<?php echo $term_link; ?>"><?php _e('Shop full range', 'oakworld'); ?></a>
					
				</div>

			</div>

			<?php endif;

			wp_reset_postdata(); ?>	

			<div class="grid">

				<div class="grid__item float-left">

					<?php comments_template(); ?>
					
				</div>
				
			</div>

		<!-- /PRODUCT -->
		</div>

	<!-- /WRAPPER -->
	</div>

	<?php //woocommerce_content(); ?>
			
</div>	

<?php get_footer(); ?>