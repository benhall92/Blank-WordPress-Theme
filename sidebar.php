<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Blank
 * @since Blank 1.0
 */
?>

<?php if ( is_active_sidebar( 'primary-sidebar' )  ) : ?>
	
	<aside id="primarySidebar" class="sidebar" role="complementary">

		<div id="sidebarMobileTrigger" class="clearfix sidebar__mobile-trigger" data-desk="desk-hidden" data-lap="lap-hidden">
		
			<p class="float-left">
				<?php echo _e('Menu', 'blank-theme'); ?>
			</p>

			<span class="float-right">
				&rsaquo;
			</span>

		</div>

		<ul class="sidebar__widget-list">
			<?php dynamic_sidebar( 'primary-sidebar' ); ?>
		</ul>

	</aside>

<?php endif; ?>