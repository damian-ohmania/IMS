<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Order Received', 'woocommerce' ); ?></h2>
			
			<h4 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you – Your meat is on its way!', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h4>

			<p><?php esc_html_e( 'Your order has been received.', 'woocommerce' ); ?></p>

            <hr>

            <div class="product-box">
                <p><?php esc_html_e( 'Order Reference Number:', 'woocommerce' ); ?> <span><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></p>
                <p><?php esc_html_e( 'Delivery Date:', 'woocommerce' ); ?> <span><?php echo get_post_meta( $order->get_id(), 'Delivery Date', true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></p>
				<?php if ( $order->get_payment_method_title() ) : ?>
                	<p><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?> <span><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span></p>
				<?php endif; ?>
                <p class="total uk-margin-remove"><?php esc_html_e( 'Total:', 'woocommerce' ); ?> <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong> </p>
            </div>

            <hr>

            <div class="uk-width-2-3@m">
				<p><?php esc_html_e( 'If you have any further questions do not hesitate to contact us on 020 7383 3080 or email sales@imsofsmithfield.com quoting your order reference number.', 'woocommerce' ); ?></p>
				<p><?php esc_html_e( 'Our lines are open 8am to 4.30pm, Monday to Friday.', 'woocommerce' ); ?></p>
            </div>

            <div class="uk-margin-medium-top">
                <h4><?php esc_html_e( 'Storing your meat', 'woocommerce' ); ?></h4>
                <p><?php esc_html_e( 'View our advice on storing your meat correctly.', 'woocommerce' ); ?></p>
                <a href="/delivery-storage/" class="uk-button uk-button-default"><?php esc_html_e( 'Meat Storage Guidelines', 'woocommerce' ); ?></a>
            </div>

		<?php endif; ?>


	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you – Your meat is on its way!', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
