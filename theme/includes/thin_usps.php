<?php if ( have_rows('header_usps', 'option') ): ?>

<?php $header_usp_count = 1; ?>

<div class="header header--secondary">

	<div class="wrapper">

		<div class="grid">

			<?php while( have_rows('header_usps', 'option') ): the_row();

				$usp_type 	= get_sub_field('usp_type');
				$usp_text 	= get_sub_field('usp_text');
				$usp_icon 	= get_sub_field('usp_icon');
				$usp_image 	= get_sub_field('usp_image');
				$usp_link 	= get_sub_field('usp_link'); ?>

			<?php if ($header_usp_count == 1): ?>

				<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8">

			<?php elseif ($header_usp_count == 2): ?>

				<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8" data-palm="palm-hidden">

			<?php else: ?>

				<div class="grid__item float-left"  data-desk="desk-3-12" data-lap="lap-hidden" data-palm="palm-hidden">
				
			<?php endif ?>

				<div class="thin-usp">

					<?php if ($usp_link != ""): ?>

						<a href="<?php echo $usp_link; ?>">
						
					<?php endif ?>

					<?php if ($usp_type == 'icon-text' ): ?>

						<?php if ($usp_icon != '' ): ?>
					
						<i class="<?php echo $usp_icon; ?>" aria-hidden="true"></i>

						<?php endif; ?>

						<?php output_text($usp_text, 'p'); ?>

					<?php else: ?>

						<?php if ($usp_image['url'] != '' || $usp_image['url'] != false ): ?>

							<img src="<?php echo $usp_image['url']; ?>" alt="<?php echo $usp_image['alt']; ?>">

						<?php endif; ?>

					<?php endif ?>

					<?php if ($usp_link != ""): ?>

						</a>
						
					<?php endif ?>

				</div>
				
			</div>

			<?php $header_usp_count++; ?>

			<?php endwhile; ?>
			
		</div>

	</div>
	
</div>

<?php endif; ?>