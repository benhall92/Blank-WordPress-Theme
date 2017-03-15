<?php
/**
 * Template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Blank
 * @since Blank 1.0
 */
?>
<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input type="text" class="input" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'interpolate-restaurant-theme' ); ?>" />

	<button type="submit" class="btn search-form__submit" name="submit" id="searchsubmit">
		<?php _e(' SEARCH', 'blank-theme') ?>
	</button>
</form>