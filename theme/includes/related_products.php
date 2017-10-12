<?php

$terms = get_the_terms(get_the_id(), 'product_brand');

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

			<div class="align align--center">

				<div class="padding padding--small padding--bottom">

					<h3><?php echo __('View the ', 'oakworld') . $terms[0]->name.__(' range', 'oakworld'); ?></h3>

					<p>
						<strong><?php echo __('Products available ', 'oakworld').$terms[0]->count; ?></strong>
					</p>

				</div>

			</div>

			<div class="woocommerce related">

				<?php woocommerce_product_loop_start(); ?>

				<?php while ( $the_query->have_posts() ) : $the_query->the_post();

					get_template_part('woocommerce/content-product');
				  
				// Do Stuff
				endwhile; ?>

				<?php woocommerce_product_loop_end(); ?>

			</div>

		</div>
		
	</div>

	<div class="align align--center">

		<a class="btn btn--tertiary btn--medium" href="<?php echo $term_link; ?>"><?php _e('Shop full range', 'oakworld'); ?></a>
		
	</div>

</div>

<?php endif;

wp_reset_postdata(); ?>	