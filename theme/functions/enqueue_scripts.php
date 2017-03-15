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
function theme_name_scripts() {

	// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );

	wp_enqueue_script('JQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3', false);

	wp_enqueue_script('fontAwesome', 'https://use.fontawesome.com/3608d41ab9.js', array(), '1.11.3', false);

	wp_enqueue_script('themJS', get_template_directory_uri().'/_assets/js/theme.js', array(), false, true);

	wp_enqueue_style( 'themeCSS', get_template_directory_uri().'/_assets/css/main.css', array(), '1', false );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

 ?>