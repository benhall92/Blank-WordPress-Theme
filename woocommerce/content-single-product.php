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

	$wistia_embed_code = get_field('wistia_embed_code');
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

			<div class="grid__item float-left" data-desk="desk-9-12" data-lap="lap-6-8">

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

					<div class="grid__item float-left" data-desk="desk-6-12" data-lap="lap-4-8">

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

						if (have_rows('product_usps')): ?>

							<p>

							<?php while(have_rows('product_usps')): the_row(); 

								$usp = get_sub_field('product_usp'); ?>

								<i class="fa fa-check font font--green" aria-hidden="true"></i> <?php echo $usp['label']; ?></br>

							<?php endwhile; ?>

							</p>

						<?php endif ?>

						</div>

					</div>

				<!-- /GRID -->
				</div>

				<div class="grid">
					
					<div class="grid__item">

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

							<p class="measurement-units" id="metricUnits"><strong>
								<?php echo __('Metric Dimensions: ', 'oakworld'); ?>
								<?php echo $metric; ?>
							</strong></p>

							<?php endif;

							if( $imperial != "" ): ?>

							<p class="measurement-units" id="imperialUnits" style="display: none;"><strong>
								<?php echo __('Imperial Dimensions: ', 'oakworld'); ?>
								<?php echo $imperial; ?>
							</strong></p>

							<?php endif; ?>

						</div>

						<div class="product__description">

							<?php the_content(); ?>

						</div>

						<?php if ($wistia_embed_code): ?>

						<div class="margin margin--medium margin--top">

							<div class="grid">

								<div class="grid__item float-left" data-desk="desk-6-12" data-lap="lap-4-8">

									<?php

									$embed_code = wp_oembed_get( $wistia_embed_code );

									echo $embed_code; ?>

								</div>

							</div>

						</div>

						<?php endif ?>
						
					</div>

				</div>

			</div>

			<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-2-8">

				<?php $dir = get_template_directory_uri() . '/_assets/img/hanging-usps-4.jpg'; ?>

				<img src="<?php echo $dir; ?>" alt="FREE Delivery and FREE Returns">

				<p class="align align--center"><?php _e('Call one of our furniture experts today', 'oakworld'); ?> <br/><a class="h1" href="tel:08001404665"><strong>0800 140 4665</strong></a></p>

				<div class="margin margin--top margin--small">

					<!-- TrustBox widget - List -->
					<div class="trustpilot-widget" data-locale="en-GB" data-template-id="539ad60defb9600b94d7df2c" data-businessunit-id="4f205dac0000640005127998" data-style-height="800px" data-style-width="100%" data-stars="3,4,5">
					<a href="https://uk.trustpilot.com/review/oakworld.co.uk" target="_blank">Trustpilot</a>
					</div>
					<!-- End TrustBox widget -->
					
				</div>

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
		do_action( 'woocommerce_after_single_product_summary' ); ?>

		<div class="grid">

			<div class="grid__item float-left">

				<div class="margin margin--medium margin--bottom">

				<?php comments_template(); ?>

				</div>
				
			</div>
			
		</div>

	</div><!-- #product-<?php the_ID(); ?> -->

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>