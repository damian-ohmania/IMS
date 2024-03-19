<?php
/**
 * IMS theme main setup process
 *
 * @package WordPress
 * @subpackage IMS  
 */

// Declaring WooCommerce support
function butcher_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'butcher_add_woocommerce_support' );

// Product Categories Dropdown
add_shortcode( 'product_categories_dropdown', 'shortcode_product_categories_dropdown' );
function shortcode_product_categories_dropdown ( $atts ) {
    ob_start();

    $term = get_queried_object();

    $children = get_terms( $term->taxonomy, array(
        'parent'    => $term->term_id,
        'hide_empty' => false
    ) );

    if ( $children ) :
        echo '<select name="product_cat" id="product_cat" class="dropdown_product_cat" tabindex="-1" aria-hidden="true">';

        echo '<option value="">All ' . $term->name . '</option>';

        foreach( $children as $subcat ) :
            echo '<option value="' . $subcat->slug . '">' . $subcat->name . '</option>';
        endforeach;

        echo '</select>';
    endif;

    return ob_get_clean();
}

// Removes Order Notes Title - Additional Information & Notes Field
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

// Remove Order Notes Field
add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );
function remove_order_notes( $fields ) {
     unset($fields['order']['order_comments']);

     return $fields;
}

// Remove Woocommerce Coupon Section from Checkout Page
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// Remove Downloads from My Account
add_filter( 'woocommerce_account_menu_items', 'ims_remove_downloads_my_account', 999 ); 
function ims_remove_downloads_my_account( $items ) {
    unset($items['downloads']);

    return $items;
}

// Remove cart item in mini cart
function remove_item_from_minicart() {
    // Get cart item key
    $cart_item_key = $_POST['cart_item_key'];

    // Remove cart item
    if( $cart_item_key ) :
       WC()->cart->remove_cart_item($cart_item_key);

       // Calculate cart totals again
       WC()->cart->calculate_totals();
    endif; 

    // New totals
    $minicart_total = number_format( WC()->cart->subtotal, 1 );

    echo $minicart_total;

    die();
}
add_action('wp_ajax_remove_item_from_minicart', 'remove_item_from_minicart');
add_action('wp_ajax_nopriv_remove_item_from_minicart', 'remove_item_from_minicart');

// Remove cart item in mini cart
function update_item_qty_in_minicart() {
    // Get cart item key
    $cart_item_key = $_POST['cart_item_key'];

    // Get new quantity
    $qty = $_POST['qty'];

    // Update cart item data
    if( $cart_item_key ) :
       // Change cart item quantity
       WC()->cart->set_quantity($cart_item_key, $qty);
       
       // Calculate cart totals again
       WC()->cart->calculate_totals();
    endif;

    // New totals
    $minicart_total = number_format( WC()->cart->subtotal, 2 );

    echo $minicart_total;

    die();
}
add_action('wp_ajax_update_item_qty_in_minicart', 'update_item_qty_in_minicart');
add_action('wp_ajax_nopriv_update_item_qty_in_minicart', 'update_item_qty_in_minicart');

// Free shippinh amount
function ims_free_shipping_cart_notice() {
    // Is it ajax call on cart update or page render
    $is_ajax = $_POST['is_ajax'];

    // Get cart amount for free shipping
    $free_shipping_settings = get_option('flexible_shipping_methods_4'); // was 'woocommerce_free_shipping_2_settings'
    $amount_for_free_shipping = $free_shipping_settings[1]['method_rules'][2]['min']; // was $free_shipping_settings['min_amount']
    
    // Current cart total
    $current = WC()->cart->subtotal;

    if ( $current < $amount_for_free_shipping ) :
        echo '<div class="cart-message uk-text-center uk-margin-bottom uk-margin-top">
                <span class="shipping-fee">Spend another <span class="shipping-limit">' . wc_price( $amount_for_free_shipping - $current ) . '</span> to get free delivery</span>
            </div>';
    else:
        echo '<div class="cart-message uk-text-center uk-margin-bottom uk-margin-top">
                <span class="shipping-fee">You have free shipping!</span>
            </div>';
    endif;
    
    if( $is_ajax ) :
        die();
    endif;
}
add_action('wp_ajax_ims_free_shipping_cart_notice', 'ims_free_shipping_cart_notice');
add_action('wp_ajax_nopriv_ims_free_shipping_cart_notice', 'ims_free_shipping_cart_notice');

// Change minicart total count
function change_minicart_total_count() {
    // New total count
    $minicart_total_count = WC()->cart->get_cart_contents_count();

    echo $minicart_total_count;

    die();
}
add_action('wp_ajax_change_minicart_total_count', 'change_minicart_total_count');
add_action('wp_ajax_nopriv_change_minicart_total_count', 'change_minicart_total_count');

// Remove the breadcrumbs from single product page
add_action( 'init', 'ims_remove_wc_breadcrumbs' );
function ims_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

