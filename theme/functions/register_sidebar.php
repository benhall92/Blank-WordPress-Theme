<?php

/**
* Creates a sidebar
* @param string|array  Builds Sidebar based off of 'name' and 'id' values.
*/

function oakworld_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'oakworld' ),
		'id'            => 'primary-sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	));

	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'oakworld' ),
		'id'            => 'shop-sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	));

	register_sidebar( array(
		'name'          => __( 'Footer Column One', 'oakworld' ),
		'id'            => 'footer-col-one',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	));

	register_sidebar( array(
		'name'          => __( 'Footer Column Two', 'oakworld' ),
		'id'            => 'footer-col-two',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	));

	register_sidebar( array(
		'name'          => __( 'Footer Column Three', 'oakworld' ),
		'id'            => 'footer-col-three',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	));

	register_sidebar( array(
		'name'          => __( 'Footer Column Four', 'oakworld' ),
		'id'            => 'footer-col-four',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	));
}

add_action( 'widgets_init', 'oakworld_widgets_init' );

?>