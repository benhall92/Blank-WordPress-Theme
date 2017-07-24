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

    if( !isset($_GET['view']) ){
        return;
    }

    if($_GET['view'] === 'all'){
        return '9999';
    }else{
        return '12';
    }
}

// Position Yoast Seo at bottom of page after ACF
// Uncomment this if you want to enable it
add_filter( 'wpseo_metabox_prio', function() { return 'low';});



// 
//IMEGAMEDIA CHANGES 
//  

//RESTRICT Apply for Finance payment method to show only if order value over £300 

add_filter('woocommerce_available_payment_gateways','filter_gateways',1); 
function filter_gateways($gateways){     
global $woocommerce;     
$min_cart_total = 300; 

// removed  $woocommerce->cart->get_total() 
$cart_total = floatval( preg_replace( '#[^\d.]#', '', WC()->cart->total ) ); 	 	 	 

if ($cart_total < $min_cart_total){ 		 		
if($cart_total > 0) unset($gateways['bacs']); 	 	
}     	   

return $gateways;   
}     

//SHOW finance calculator on product page  
function action_woocommerce_after_add_to_cart_button(  ) { 	 	

global $product; 	
$imegaprice=$product->get_price(); 	 	
$imegaID = '1565'; 	
$min_order = 300; 	
$max_order = 15000; 	 	

echo("<!-- imegamedia start -->   					 	 	

<!-- JQUERY ONLY NEEDED IF NOT ALREADY CALLED IN YOUR TEMPLATE  -->       	
<!--<script type='text/javascript' src='https://www.finance-calculator.co.uk/js/p4_pay/jquery-1.7.js'></script> -->      
<link rel='stylesheet' href='https://www.finance-calculator.co.uk/js/fancybox/source/jquery.fancybox.css?v=2.1.5' type='text/css' media='screen' />         	
<script type='text/javascript' src='https://www.finance-calculator.co.uk/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5'></script>  	  	                 

<script>   	 		   		 	
jQuery(function ($) { 			   		 				   
$('.imegacalc').fancybox({width:475,height:600}); 		   		 	
}); 	  	   	 	
</script>  
     							   	 	
<table style='width: 50% !important;' border='0'>        	
<tr>        	
<td style='vertical-align: middle !important; width:130px !important; padding:1px;'><img src='https://www.finance-calculator.co.uk/popuplogo.php?imegaid=$imegaID' style='max-width:100px !important;'/></td>  
    	
<td style='text-align: left !important;'><iframe id='calculatorFrame' src='https://www.finance-calculator.co.uk/fcalculator_top.php?imegaid=$imegaID&orderamount=$imegaprice' scrolling='no' frameborder='0' height='30px' style='vertical-align: inherit !important;'>You need a Frames Capable browser to view this content.</iframe> 
       	
<a class='imegacalc action primary' data-fancybox-type='iframe' href='https://www.finance-calculator.co.uk/fcalculator.php?imegaid=$imegaID&orderamount=$imegaprice'>  	"); 	 	

if($imegaprice >= $min_order && $imegaprice <= $max_order){ 
	
echo (" 	
<img src='https://www.finance-calculator.co.uk/images/more.png' style='padding-left:10px'/>       	
"); }; 	 

 
echo(" 	
</a>        	
</td>        	
</tr>        	
</table>        

<br />            	
<!-- imegamedia end --> 	");  };  

add_action( 'woocommerce_after_add_to_cart_button', 'action_woocommerce_after_add_to_cart_button', 10, 0 );   

//SHOW finance calculator on shopping cart 
function action_woocommerce_after_cart(  ) {  	 	

$imegaID = '1565'; 	
$min_order = 300; 	
$max_order = 15000; 	 	

echo("<!-- imegamedia start -->   						 	 	
<!-- JQUERY ONLY NEEDED IF NOT ALREADY CALLED IN YOUR TEMPLATE  -->       	
<!--<script type='text/javascript' src='https://www.finance-calculator.co.uk/js/p4_pay/jquery-1.7.js'></script>-->       
<link rel='stylesheet' href='https://www.finance-calculator.co.uk/js/fancybox/source/jquery.fancybox.css?v=2.1.5' type='text/css' media='screen' />         	
<script type='text/javascript' src='https://www.finance-calculator.co.uk/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5'></script>  	  	                 

<script>   	 		   		 	
jQuery(function ($) { 			   		 				  
$('.imegacalc').fancybox({width:475,height:600}); 		   		 	
}); 	  	   	 
</script>       							   	 	
<table style='width: 80% !important' border='0'>        	
<tr>        	
<td style='vertical-align: middle !important;width:130px !important; padding:1px;'><img src='https://www.finance-calculator.co.uk/popuplogo.php?imegaid=$imegaID' style='max-width:100px !important;'/></td>      	
<td><iframe id='calculatorFrame' src='https://www.finance-calculator.co.uk/fcalculator_top.php?imegaid=$imegaID&orderamount=".WC()->cart->total."' scrolling='no' frameborder='0' height='30px'>You need a Frames Capable browser to view this content.</iframe>        	
<a class='imegacalc action primary' data-fancybox-type='iframe' href='https://www.finance-calculator.co.uk/fcalculator.php?imegaid=$imegaID&orderamount=".WC()->cart->total."'> "); 	 	

if(WC()->cart->total >= $min_order && WC()->cart->total <= $max_order){ 	
echo (" 	
<img src='https://www.finance-calculator.co.uk/images/more.png' style='padding-left:10px'/>       	
"); }; 
	 	
echo(" 	
</a>        	
</td>        	
</tr>        	
</table>         
<br />            	
<!-- imegamedia end --> 	"); };  

add_action( 'woocommerce_after_cart_totals', 'action_woocommerce_after_cart', 10, 0 );



//SHOW finance application link on bacs page 
function action_woocommerce_thankyou_bacs($order_id){ 	
	
	$imegaID = '1565';  	

$order 		= wc_get_order( $order_id ); 	
$orderdesc = ""; 	 	

foreach ($order->get_items() as $key => $lineItem) { 	
$orderdesc.=$lineItem['name'].' (productid: '.$lineItem['product_id'].') '; 	
}  	

$orderdesc.=" TOTAL ORDER VALUE: £".$order->get_total(); 	
$address=$order->get_address('billing'); 	
$street = $address['address_1']; 	
$housenum = substr($street, 0, strpos($street, ' '));   



 
echo("<!-- imegamedia start --> 	
<!-- JQUERY ONLY NEEDED IF NOT ALREADY CALLED IN YOUR TEMPLATE --> 
<!--<script type='text/javascript' src='https://www.finance-calculator.co.uk/js/p4_pay/jquery-1.7.js'></script> --> 
<script src='https://www.finance-calculator.co.uk/js/iframeResizer.min.js'></script> 
	
<script> 	   
$(function () { 		   
$('#calculatorFrame').iFrameResize({log:true}); 	   
}); 	
</script> 		 	

<iframe id='calculatorFrame' src='https://www.finance-calculator.co.uk/fcheckout.php?imegaid=$imegaID&orderid=".$order->get_order_number()."&orderamount=".$order->get_total()."&firstname=".$address['first_name']."&lastname=".$address['last_name']."&housenum=".$housenum."&street=".$address['address_1']."&postcode=".$address['postcode']."&email=".$address['email']."&telephone=".$address['phone']."&orderdesc=".$orderdesc."' style='width:100%; min-width:400px; height:600px;' scrolling='no' frameborder='0'>You need a Frames Capable browser to view this content.</iframe> 	

<!-- imegamedia end -->");	  

} 

add_action('woocommerce_thankyou_bacs','action_woocommerce_thankyou_bacs',10,1);

//REMOVE heading showing bank details
function action_woocommerce_bacs_accounts($order_id ){	
}
add_action('woocommerce_bacs_accounts','action_woocommerce_bacs_accounts',10,1);

// Change the bacs icon 
add_filter('woocommerce_bacs_icon', 'custom_woocommerce_bacs_icon');

function custom_woocommerce_bacs_icon( $url ) {
 	$url = "https://www.finance-calculator.co.uk/images/pay4later_cc.gif";
 	return $url;
}


?>
