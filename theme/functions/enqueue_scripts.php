<?php
/**
 * Proper way to enqueue scripts and styles
 * Correctly adds scripts to the theme
 *
 * @param $handle - 		Name used as a handle for the script
 * @param $src - 		URl to the script, use get_template_directory_uri() for local scripts
 * @param $deps - 		And array of scripts that this script depends on, defaults array
 * @param $ver - 		A string specifying the version number, defaults false
 * @param $in_footer 		Specify true to show in footer, defaults false
 *
 */
function oakworld_scripts() {

	// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );

	wp_enqueue_script('JQuery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3', false);

	// wp_enqueue_script('lazyload', get_template_directory_uri().'/_assets/js/lazyload.jquery.js', array('JQuery'), false, false);

	wp_enqueue_script('dekoAPI', '//secure.dekopay.com/js_api/FinanceDetails.js.php?api_key=da1db925b0f82c1fbaa889bc5c376ded', array(), false, false);
<<<<<<< HEAD
=======

	wp_enqueue_script('fontAwesome', '//use.fontawesome.com/3608d41ab9.js', array(), '1.11.3', false);

	wp_enqueue_script( 'jquery-ui-core' );

	wp_enqueue_script('themeJS', get_template_directory_uri().'/_assets/js/theme.js', array(), false, true);

	wp_enqueue_style('theme-style', get_stylesheet_uri(), false, '1');

	wp_enqueue_style( 'Roboto', "//fonts.googleapis.com/css?family=Roboto:300,400,500", array(), '1', false );
>>>>>>> 83e6d5ad49301160313cfe670a17c605ee24338f

	wp_enqueue_script( 'jquery-ui-core' );

	// wp_enqueue_script('fontAwesome', '//use.fontawesome.com/3608d41ab9.js', array(), false, true);

	wp_enqueue_script('themeMinJS', get_template_directory_uri().'/_assets/js/theme.min.js', array(), false, true);

	wp_enqueue_style('theme-style', get_stylesheet_uri(), false, '1');

	// wp_enqueue_style( 'Roboto', "//fonts.googleapis.com/css?family=Roboto:300,400,500", array(), '1', false );

	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), false, false );


	wp_enqueue_style( 'themeCSS', get_template_directory_uri().'/_assets/css/main.css', array(), false, false );
}

add_action( 'wp_enqueue_scripts', 'oakworld_scripts' );

/**
 * Dequeue the jQuery UI script.
 *
 * Hooked to the wp_print_scripts action, with a late priority (100),
 * so that it is after the script was enqueued.
 */

function wpdocs_dequeue_script() {
	wp_dequeue_script( 'font-awesome' );
}

add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );

 ?>