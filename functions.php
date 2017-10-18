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

/*
 * Declare support for Woocommerce
 */

add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

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
 * Prevent WordPress reducing Image quality
**/ 
// add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );


/**
 * Add Markup Schema to WP Nav
 *
 * Source: http://wordpress.stackexchange.com/questions/203414/add-itemprop-schema-org-markup-to-li-elements-in-wp-nav-menu
**/

function add_menu_atts( $atts, $item, $args ) {
  $atts['itemprop'] = 'url';
  return $atts;
}

/** Disable All WooCommerce  Styles and Scripts Except Shop Pages*/
// add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_styles_scripts', 99 );

function dequeue_woocommerce_styles_scripts() {

    if ( function_exists( 'is_woocommerce' ) ) {
        
        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
            
            # Styles
            // wp_dequeue_style( 'woocommerce-general' );
            // wp_dequeue_style( 'woocommerce-layout' );
            // wp_dequeue_style( 'woocommerce-smallscreen' );
            // wp_dequeue_style( 'woocommerce_frontend_styles' );
            wp_dequeue_style( 'woocommerce_fancybox_styles' );
            // wp_dequeue_style( 'woocommerce_chosen_styles' );
            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

            # Scripts
            // wp_dequeue_script( 'wc_price_slider' );
            // wp_dequeue_script( 'wc-single-product' );
            // wp_dequeue_script( 'wc-add-to-cart' );
            // wp_dequeue_script( 'wc-cart-fragments' );
            // wp_dequeue_script( 'wc-checkout' );
            // wp_dequeue_script( 'wc-add-to-cart-variation' );
            // wp_dequeue_script( 'wc-single-product' );
            // wp_dequeue_script( 'wc-cart' );
            // wp_dequeue_script( 'wc-chosen' );
            // wp_dequeue_script( 'woocommerce' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'jquery-blockui' );
            wp_dequeue_script( 'jquery-placeholder' );
            wp_dequeue_script( 'fancybox' );
            wp_dequeue_script( 'jqueryui' );
        }
    }
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

function woo_related_products_limit() {
  global $product;
    
    $args['posts_per_page'] = 4;
    return $args;
}

function related_products_args( $args ) {

    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 4; // arranged in 4 columns

    return $args;
}



/*
 * This function outputs a line of text
 * either with a tick or a cross.
 * This is to help indicate the availability of a product.
 */

function wc_in_stock_func( $atts ) {

    global $product;
    
    if ( $product->get_stock_quantity() > 0 ) {

        echo '<div class="stock">
                <span class="stock__availability stock__availability--in"><i class="fa fa-check" aria-hidden="true"></i> '. __('In Stock', 'oakworld').'
                </span>
            </div>';

    } else {
       
        // echo '<div class="stock">
                    // <span class="stock__availability stock__availability--out"><i>X</i> '. __( 'Out of Stock', 'oakworld' ). '</span>
                // </div>';
        echo '';
    }
}


add_action( 'pre_get_posts', 'wpse223576_search_woocommerce_only' );

function wpse223576_search_woocommerce_only( $query ) {
  if( ! is_admin() && is_search() && $query->is_main_query() ) {
    $query->set( 'post_type', 'product' );
  }
}

/*
 * Create a shortcode to display the product SKU
 */

function inter_show_sku() {
 
    global $product;

    $sku = $product->get_sku();

    if( $sku == '' || !$sku ){ return; }

    echo '<p class="product-single__code info__small">'.__('Product Code', 'oakworld').': '.$sku.'</p>';
}

/**
 * Hide the "In stock" message on product page.
 *
 * @param string $html
 * @param string $text
 * @param WC_Product $product
 * @return string
 */
function my_wc_hide_in_stock_message( $availability, $_product ) {

    return "";
}

add_filter( 'woocommerce_get_availability', 'my_wc_hide_in_stock_message', 10, 3 );

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

add_action( 'init', function () {
    wp_oembed_add_provider( '/https?:\/\/(.+)?(wistia\.com|wi\.st)\/(medias|embed)\/.*/', 'http://fast.wistia.net/oembed', true );
});

/**
 * Remove the sort by newness option when sorting products
 * Options: menu_order, popularity, rating, date, price, price-desc
 **/
 
