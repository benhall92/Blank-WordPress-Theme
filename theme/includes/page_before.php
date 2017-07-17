<!-- page before -->
<?php

$post_id = $post->ID;

$page_width 		= get_field('page_width', $post_id);
$show_sidebar 		= get_field('show_sidebar', $post_id);
$sidebar_position 	= get_field('sidebar_position', $post_id);
$show_slider 		= get_field('show_slider', $post_id);
$slider_shortcode 	= get_field('slider_shortcode', $post_id);

if( $show_slider ):

	echo do_shortcode( $slider_shortcode );

endif;

if ($page_width == 'boxed'): ?>

<div class="wrapper <?php if( !$show_slider ): ?> margin margin--medium margin--top-bottom <?php endif; ?>">

<?php endif; ?>

<div class="grid">

<?php if ($show_sidebar): ?>

	<?php if ($sidebar_position == 'left'): ?>

		<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
				
			<div class="grid__item float-left" data-desk="desk-3-12">

				<ul id="primarySidebar" class="primary-sidebar">

		        <?php dynamic_sidebar( 'primary-sidebar' ); ?>

		    	</ul>

			</div>

			<div class="grid__item float-left" data-desk="desk-9-12">

		<?php endif; ?>

	<?php else: ?>

		<div class="grid__item float-left" data-desk="desk-9-12">

	<?php endif; ?>
	
<?php else: ?>

	<div class="grid__item">

<?php endif; ?>