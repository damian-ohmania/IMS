<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<ul class="uk-breadcrumb">
	<li><a href="shop/">Shop</a></li>
	<li><span>Cart</span></li>
</ul>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-thumbnail uk-table-expand">&nbsp;</th>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
				<th class="product-remove">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-thumbnail uk-table-expand">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">
						    <?php
                                if ( $_product->is_sold_individually() ) {
                                    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                } else {
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
                                }

                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						    ?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>

						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

            <?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="uk-section-default uk-preserve-color uk-padding-small">
							<div class="uk-flex-middle" uk-grid>
								<div class="uk-width-1-2@l uk-width-2-3@m uk-text-left">
									<!-- <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> -->
									<input type="text" name="coupon_code" class="input-text uk-margin-right uk-margin-small-top uk-margin-small-bottom uk-button uk-button-date" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Discount code', 'woocommerce' ); ?>" />
									 
									<button type="submit" class="uk-button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply Code', 'woocommerce' ); ?></button>
								</div>

								<div class="uk-width-1-3@m uk-text-right@m">
									<p>Order total <strong class="uk-margin-left"><?php wc_cart_totals_order_total_html(); ?></strong></p>
								</div>
							</div>
						</div>
					<?php } ?>

					<button type="submit" class="uk-button uk-hidden" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<tr>
				<td colspan="6">
					<div class="cart-notice uk-section-primary uk-preserve-color uk-text-center uk-padding-small">
						<?php echo ims_free_shipping_cart_notice(); ?>
					</div>
				</td>
			</tr>

			<tr>
				<td id="delivery-details" class="uk-padding-remove-top uk-padding-remove-bottom" colspan="6">
					<div class="uk-section-secondary uk-preserve-color uk-padding-small uk-margin-small-bottom">
						<div class="uk-flex-right uk-grid-small" uk-grid>
                            <div class="uk-width-1-2@m">
                                <div class="uk-flex uk-text-left" uk-margin>
                                    <img class="uk-margin-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/date.png">

                                    <div class="uk-margin-right">
                                        <h6 class="uk-margin-right">Select Delivery option</h6>

                                        <div class="uk-grid-small uk-child-width-auto uk-grid-small" uk-grid>
                                            <label><input id="delivery-standard" class="uk-radio" type="radio" name="radio2" data-element="delivery-option-standard"> Standard delivery 3-4 days</label>

                                            <label><input id="delivery-calendar" class="uk-radio" type="radio" name="radio2" data-element="delivery-option-calendar"> Choose my delivery date</label>
                                        </div>
                                    </div>
                                </div>
							</div>

							<div class="uk-width-1-2@m">
                                <div id="delivery-option-standard">
                                    <div class="uk-text-left uk-grid-small" uk-grid>
                                        <div class="uk-width-1-3@s">
                                            <h6 class="uk-margin-right">Delivery Date</h6>

                                            <small>Please choose delivery date to proceed</small>
                                        </div>
                                        
                                        <div class="uk-width-2-3@s">
                                            <input type="text" id="standard-delivery-date" value="Within 3-4 business days" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div id="delivery-option-calendar" style="display: none;">
                                    <div class="uk-text-left uk-grid-small" uk-grid>
                                        <div class="uk-width-1-3@s">
                                            <h6 class="uk-margin-right">Delivery Date</h6>

                                            <small>Please choose delivery date to proceed</small>
                                        </div>
                                        
                                        <div class="uk-width-2-3@s">
                                            <input type="text" id="delivery-date" data-position="bottom left" data-language="en" placeholder="Select date...">
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>

                        <div>
                            <hr>

                            <p><small>* Saturday and Sunday deliveries are currently unavailable.</small></p>
                        </div>
					</div>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
