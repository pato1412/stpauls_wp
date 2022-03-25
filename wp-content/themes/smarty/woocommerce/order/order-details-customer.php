<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</div>
<div class="col-sm-6 col-xs-12">
	<header><h3><?php esc_html_e( 'Customer Details', 'smarty' ); ?></h3></header>

	<table class="woocommerce-table woocommerce-table--customer-details shop_table customer_details">

		<?php if ( $order->get_customer_note() ) : ?>
			<tr>
				<th><?php esc_html_e( 'Note:', 'smarty' ); ?></th>
				<td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->get_billing_email() ) : ?>
			<tr>
				<th><?php esc_html_e( 'Email:', 'smarty' ); ?></th>
				<td><?php echo esc_html( $order->get_billing_email() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->get_billing_phone() ) : ?>
			<tr>
				<th><?php esc_html_e( 'Telephone:', 'smarty' ); ?></th>
				<td><?php echo esc_html( $order->get_billing_phone() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
	</table>
</div><!-- /.col-sm-6.col-xs-12 -->
</div><!-- /.row -->

<div class="row addresses-order">

	<div class="col-sm-6 col-xs-12">
		<div class="address">
			<header class="title">
				<h4><?php esc_html_e( 'Billing Address', 'smarty' ); ?></h4>
			</header>
			<address>
				<?php echo ( esc_html($address = $order->get_formatted_billing_address()) ) ? $address : esc_html__( 'N/A', 'smarty' ); ?>
			</address>
		</div>
	</div><!-- /.col-sm.col-xs-12 -->

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

		<div class="col-sm-6 col-xs-12">
			<div class="address">
				<header class="title">
					<h4><?php esc_html_e( 'Shipping Address', 'smarty' ); ?></h4>
				</header>
				<address>
					<?php echo ( esc_html($address = $order->get_formatted_billing_address()) ) ? $address : esc_html__( 'N/A', 'smarty' ); ?>
				</address>
			</div>
		</div><!-- /.col-sm.col-xs-12 -->

	<?php endif; ?>

</div><!-- /.row -->
