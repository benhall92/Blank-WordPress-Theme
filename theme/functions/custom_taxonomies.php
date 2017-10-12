<?php

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function my_range() {

	$labels = array(
		'name'					=> _x( 'Ranges', 'Taxonomy plural name', 'oakworld' ),
		'singular_name'			=> _x( 'Range', 'Taxonomy singular name', 'oakworld' ),
		'search_items'			=> __( 'Search Ranges', 'oakworld' ),
		'popular_items'			=> __( 'Popular Ranges', 'oakworld' ),
		'all_items'				=> __( 'All Ranges', 'oakworld' ),
		'parent_item'			=> __( 'Parent Range', 'oakworld' ),
		'parent_item_colon'		=> __( 'Parent Range', 'oakworld' ),
		'edit_item'				=> __( 'Edit Range', 'oakworld' ),
		'update_item'			=> __( 'Update Range', 'oakworld' ),
		'add_new_item'			=> __( 'Add New Range', 'oakworld' ),
		'new_item_name'			=> __( 'New Range Name', 'oakworld' ),
		'add_or_remove_items'	=> __( 'Add or remove Ranges', 'oakworld' ),
		'choose_from_most_used'	=> __( 'Choose from most used oakworld', 'oakworld' ),
		'menu_name'				=> __( 'Ranges', 'oakworld' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'range', array( 'product' ), $args );
}

// add_action( 'init', 'my_range' );

/* 
 * This function allows for pagination for custom
 * Taxonomies
 * 
 * please add in the name of the taxonomy for the 'is_tax'
 * paramter
 */

function tdd_tax_filter_posts_per_page( $value ) {
	return (is_tax('collections')) ? 1 : $value;
}

// Filter for the taxonomy pagination
add_filter( 'option_posts_per_page', 'tdd_tax_filter_posts_per_page' );

?>