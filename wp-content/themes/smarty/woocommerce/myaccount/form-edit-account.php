<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
<div class="row">
<div class="col-sm-6 col-xs-12">
    <h4><?php esc_html_e( 'Personal Information', 'smarty' ); ?></h4>
	<p class="form-row">
		<input type="text" class="input-text" name="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" placeholder="<?php esc_attr_e( 'First name', 'smarty' ); ?> *" />
	</p>
	<p class="form-row">
		<input type="text" class="input-text" name="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" placeholder="<?php esc_attr_e( 'Last name', 'smarty' ); ?> *" />
	</p>
	<p class="form-row form-row-wide">
		<input type="email" class="input-text" name="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" placeholder="<?php esc_attr_e( 'Email address', 'smarty' ); ?> *" />
	</p>
</div>
<div class="col-sm-6 col-xs-12">
	<h4><?php esc_html_e( 'Password Change', 'smarty' ); ?></h4>

	<fieldset>
		<p class="form-row form-row-wide">
			<input type="password" class="input-text" name="password_current" placeholder="<?php esc_attr_e( 'Current Password (leave blank to leave unchanged)', 'smarty' ); ?>" />
		</p>
		<p class="form-row form-row-wide">
			<input type="password" class="input-text" name="password_1" placeholder="<?php esc_attr_e( 'New Password (leave blank to leave unchanged)', 'smarty' ); ?>" />
		</p>
		<p class="form-row form-row-wide">
			<input type="password" class="input-text" name="password_2" placeholder="<?php esc_attr_e( 'Confirm New Password', 'smarty' ); ?>" />
		</p>
	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p class="text-right">
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="stm-btn stm-btn_outline stm-btn_blue stm-btn_md" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'smarty' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p>
</div>
</div>
	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
