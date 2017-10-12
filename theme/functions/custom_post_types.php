<?php

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function prefix_register_name() {

	$labels = array(
		'name'                => __( 'Plural Name', 'oakworld' ),
		'singular_name'       => __( 'Singular Name', 'oakworld' ),
		'add_new'             => _x( 'Add New Singular Name', 'oakworld', 'oakworld' ),
		'add_new_item'        => __( 'Add New Singular Name', 'oakworld' ),
		'edit_item'           => __( 'Edit Singular Name', 'oakworld' ),
		'new_item'            => __( 'New Singular Name', 'oakworld' ),
		'view_item'           => __( 'View Singular Name', 'oakworld' ),
		'search_items'        => __( 'Search Plural Name', 'oakworld' ),
		'not_found'           => __( 'No Plural Name found', 'oakworld' ),
		'not_found_in_trash'  => __( 'No Plural Name found in Trash', 'oakworld' ),
		'parent_item_colon'   => __( 'Parent Singular Name:', 'oakworld' ),
		'menu_name'           => __( 'Plural Name', 'oakworld' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'author', 'thumbnail',
			'excerpt','custom-fields', 'trackbacks', 'comments',
			'revisions', 'page-attributes', 'post-formats'
			)
	);

	register_post_type( 'slug', $args );
}

// add_action( 'init', 'prefix_register_name' );

?>