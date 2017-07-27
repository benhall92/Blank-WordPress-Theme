<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$product_ID = get_the_ID(); ?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<!-- CONTENT SINGLE PRODUCT -->
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrapper">

		<div class="product__header">

			<div class="grid">

				<div class="grid__item float-left">

					<?php if( wp_get_referer() ): ?>
							
						<a class="product__back btn btn--secondary btn--x-small" href="<?php echo wp_get_referer() ?>" >< <?php _e('Back', 'oakworld'); ?></a>

					<?php endif; ?>

					<?php woocommerce_breadcrumb(); ?>
					
				</div>
				
			</div>
			
		<!-- product header -->
		</div>

		<!-- GRID -->
		<div class="grid">

			<div class="grid__item float-left" data-desk="desk-6-12" data-lap="lap-4-8">

				<div class="product__gallery">

				<?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' ); ?>

				</div>

			</div>

			<div class="grid__item float-left" data-desk="desk-5-12 desk-push-1" data-lap="lap-4-8">

				<div class="product__info">

					<?php
					/**
					 * woocommerce_single_product_summary hook.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );

					// echo do_shortcode('[wc_in_stock]'); ?>

					<?php //echo inter_show_sku('Product code'); ?>

					<?php //woocommerce_template_single_rating(); ?>

					<?php //woocommerce_template_single_price(); ?>

					<?php //woocommerce_template_single_add_to_cart(); ?>

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

			</div>

		<!-- /GRID -->
		</div>

		<div class="grid">

			<div class="grid__item float-left" data-desk="desk-6-12">

				<div class="product__details">

					<h3><strong><?php _e('Product Information', 'oakworld'); ?></strong></h3>

					<?php inter_show_sku(); ?>
					
					<?php

					$metric = get_post_meta($product_ID, '_metric_dimensions', true);

					$imperial = get_post_meta($product_ID, '_imperial_dimensions', true);

					if( $metric != "" && $imperial != "" ):

						echo '<button id="unitConvert" class="btn btn--small btn--primary">
							<i class="fa fa-repeat" aria-hidden="true"></i> Convert</button>';

					endif;

					if( $metric != "" ): ?>

					<p id="metricUnits"><strong>
						<?php echo __('Metric Dimensions: ', 'oakworld'); ?>
						<?php echo $metric; ?>
					</strong></p>

					<?php endif;

					if( $imperial != "" ): ?>

					<p id="imperialUnits" style="display: none;"><strong>
						<?php echo __('Imperial Dimensions: ', 'oakworld'); ?>
						<?php echo $imperial; ?>
					</strong></p>

					<?php endif; ?>

				</div>

				<?php the_content(); ?>
				
			</div>

			<div class="grid__item float-left" data-desk="desk-6-12">

				<?php woocommerce_template_single_excerpt(); ?>

			</div>
			
		</div>

		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>

		<?php

		$terms = get_the_terms($post->ID, 'product_brand');

		$the_query = new WP_Query(array(
			'post_type'			=> 'product',
			'posts_per_page' 	=> 4,
			'tax_query' 		=> array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_brand',
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

					<?php //$terms = get_the_terms($post->ID, 'product_brand'); ?>

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

				<a class="btn btn--tertiary btn--medium" href="<?php echo $term_link; ?>"><?php _e('Shop full range', 'oakworld'); ?></a>
				
			</div>

		</div>

		<?php endif;

		wp_reset_postdata(); ?>	

		<div class="grid">

			<div class="grid__item float-left">

				<?php comments_template(); ?>
				
			</div>
			
		</div>

	</div><!-- #product-<?php the_ID(); ?> -->

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>