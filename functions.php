<?php

// Include the common funtions that may/may not be used
include 'theme/functions/common.php';

// Create custom post types, taxonimies etc.
include 'theme/functions/custom_post_types.php';
include 'theme/functions/custom_taxonomies.php';

// Enqueue CSs and JS here
include 'theme/functions/enqueue_scripts.php';

// Register other settings here
include 'theme/functions/register_menu.php';
include 'theme/functions/register_sidebar.php';

// Include Navigation Markup Schema Walker class
// include 'theme/functions/nav_schema_walker.php';

/**
 * Adds support for the title tag in the theme
 **/

add_theme_support( 'title-tag' );


/**
 * Adds support for Post Thumbnails
 **/

add_theme_support( "post-thumbnails" );


/**
 * Required by Theme Forest for submission
**/ 

add_theme_support( "custom-header" );
add_theme_support( "custom-background" );

/**
 * Add Markup Schema to WP Nav
 *
 * Source: http://wordpress.stackexchange.com/questions/203414/add-itemprop-schema-org-markup-to-li-elements-in-wp-nav-menu
**/

function add_menu_atts( $atts, $item, $args ) {
  $atts['itemprop'] = 'url';
  return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );

/**
 * This function automatically adds another stylesheet with
 * -rtl prefix, e.g. editor-style-rtl.css. If that file doesn’t
 * exist, it is removed before adding the stylesheet(s) to
 * TinyMCE. If an array of stylesheets is passed to
 * add_editor_style(), RTL is only added for the first stylesheet.
 *
 * URL: https://developer.wordpress.org/reference/functions/add_editor_style/
**/

add_editor_style();


// add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );

/**
 * Since Version 3.0, themes need to use add_theme_support()
 * in the functions.php file to support feed links, like so:
 * URL: https://codex.wordpress.org/Automatic_Feed_Links
**/

add_theme_support( 'automatic-feed-links' );

// Set the maximum content width for uploaded Media
if ( ! isset( $content_width ) ) {
	$content_width = 1500;
}


if ( is_singular() ){
	wp_enqueue_script( "comment-reply" );
}

// Position Yoast Seo at bottom of page after ACF
// Uncomment this if you want to enable it
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

?>