function wc_catalog_orderby( $orderby ) {
    unset($orderby["date"]);

    return $orderby;
}

add_filter( "woocommerce_catalog_orderby", "wc_catalog_orderby", 20 );


/**
 * Change the sale text that appears in the 
 * green circle on products that are on sale.
**/

function wc_custom_replace_sale_text( $html ) {

    $_product = wc_get_product( get_the_id() );

    $diff = $_product->get_regular_price() - $_product->get_sale_price();

    return str_replace( __( 'Sale!', 'oakworld' ), __( 'Save<br/>'.wc_price($diff), 'oakworld' ), $html );
}

add_filter( 'woocommerce_sale_flash', 'wc_custom_replace_sale_text' );



function woo_add_custom_shipping_fields() {

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

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_shipping_fields' );


function calculate_monthly_payment () {

    $product = wc_get_product(get_the_ID());
    $thePrice = $product->get_price(); //will give raw price

    $payment = number_format($thePrice * 0.029500558690308046665887436009 * 0.5, 2);
    $currency = get_woocommerce_currency_symbol();

    echo '<p class="product-finance">'.__('Finance from: ', 'oakworld').'<strong>'.$currency.'<span id="monthlyPayment-'.get_the_ID().'">'.$payment.'</span></strong>'. __(' per month*', 'oakworld').'</p>';
}

function woo_add_custom_shipping_fields_save( $post_id ){

    // Text Field
    $_metric_dimensions = $_POST['_metric_dimensions'];

    if( !empty( $_metric_dimensions ) ){

        update_post_meta( $post_id, '_metric_dimensions', esc_attr( $_metric_dimensions ) );
    }

    // Text Field
    $_imperial_dimensions = $_POST['_imperial_dimensions'];

    if( !empty( $_imperial_dimensions ) ){

        update_post_meta( $post_id, '_imperial_dimensions', esc_attr( $_imperial_dimensions ) );
    }       
}

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_shipping_fields_save' );

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

    if($_GET['view'] === 'all'){
        return '9999';
    }
}

// Position Yoast Seo at bottom of page after ACF
// Uncomment this if you want to enable it
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

/**
 * Rename WooCommerce "Brands" to "Ranges"
 *
 * @param array $args
 *
 * @return array
 */
add_filter( 'register_taxonomy_product_brand', 'woocomerce_brands_filter');

function woocomerce_brands_filter( $args ) {
    // Change the labels
    $args['label'] = __( 'Ranges', 'oakworld' );
    $args['rewrite']['slug'] = 'range'; // Replace 'custom-slug' with 
    $args['labels'] = array(
        'name'              => __( 'Ranges', 'oakworld' ),
        'singular_name'     => __( 'Range', 'oakworld' ),
        'search_items'      => __( 'Search Ranges', 'oakworld' ),
        'all_items'         => __( 'All Ranges', 'oakworld' ),
        'parent_item'       => __( 'Parent Range', 'oakworld' ),
        'parent_item_colon' => __( 'Parent Range:', 'oakworld' ),
        'edit_item'         => __( 'Edit Range', 'oakworld' ),
        'update_item'       => __( 'Update Range', 'oakworld' ),
        'add_new_item'      => __( 'Add New Range', 'oakworld' ),
        'new_item_name'     => __( 'New Range Name', 'oakworld' )
    );

    return $args;
}


/**
 * Show product weight on order form
 **/
add_action( 'woocommerce_after_order_itemmeta', 'show_fields_on_order_form', 10, 3 );

function show_fields_on_order_form( $item_id, $item, $product ){

    if( $item->get_type() != 'line_item' ) return;

    $weight = $product->get_weight();

    if( $weight != "" ){

        echo '<hr/>';
        echo '<div>'.__('Weight: ', 'oakworld'). $weight . get_option('woocommerce_weight_unit') .'</div>';
        echo '<hr/>';
    }
}


// 
//IMEGAMEDIA CHANGES 
//  

//RESTRICT Apply for Finance payment method to show only if order value over £300 

