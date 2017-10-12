<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Oakworld
 * @since Oakworld 1.0
 */

$footer_text 	= get_field('footer_text', 'option');
$facebook 		= get_field('facebook', 'option');
$twitter		= get_field('twitter', 'option');
$instagram 		= get_field('instagram', 'option'); ?>

<!-- MAIN -->
</main>

<!-- FOOTER -->
<footer id="footer" class="[ footer footer--primary ] [ padding padding--bottom padding--small ]">

	<div class="wrapper">

		<div class="grid">

			<?php if ( is_active_sidebar( 'footer-col-one' ) ) : ?>
			
			<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8">

				<ul class="footer__widgets [ margin margin--top margin--small ]">

                <?php dynamic_sidebar( 'footer-col-one' ); ?>

            	</ul>

			</div>

			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-col-two' ) ) : ?>

			<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8">

				<ul class="footer__widgets [ margin margin--top margin--small ]">

                <?php dynamic_sidebar( 'footer-col-two' ); ?>

            	</ul>

			</div>

			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-col-three' ) ) : ?>

			<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8">

				<ul class="footer__widgets [ margin margin--top margin--small ]">

                <?php dynamic_sidebar( 'footer-col-three' ); ?>

            	</ul>

			</div>

			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-col-four' ) ) : ?>

			<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8">

				<ul class="footer__widgets [ margin margin--top margin--small ]">

                <?php dynamic_sidebar( 'footer-col-four' ); ?>

            	</ul>

			</div>

			<?php endif; ?>

		</div>
		
	</div>

<!-- FOOTER -->	
</footer>

<div class="footer footer--secondary [ padding padding--x-small padding--all ]">

	<div class="wrapper">

		<div class="grid">
			
			<div class="grid__item">

				<?php if ($footer_text != ""): ?>

				<p><?php echo $footer_text; ?></p>

				<?php endif ?>
				
			</div>

		</div>
		
	</div>
	
</div>

<div class="grid">

	<div class="wrapper">
	
		<div class="grid__item float-left" data-desk="desk-8-12" data-lap="lap-5-8">

		<?php if (have_rows('footer_payment_options', 'option')): ?>

			<div class="[ padding padding--x-small padding--all ]">

				<ul class="list list--inline payment-options">

				<?php while(have_rows('footer_payment_options', 'option')): the_row(); ?>

					<?php $payment_option = get_sub_field('payment_option'); ?>

					<li>
						<img src="<?php echo $payment_option['url']; ?>" alt="<?php echo $payment_option['alt']; ?>">
					</li>

				<?php endwhile; ?>

				</ul>

			</div>

		<?php endif ?>

		</div>

		<div class="grid__item float-left" data-desk="desk-4-12" data-lap="lap-3-8">

			<div class="[ padding padding--x-small padding--all ]">

				<ul class="list list--inline list--right social-icons">

					<?php if ($facebook != ""): ?>

					<li>

						<a href="<?php echo $facebook; ?>">
							<i class="icon icon--medium icon--secondary btn btn--tertiary fa fa-facebook" aria-hidden="true"></i>
						</a>
						
					</li>

					<?php endif ?>

					<?php if ($twitter != ""): ?>

					<li>

						<a href="<?php echo $twitter; ?>">
							<i class="icon icon--medium icon--secondary btn btn--tertiary fa fa-twitter" aria-hidden="true"></i>
						</a>
						
					</li>

					<?php endif ?>

					<?php if ($instagram != ""): ?>

					<li>

						<a href="<?php echo $instagram; ?>">
							<i class="icon icon--medium icon--secondary btn btn--tertiary fa fa-instagram" aria-hidden="true"></i>
						</a>
						
					</li>

					<?php endif ?>
					
				</ul>

			</div>

		</dov>

	</div>

</div>

<!-- PAGE -->
</div>

<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Roboto:300,400,500' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>

<?php

/* Always have wp_footer() just before the closing </body>
* tag of your theme, or you will break many plugins, which
* generally use this hook to reference JavaScript files.
*/
wp_footer(); ?>
</body>