<?php
/**
 * IMS theme functions
 *
 * @package WordPress
 * @subpackage IMS
 */

// Add page slug to body class
function butcher_add_slug_body_class( $classes ) {
    global $post;

    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }

    return $classes;
}
add_filter( 'body_class', 'butcher_add_slug_body_class' ); 

// Post ID from slug (needed for few page headers on single custom post type templates)
function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

// Custom admin login logo
function custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image: url('.get_bloginfo('template_directory').'/assets/img/logo-svg.svg) !important; background-size: auto !important; width: auto !important; height: 130px !important; }
	</style>';
}
add_action('login_head', 'custom_login_logo');

// Reduce auto P tag in CF7
add_filter('wpcf7_autop_or_not', '__return_false');

// Set a minimum order amount for checkout
add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' ); 
function wc_minimum_order_amount() {
    // Set this variable to specify a minimum order value
    $minimum = get_field( 'minimum_order_amount', 'option' );

    if ( WC()->cart->total < $minimum ) {
        if( is_cart() ) {
            wc_print_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order ' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );
        } else {
            wc_add_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );
        }
    }
}