// Remove tabs from single product page
add_filter( 'woocommerce_product_tabs', 'ims_remove_description_tab', 11 ); 
function ims_remove_description_tab( $tabs ) { 
    unset( $tabs['description'] );
    unset( $tabs['additional_information'] );
    unset( $tabs['reviews'] );
    
	return $tabs; 
}

// Modify the default WooCommerce orderby dropdown
// Options: menu_order, popularity, rating, date, price, price-desc
function ims_woocommerce_catalog_orderby( $orderby ) {
    unset($orderby["rating"]);
    unset($orderby["menu_order"]);
    $orderby["date"] = __('Sort by newest', 'woocommerce');
	return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "ims_woocommerce_catalog_orderby", 20 );

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
    $free = array();
    
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
    }
    
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );

add_filter ( 'woocommerce_account_menu_items', 'ims_rename_downloads' ); 
function ims_rename_downloads( $menu_links ){ 
	// $menu_links['TAB ID HERE'] = 'NEW TAB NAME HERE';
	$menu_links['customer-logout'] = 'Log Out';
 
	return $menu_links;
}

//Hide Price Range for WooCommerce Variable Products
add_filter( 'woocommerce_variable_sale_price_html', 'lw_variable_product_price', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'lw_variable_product_price', 10, 2 );
function lw_variable_product_price( $v_price, $v_product ) {
	// Product Price
	$prod_prices = array( $v_product->get_variation_price( 'min', true ), $v_product->get_variation_price( 'max', true ) );
	$prod_price = $prod_prices[0] !== $prod_prices[1] ? sprintf(__('From %1$s', 'woocommerce'), wc_price( $prod_prices[0] ) ) : wc_price( $prod_prices[0] );

	// Regular Price
	$regular_prices = array( $v_product->get_variation_regular_price( 'min', true ), $v_product->get_variation_regular_price( 'max', true ) );
	sort( $regular_prices );
	$regular_price = $regular_prices[0] !== $regular_prices[1] ? sprintf(__('From %1$s','woocommerce'), wc_price( $regular_prices[0] ) ) : wc_price( $regular_prices[0] );

	if ( $prod_price !== $regular_price ) {
		$prod_price = '<del>'.$regular_price.$v_product->get_price_suffix() . '</del> <ins>' . $prod_price . $v_product->get_price_suffix() . '</ins>';
	}
	
	return $prod_price;
}

// Add the field to the checkout
add_action( 'woocommerce_checkout_after_customer_details', 'custom_checkout_fields' );
function custom_checkout_fields($checkout) {
	$domain = 'woocommerce';
    $checkout = WC()->checkout;

    echo '<hr>'; 
   
    woocommerce_form_field('delivery_date', array(
        'label'         => __('Delivery Date', 'woocommerce'),
        'placeholder'   => _x('', 'placeholder', 'woocommerce'),
        'required'      => false,
        'class'         => array('checkout-delivery-date'),
        'clear'         => true,
        'type'          => 'hidden'
    ), $checkout->get_value('delivery_date'));
    
    echo '<hr>'; 
}

// Saving new checkout fields
add_action( 'woocommerce_checkout_update_order_meta', 'custom_checkout_fields_update_order_meta' );
function custom_checkout_fields_update_order_meta( $order_id ) {
	if ( ! empty( $_POST['delivery_date'] ) ) {
        update_post_meta( $order_id, 'Delivery Date', sanitize_text_field( $_POST['delivery_date'] ) );
    }
    
    if ( ! empty( $_POST['dpd_uk_delivery_instructions'] ) ) {
        update_post_meta( $order_id, 'Delivery Instructions', sanitize_text_field( $_POST['dpd_uk_delivery_instructions'] ) );
	}
}

// Display custom checkout field values on the order edit page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'custom_checkout_fields_display_admin_order_meta', 10, 1 );
function custom_checkout_fields_display_admin_order_meta( $order ) {
    echo '<h4>'.__('Delivery Details').'</h4>';

    $new_fields_display = '<p>';
    $new_fields_display .= '<strong>' . __( "Delivery Date:", "leclos" ) . ' </strong>' . get_post_meta( $order->id, 'Delivery Date', true ) . '<br>';
    $new_fields_display .= '<strong>' . __( "Delivery Instructions:", "leclos" ) . ' </strong>' . get_post_meta( $order->id, 'Delivery Instructions', true ) . '<br>';
    $new_fields_display .= '</p>';

	echo $new_fields_display;	
}

// Add a custom field (in an order) to the emails
add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );
function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['Delivery Date'] = array(
        'label' => __( 'Delivery Date' ),
        'value' => get_post_meta( $order->id, 'Delivery Date', true ),
    );

    $fields['Delivery Instructions'] = array(
        'label' => __( 'Delivery Instructions' ),
        'value' => get_post_meta( $order->id, 'Delivery Instructions', true ),
    );

    return $fields;
}