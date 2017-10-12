<!-- page after -->
<?php

$post_id = $post->ID;

$page_width 		= get_field('page_width', $post_id);
$show_sidebar 		= get_field('show_sidebar', $post_id);
$sidebar_position 	= get_field('sidebar_position', $post_id); ?>

<?php if ($show_sidebar): ?>

	<?php if ($sidebar_position == 'right'): ?>

		<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>

			</div>
					
			<div class="grid__item float-left" data-desk="desk-3-12">

				<ul id="primarySidebar" class="primary-sidebar">

		        <?php dynamic_sidebar( 'primary-sidebar' ); ?>

		    	</ul>

			</div>

		<?php endif; ?>

	<?php else: ?>

		</div>
		
	<?php endif ?>
	
<?php else: ?>

	</div>

<?php endif; ?>

<!-- GRID -->
</div>

<?php if ($page_width == 'boxed'): ?>

<!-- WRAPPER -->
</div>

<?php endif; ?>