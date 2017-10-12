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

// add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );

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


/*
 * This function adds widget support to our Mega Menu.
 * It allows us to create more complex Menus. IE, the
 * of image widgets etc.
 *
 * SRC: https://slicejack.com/create-fully-custom-wordpress-mega-menu-no-plugins-attached/
 */

function oakworld_mega_menu() {

    $location 	= 'mega_menu';
    $css_class 	= 'has-mega-menu';
    $locations 	= get_nav_menu_locations();

    if ( isset( $locations[ $location ] ) ) {

        $menu = get_term( $locations[ $location ], 'nav_menu' );

        if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
            
            foreach ( $items as $item ) {
                
                if ( in_array( $css_class, $item->classes ) ) {
                    
                    register_sidebar( array(
                        'id'   => 'mega-menu-widget-area-' . $item->ID,
                        'name' => $item->title . ' - Mega Menu',
                    ) );
                }
            }
        }
    }
}

add_action( 'widgets_init', 'oakworld_mega_menu' );



/*
 * Change number of products per page
 */

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 10 );

function new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = 12;
    return $cols;
}

/*
 * Change number or products per row to 3
 */

add_filter('loop_shop_columns', 'loop_columns');

if (!function_exists('loop_columns')) {

    function loop_columns() {

        if( is_front_page() ):

            return 4;

        else:

            return 3;
             
        endif;
    }
}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 

// function woo_related_products_limit() {
    
//     global $product;
    
//     $args['posts_per_page'] = 4;
//     return $args;
// }

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );

function jk_related_products_args( $args ) {

    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 4; // arranged in 4 columns
    return $args;
}

/*
 * Declare support for Woocommerce
 */

add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/*
 * This function outputs a line of text
 * either with a tick or a cross.
 * This is to help indicate the availability of a product.
 */

function wc_in_stock_func( $atts ) {

    global $product;
    
    if ( $product->is_in_stock() ) {

        return '<div class="stock">
                <span class="stock__availability stock__availability--in"><i class="fa fa-check" aria-hidden="true"></i> '. __('In Stock', 'oakworld').'
                </span>
            </div>';

    } else {
       
        return '<div class="stock">
                    <span class="stock__availability stock__availability--out"><i>X</i> '. _e( 'Out of Stock', 'oakworld' ). '</span>
                </div>';
    }
}

add_shortcode( 'wc_in_stock', 'wc_in_stock_func' );

/*
 * Create a shortcode to display the product SKU
 */

function inter_show_sku($text) {
 
    global $product;

    $sku = $product->get_sku();

    if( $sku == '' || !$sku ){ return; }

    if( $text != "" ):

        return '<p class="product-single__code info__small">'.$text.': '.$sku.'</p>';

    else:

        return '<p class="product-single__code info__small">'.$sku.'</p>';

    endif;
}

/*
 * Create an options page for ACF
 */

if( function_exists('acf_add_options_page') ) {
 
    $option_page = acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'  => false
    ));
}


// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">';
  
    woocommerce_wp_text_input( 
        array(
            'id'                => '_metric_dimensions', 
            'label'             => __( 'Metric Dimensions', 'oakworld' ), 
            'placeholder'       => '', 
            'description'       => __( 'Enter the Metric dimensions for this product.', 'oakworld' )
        )
    );

    woocommerce_wp_text_input( 
        array(
            'id'                => '_imperial_dimensions', 
            'label'             => __( 'Imperial Dimensions', 'oakworld' ), 
            'placeholder'       => '', 
            'description'       => __( 'Enter the Imperial dimensions for this product.', 'oakworld' )
        )
    );
  
  echo '</div>';   
}

function woo_add_custom_general_fields_save( $post_id ){

    // Text Field
    $_metric_dimensions = $_POST['_metric_dimensions'];
    if( !empty( $_metric_dimensions ) )
        update_post_meta( $post_id, '_metric_dimensions', esc_attr( $_metric_dimensions ) );

    // Text Field
    $_imperial_dimensions = $_POST['_imperial_dimensions'];
    if( !empty( $_imperial_dimensions ) )
        update_post_meta( $post_id, '_imperial_dimensions', esc_attr( $_imperial_dimensions ) );
        
}

/*
 * SRC: https://blog.webguysaz.com/2013/10/31/add-woocommerce-view-all-pagination-option-to-product-listings/
 */

add_filter('loop_shop_per_page', 'wg_view_all_products');

function wg_view_all_products(){

    if($_GET['view'] === 'all'){
        return '9999';
    }
}

// Position Yoast Seo at bottom of page after ACF
// Uncomment this if you want to enable it
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

?>
