<?php
/**
 * IMS header part
 *
 * @package WordPress
 * @subpackage IMS
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head profile="http://www.w3.org/1999/xhtml/vocab"> 
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta http-equiv="cleartype" content="on">		
		<meta name="google-site-verification" content="VKH27vD6rn2IISjE4H3k_JmRxOcG-oQCgaTLE_xHn2k" />
        <meta name="google-site-verification" content="qypQ5EOwUgon2ykjRDpL_pN4wEjuF29bzLYFwndq6o0" />

        <!-- Hotjar Tracking Code for https://imsofsmithfield.com/ --> <script> (function(h,o,t,j,a,r){ h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)}; h._hjSettings={hjid:2321909,hjsv:6}; a=o.getElementsByTagName('head')[0]; r=o.createElement('script');r.async=1; r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv; a.appendChild(r); })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv='); </script>
		<script>
		  !function(f,b,e,v,n,t,s)
		  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		  n.queue=[];t=b.createElement(e);t.async=!0;
		  t.src=v;s=b.getElementsByTagName(e)[0];
		  s.parentNode.insertBefore(t,s)}(window, document,'script',
		  'https://connect.facebook.net/en_US/fbevents.js');
		  fbq('init', '2245900165716796');
		  fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		  src="https://www.facebook.com/tr?id=2245900165716796&ev=PageView&noscript=1"
		/></noscript>

		<!-- End Facebook Pixel Code -->

		<!-- HumCommerce Tracking code for IMS Of Smithfield -->
		<script type="text/javascript">
		  var _ha = window._ha || [];
			_ha.push(['trackPageView']);
		  _ha.push(['enableLinkTracking']);
		  (function() {
			var u="https://app.humcommerce.com/";
			_ha.push(['setTrackerUrl', u+'humdash.php']);
			_ha.push(['setSiteId', '3694']);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'sites/h-3694.js'; s.parentNode.insertBefore(g,s);
		  })();
		</script>
		<!-- End of HumCommerce Code -->

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-M28JHQC');</script>
		<!-- End Google Tag Manager -->
		
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/MuseoSlab-700.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/MuseoSlab-500.woff2" as="font" type="font/woff2" crossorigin>
		
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M28JHQC"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
        <!-- Top Header
        ============================================= -->
        <div class="top-header uk-section-default">
            <div class="uk-container">
                <div uk-navbar>
                    <div class="uk-navbar-left"> 
                        <a class="uk-navbar-toggle search-btn uk-padding-remove uk-visible@s" href="#modal-search" uk-toggle><span class="uk-margin-small-right" uk-search-icon></span> Search</a>
                        <a class="uk-navbar-toggle search-btn uk-padding-remove uk-hidden@s" href="#modal-search" uk-toggle><span class="uk-margin-small-right" uk-search-icon></span></a>
                    </div>

                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav">
                            <li><a href="<?php the_field('trade_customers_page_link', 'option'); ?>">Trade Customers</a></li>

                            <!-- User Account -->
                            <?php if ( is_user_logged_in() ) { ?>
                                <li class="uk-visible@s"><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="My Account">My Account</a></li>
                                <li class="uk-hidden@s"><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="My Account"><span uk-icon="user"></span></a></li>
                            <?php } else { ?>
                                <li class="uk-visible@s"><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="Sign In">Sign In</a></li>
                                <li class="uk-hidden@s"><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="Sign In"><span uk-icon="user"></span></a></li>
                            <?php } ?>    

                            <li>
                                <a class="drop-open" href=""><span class="uk-margin-small-right uk-hidden@s" uk-icon="cart"></span><span class="uk-visible@s"><?php _e( 'My Cart', 'butcher'); ?></span> (<?php echo WC()->cart->get_cart_contents_count(); ?>) </a>

                                <?php $max_products = 3; ?>

                                <div class="uk-hidden" uk-drop="mode: click; pos: bottom-right">
                                    <div class="cart-basket uk-section-secondary uk-preserve-color">
                                        <div class="cart-overlay uk-flex uk-flex-middle uk-flex-center uk-position-top-left uk-width-1-1 uk-height-1-1 uk-hidden">
                                            <img class="uk-preserve" src="<?php echo get_template_directory_uri(); ?>/assets/img/loading.svg" uk-svg>
                                        </div>

                                        <h4><?php _e( 'Cart', 'butcher' ); ?></h4>

                                        <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
                                            <!-- List of products in cart -->
                                            <div>
                                                <?php
                                                    $counter = 0;

                                                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                                                        // Show max number of last added products
                                                        if( $counter + $max_products >= sizeof( WC()->cart->get_cart() ) ):
                                                            // Get products data
                                                            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

                                                            // Only display if allowed
                                                            if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )  continue;

                                                            // Get price
                                                            $product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
                                                            $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key ); ?>
                                                            
                                                            <div class="minicart-item">
                                                                <h6 class="uk-margin-small-bottom"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></h6>

                                                                <div class="uk-flex uk-flex-middle uk-flex-between">
                                                                    <?php echo apply_filters( 'woocommerce_widget_cart_item_price', '<p><strong>' . __('', 'butcher') . $product_price . '</strong></p>', $cart_item, $cart_item_key ); ?>

                                                                    <div class="minicart-item-qty" data-cart-item-key=<?=$cart_item_key;?>>
                                                                        <?php
                                                                            if ( $_product->is_sold_individually() ) :
                                                                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                                            else:
                                                                                $product_quantity = woocommerce_quantity_input(
                                                                                    array(
                                                                                        // 'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                                        'input_name'   => $cart_item_key,
                                                                                        'input_value'  => $cart_item['quantity'],
                                                                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                                                                        'min_value'    => '0',
                                                                                        'product_name' => $_product->get_name(),
                                                                                    ),
                                                                                    $_product,
                                                                                    false
                                                                                );
                                                                            endif;

                                                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                                                        ?>
                                                                    </div>

                                                                    <a class="remove-item" data-cart-item-key="<?=$cart_item_key;?>">
                                                                        <img class="uk-preserve-width" src="<?php echo get_template_directory_uri(); ?>/assets/img/close.svg">
                                                                    </a>
                                                                </div>

                                                                <hr>
                                                            </div>
                                                        <?php endif;

                                                        $counter++; 
                                                    endforeach; ?>
                                            </div><!-- .butcher-minicart-top-products end -->
                                        <?php else : ?>
                                            <!-- Cart is empty -->
                                            <p class="butcher-mini-cart-product-empty"><?php _e( 'No products in the cart. Please add some products first.', 'butcher' ); ?></p>
                                        <?php endif; ?>
                                            
                                        <!-- Cart Totals and Actions (go to Cart or Checkout) -->
                                        <?php if (sizeof( WC()->cart->get_cart()) > 0) : ?>
                                            <div id="minicart-totals" class="uk-flex uk-flex-middle uk-flex-between uk-margin-medium-bottom">
                                                <h6><?php _e( 'Order Total', 'butcher' ); ?></h6>

                                                <p><strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong></p>
                                            </div>
                                            
                                            <div class="shipping-cart-notice">
                                                <?php echo ims_free_shipping_cart_notice(); ?>
                                            </div>
                                            
                                            <?php if ( sizeof( WC()->cart->get_cart() ) > 3 ) : ?>
                                                <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="uk-button uk-button-primary uk-width-1-1">View All Items in Basket</a>
                                            <?php else: ?>
                                                <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="uk-button uk-button-primary">View Basket</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div> <!-- .butcher-minicart-top -->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Header
        ============================================= -->
        <header>
            <div class="uk-container">
                <div class="uk-flex uk-flex-between uk-flex-middle uk-flex-center@l">
                    <div>
                        <?php
                            // Get logos
                            $logo           = get_field('header_logo', 'option');
                            $offcanvasLogo  = get_field('offcanvas_logo', 'option');
                        ?>

                        <a class="uk-logo uk-visible@l uk-preserve" href="<?php echo site_url(); ?>/shop/"><img class="uk-preserve" src="<?php echo $logo['url']; ?>" title="<?php echo $logo['title']; ?>" alt="<?php echo $logo['alt']; ?>" height="95" width="100" uk-svg></a>

                        <a class="uk-logo uk-hidden@l" href="<?php echo site_url(); ?>/shop/"><img class="uk-preserve" src="<?php echo $offcanvasLogo['url']; ?>" title="<?php echo $offcanvasLogo['title']; ?>" alt="<?php echo $offcanvasLogo['alt']; ?>" height="60" width="100" uk-svg></a>
                    </div>
                    
                    <div class="uk-hidden@l">
                        <a class="uk-navbar-toggle uk-padding-remove offcanvas-btn" href="#offcanvas" uk-toggle><span uk-icon="icon: menu; ratio: 1.5"></span></a>
                    </div>
                </div>
            </div>

            <nav class="uk-navbar-container uk-navbar-transparent uk-margin-top uk-visible@l">
                <div class="uk-container">
                    <div uk-navbar>
                        <div class="uk-navbar-center">
                            <?php
                                // secondary navigation
                                if( has_nav_menu( 'secondary' ) ) :
                                    wp_nav_menu(array(
                                        'theme_location'    => 'secondary',
                                        'walker'            => new UIKit_Menu_Walker(),
                                        'items_wrap'        => '<ul class="uk-navbar-nav">%3$s</ul>'
                                    ));
                                endif;
                            ?> 
                        </div>
                    </div>
                </div>
            </nav>
        </header> <!-- Header end -->

        <?php include('partials/offcanvas-shop.php'); ?>

        <?php include('partials/search-modal.php'); ?> 