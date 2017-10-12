<?php
/**
 * Template for displaying search forms in Oakworld
 *
 * @package WordPress
 * @subpackage Oakworld
 * @since Oakworld 1.0
 */
?>
<form method="get" id="searchform" class="search-form search-form--inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input type="text" class="input" name="s" id="s" placeholder="<?php esc_attr_e( 'Search product name, code or range', 'oakworld' ); ?>" />

	<input type="hidden" name="post_type" value="product" />

<<<<<<< HEAD
	<button type="submit" value="true" class="btn btn--primary search-form__submit" name="submit" id="searchsubmit">
=======
	<button type="submit" class="btn btn--primary search-form__submit" name="submit" id="searchsubmit">
>>>>>>> 83e6d5ad49301160313cfe670a17c605ee24338f
		<i class="fa fa-search" aria-hidden="true"></i>
	</button>
	
</form>