<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */ ?>

<!-- ARCHIVE PRODUCT -->

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<div class="wrapper">

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		// do_action( 'woocommerce_before_main_content' );

		woocommerce_output_content_wrapper();
		// generate_website_data();
	?>

	<div class="grid">
		
		<div class="grid__item">

		    <div class="woocommerce-products-header">

				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

					<h1 class="archive-title"><?php woocommerce_page_title(); ?></h1>

				<?php endif; ?>

				<div class="archive__description">

				<?php
					/**
					 * woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					//do_action( 'woocommerce_archive_description' );
				?>

				</div>

		    </div>

		</div>

	</div>

	<div class="grid">
		
		<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-2-8">

			<aside>

				<div id="sidebarMobileTrigger" class="clearfix sidebar-mobile-trigger" data-desk="desk-hidden" data-lap="lap-hidden">
		
					<p class="float-left">
						<?php echo _e('Menu', 'blank-theme'); ?>
					</p>

					<span class="float-right">
						&rsaquo;
					</span>

				</div>

				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>

					<ul id="shopSidebar" class="sidebar sidebar--shop">

						<li class="sidebar__heading sidebar-title">
							<h2 class="widgettitle">Filter by</h2>
						</li>

			        <?php dynamic_sidebar( 'shop-sidebar' ); ?>

			    	</ul>

				<?php endif; ?>

			</aside>

		</div>

		<div class="grid__item float-left" data-desk="desk-9-12" data-lap="lap-6-8">

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			?>

		<?php endif; ?>

	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>


	<div class="grid [ margin margin--medium margin--top-bottom ]">
		<div class="grid__item">
			<?php do_action( 'woocommerce_archive_description' ); ?>
		</div>
	</div>

	<?php if (have_rows('archive_usps', 'option')): ?>

	<div class="grid archive-usps [ margin margin--medium margin--top-bottom ]">

		<?php while (have_rows('archive_usps', 'option')): the_row(); ?>

			<?php 

				$usp_image 	= get_sub_field('usp_image');
				$usp_text 	= get_sub_field('usp_text'); ?>
			
			<div class="grid__item float-left archive-usps__usp" data-desk="desk-3-12" data-lap="lap-2-8" data-palm="palm-2-4">

				<div class="align align--center">

				<?php output_img($usp_image); ?>

				<?php output_text($usp_text, 'p'); ?>

				</div>
				
			</div>

		<?php endwhile; ?>
	</div>
	 	
	 <?php endif ?> 

<!-- /WRAPPER -->
</div>

<?php get_footer( 'shop' ); ?>