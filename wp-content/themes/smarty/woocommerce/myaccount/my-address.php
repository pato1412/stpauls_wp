<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', 'smarty' ),
		'shipping' => __( 'Shipping Address', 'smarty' )
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Billing Address', 'smarty' )
	), $customer_id );
}

$oldcol = 1;
$col    = 1;
?>

<p class="myaccount_address">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'smarty' ) ); ?>
</p>

<div class="row addresses">

	<?php foreach ( $get_addresses as $name => $title ) : ?>
		<div class="col-sm-6 col-xs-12">
			<div class="address">
				<header class="title">
					<h4><?php echo esc_html( $title ); ?></h4>
					<a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="stm-btn stm-btn_outline stm-btn_sm stm-btn_icon-left stm-btn_blue edit"><i class="fa fa-pencil-square-o"></i><?php esc_html_e( 'Edit', 'smarty' ); ?></a>
				</header>
				<?php
					$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
						'first_name'  => array(
							'label' => esc_html__('First Name', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_first_name', true ),
						),
						'last_name'   => array(
							'label' => esc_html__('Last Name', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_last_name', true )
						),
						'company'     => array(
							'label' => esc_html__('Company', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_company', true )
						),
						'address_1'   => array(
							'label' => esc_html__('Address 1', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_address_1', true )
						),
						'address_2'   => array(
							'label' => esc_html__('Address 2', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_address_2', true )
						),
						'city'        => array(
							'label' => esc_html__('City', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_city', true )
						),
						'state'       => array(
							'label' => esc_html__('State','smarty'),
							'val' => get_user_meta( $customer_id, $name . '_state', true )
						),
						'postcode'    => array(
							'label' => esc_html__('Postcode', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_postcode', true )
						),
						'country'     => array(
							'label' => esc_html__('Country', 'smarty'),
							'val' => get_user_meta( $customer_id, $name . '_country', true )
						)
					), $customer_id, $name );

				?>

				<?php if( !empty( $address ) ) : ?>
					<table class="wc-address-table">
						<?php foreach( $address as $address_val ) : ?>
							<?php if( !empty( $address_val['val'] ) ) : ?>
								<tr>
									<th><?php echo esc_html( $address_val['label'] ); ?></th>
									<td><?php echo esc_html( $address_val['val'] ); ?></td>
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</table>
				<?php else: ?>
					<?php esc_html_e( 'You have not set up this type of address yet.', 'smarty' ); ?>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>

</div>
