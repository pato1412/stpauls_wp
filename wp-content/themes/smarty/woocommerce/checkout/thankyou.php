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
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

	<?php if ( $order ) :

        do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-thankyou-order-failed"><i class="fa fa-exclamation-triangle"></i><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'smarty' ); ?></p>

		<p class="woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'smarty' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My Account', 'smarty' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p class="woocommerce-thankyou-order-received"><i class="fa fa-check-circle"></i><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'smarty' ), $order ); ?></p>

            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                <li class="woocommerce-order-overview__order order">
                    <?php _e( 'Order number:', 'smarty' ); ?>
                    <strong><?php echo wp_kses_post($order->get_order_number()); ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    <?php _e( 'Date:', 'smarty' ); ?>
                    <strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
                </li>

                <li class="woocommerce-order-overview__total total">
                    <?php _e( 'Total:', 'smarty' ); ?>
                    <strong><?php echo wp_kses_post($order->get_formatted_order_total()); ?></strong>
                </li>

                <?php if ( $order->get_payment_method_title() ) : ?>

                    <li class="woocommerce-order-overview__payment-method method">
                        <?php _e( 'Payment method:', 'smarty' ); ?>
                        <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                    </li>

                <?php endif; ?>

            </ul>

	<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'smarty' ), null ); ?></p>

<?php endif; ?>