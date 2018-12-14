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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ( etheme_get_option('cart_special_breadcrumbs') ) : ?>
<div class="cart-checkout-nav">
<a href="<?php echo wc_get_cart_url(); ?>" class="active"> <?php esc_html_e('Shopping cart', 'xstore'); ?></a>

<span class="delimeter"> <?php echo etheme_get_cart_sep(); ?></span>

<a href="<?php echo wc_get_checkout_url(); ?>" class="active"> <?php esc_html_e('Checkout', 'xstore'); ?></a>

<span class="delimeter"><?php echo etheme_get_cart_sep(); ?></span>

<a href="#" class="no-click active"> <?php esc_html_e('Order complete', 'xstore'); ?></a>
</div>

<?php endif; ?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'xstore' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'xstore' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'xstore' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'xstore' ), $order ); ?></p>

			<div class="woocommerce-order-overview-wrapper">

				<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

					<li class="woocommerce-order-overview__order order">
						<?php esc_html_e( 'Order number:', 'xstore' ); ?>
						<strong><?php echo wp_kses_post($order->get_order_number()); ?></strong>
					</li>

					<li class="woocommerce-order-overview__date date">
						<?php esc_html_e( 'Date:', 'xstore' ); ?>
						<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
					</li>

					<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
						<li class="woocommerce-order-overview__email email">
							<?php esc_html_e( 'Email:', 'xstore' ); ?>
							<strong><?php echo wp_kses_post($order->get_billing_email()); ?></strong>
						</li>
					<?php endif; ?>

					<li class="woocommerce-order-overview__total total">
						<?php esc_html_e( 'Total:', 'xstore' ); ?>
						<strong><?php echo wp_kses_post($order->get_formatted_order_total()); ?></strong>
					</li>

					<?php if ( $order->get_payment_method_title() ) : ?>
						<li class="woocommerce-order-overview__payment-method method">
							<?php esc_html_e( 'Payment method:', 'xstore' ); ?>
							<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
						</li>
					<?php endif; ?>

				</ul>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'xstore' ), null ); ?></p>

	<?php endif; ?>

</div>