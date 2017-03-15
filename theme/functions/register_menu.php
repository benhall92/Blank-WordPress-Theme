<?php
/* This is the function that allows us to create
 * Custom menus for our themes
 *
 * @param slug - This is the slug for the menu so that it can be referenced
 * @param name - This is the nice name for the menu
 */
function register_my_menu() {

	// Slug then nice name
	// register_nav_menu( $location, $description );
	
	register_nav_menu('main-menu',__( 'Main Menu' ));
}

// Register menus
add_action( 'init', 'register_my_menu' );

?>