add_filter('woocommerce_available_payment_gateways','filter_gateways', 1);

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
         							   	 	
    <table style='width: 100%;' border='0'>        	
    <tr>        	
    <!--<td style='border-right: 0; vertical-align: middle !important; width:130px !important; padding:1px;'><img src='https://www.finance-calculator.co.uk/popuplogo.php?imegaid=$imegaID' style='max-width:100px !important;'/></td>-->
        	
    <td style='text-align: left !important;'><iframe id='calculatorFrame' src='https://www.finance-calculator.co.uk/fcalculator_top.php?imegaid=$imegaID&orderamount=$imegaprice' scrolling='no' frameborder='0' height='30px' style='width: 100%; vertical-align: inherit !important;'>You need a Frames Capable browser to view this content.</iframe> 
           	
    <a class='imegacalc action primary' data-fancybox-type='iframe' href='https://www.finance-calculator.co.uk/fcalculator.php?imegaid=$imegaID&orderamount=$imegaprice'>  	"); 	 	

    if($imegaprice >= $min_order && $imegaprice <= $max_order){ 
    	
        echo (" 	
        <img src='https://www.finance-calculator.co.uk/images/more.png' />       	
        ");

    }; 	 
     
    echo(" 	
    </a>        	
    </td>        	
    </tr>        	
    </table>        

    <br />            	
    <!-- imegamedia end --> 	"); 

};

// add_action( 'woocommerce_single_product_summary', 'action_woocommerce_after_add_to_cart_button', 31, 0 );   

add_action( 'woocommerce_after_add_to_cart_button', 'action_woocommerce_after_add_to_cart_button', 31, 0 );   

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
    <img src='https://www.finance-calculator.co.uk/images/more.png'/>       	
    "); }; 
    	 	
    echo(" 	
    </a>        	
    </td>        	
    </tr>        	
    </table>         
    <br />            	
    <!-- imegamedia end --> 	");

};  

add_action( 'woocommerce_after_cart_totals', 'action_woocommerce_after_cart', 10, 0 );

//SHOW finance application link on bacs page 
function action_woocommerce_thankyou_bacs($order_id){ 	
	
	$imegaID = '1565';  	
    $order 		= wc_get_order( $order_id ); 	
    $orderdesc = ""; 
		 	
$post_meta = get_post_meta($order->id , '_payment_method', true);
	
	$payment_method = $post_meta;
    //echo "<pre>".$payment_method."</pre>";
	
    foreach ($order->get_items() as $key => $lineItem) { 	
        $orderdesc.=$lineItem['name'].' (productid: '.$lineItem['product_id'].') '; 	
    }  	

    $orderdesc.=" TOTAL ORDER VALUE: £".$order->get_total(); 	
    $address=$order->get_address('billing'); 	
    $street = $address['address_1']; 	
    $housenum = substr($street, 0, strpos($street, ' '));  
	$orderid=  preg_replace("/[^0-9\.]/", "", $order->get_order_number());
     
    echo("<!-- imegamedia start --> 	
    <!-- JQUERY ONLY NEEDED IF NOT ALREADY CALLED IN YOUR TEMPLATE --> 
    <!--<script type='text/javascript' src='https://www.finance-calculator.co.uk/js/p4_pay/jquery-1.7.js'></script> --> 
    <script src='https://www.finance-calculator.co.uk/js/iframeResizer.min.js'></script> 
    	
    <script> 	   
        $(function () { 		   
            $('#calculatorFrame').iFrameResize({log:true}); 	   
        }); 	
    </script> 		 	

    <iframe id='calculatorFrame' src='https://www.finance-calculator.co.uk/fcheckout.php?imegaid=$imegaID&orderid=".$orderid."&orderamount=".$order->get_total()."&firstname=".$address['first_name']."&lastname=".$address['last_name']."&housenum=".$housenum."&street=".$address['address_1']."&postcode=".$address['postcode']."&email=".$address['email']."&telephone=".$address['phone']."&orderdesc=".$orderdesc."' style='width:100%; min-width:400px; height:600px;' scrolling='no' frameborder='0'>You need a Frames Capable browser to view this content.</iframe> 	

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

add_action( 'woocommerce_thankyou', 'bbloomer_add_content_thankyou' );
 
function bbloomer_add_content_thankyou($order_id) {
	
	$order 		= wc_get_order( $order_id );
	 
	$post_meta = get_post_meta($order->id , '_payment_method', true);
	$payment_method = $post_meta;
    //echo "<pre>".$payment_method."</pre>";
	
	if ($payment_method != 'bacs') {
		echo "
		<!-- CHECKOUT Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MBXFJH6');</script>
<!-- CHECKOUT End Google Tag Manager -->

		<!-- CHECKOUT Google Tag Manager (noscript) -->
<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-MBXFJH6'
height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
<!-- CHECKOUT End Google Tag Manager (noscript) -->";
	}
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
// Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
// Compatible with 3.0.1+, for lower versions, remove "woocommerce_" from the first mention on Line 4
add_filter('woocommerce_add_to_cart_fragments', 'woo_header_add_to_cart_fragment_desktop');
 
function woo_header_add_to_cart_fragment_desktop( $fragments ) {
    
    global $woocommerce;
    
    ob_start(); ?>

    <a class="cart-count btn btn--primary btn--small basket basket--primary" href="<?php echo WC()->cart->get_cart_url(); ?>"><i class=" fa fa-shopping-basket" aria-hidden="true"></i>
    (<?php echo  WC()->cart->get_cart_contents_count(); ?>)<span>
    <?php _e('BASKET', 'oakworld'); ?></span></a>
    <?php
    
    $fragments['a.cart-count'] = ob_get_clean();
    
    return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'woo_header_add_to_cart_fragment_mobile');

function woo_header_add_to_cart_fragment_mobile( $fragments ) {
    
    global $woocommerce;
    
    ob_start(); ?>

   <a class="mobile-cart-count" href="<?php echo WC()->cart->get_cart_url(); ?>">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        (<?php echo  WC()->cart->get_cart_contents_count(); ?>)
        <span class="icon__text">Basket</span>
    </a>
    <?php
    
    $fragments['a.mobile-cart-count'] = ob_get_clean();
    
    return $fragments;
}

function add_view_more_button () {

    echo '<a href="'.get_the_permalink().'" class="button view-more">'.
        __("View product", "oakworld").'
    </a>';
}

/**
 * Remove woocommerce hooks
 *
 * Use this for styling the WooCommerce templates.
 */

add_action('init','alter_woo_hooks');

function alter_woo_hooks (){

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    add_action( 'woocommerce_single_product_summary', 'wc_in_stock_func', 11 );

    /**
     * Product Loop
     **/
    add_action( 'woocommerce_after_shop_loop_item', 'calculate_monthly_payment', 6);

    add_action( 'woocommerce_after_shop_loop_item', 'add_view_more_button', 9);

    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 12);

    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_single_excerpt');

    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);

    
    

    /**
    * Single Product
    **/

    // add_action('woocommerce_single_product_summary', 'inter_show_sku', 6);

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);

    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

    add_filter( 'woocommerce_output_related_products_args', 'related_products_args' );
}

// add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_cart_button_text' );    // 2.1 +
 
function custom_cart_button_text() {
 
    return __( 'Add To Basket ', 'oakworld' ) .'<i class="fa fa-chevron-right" aria-hidden="true"></i>';
}

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
    return get_home_url();
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

// hide coupon field on checkout page
function hide_coupon_field_on_checkout( $enabled ) {
    
    if ( is_checkout() ) {
        $enabled = false;
    }
    return $enabled;
}

add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_checkout' );

/**
 * Remove query string from static files
 * 
 * SRC: https://wpvkp.com/wordpress-remove-query-string-css-javascript-js/
 **/

function remove_cssjs_ver( $src ) {
    
    if( strpos( $src, '?ver=' ) || strpos( $src, '?v=' ) || strpos( $src, '?version=' ) || strpos( $src, '?rev=' ) )
        $src = remove_query_arg( 'ver', $src );
        return $src;
}

add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

/**
 * Prevent Emojis from being loaded
 * 
 * SRC: https://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
 **/

add_action( 'init', 'disable_wp_emojicons' );

function disable_wp_emojicons() {

    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' ); 

    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

add_filter( 'emoji_svg_url', '__return_false' );


/**
 * ADD YITH CODE
 **/

add_filter('yith_wccos_add_all_custom_order_status_actions', '__return_true'); ?>