<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

			<p class="form-row form-row-first">
				<input type="text" class="input-text" name="username" placeholder="<?php esc_attr_e( 'Username or email', 'smarty' ); ?> *" />
			</p>
			<p class="form-row form-row-last">
				<input class="input-text" type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password', 'smarty' ); ?> *" />
			</p>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'smarty' ); ?></a>
				<label for="rememberme" class="wc-remember-me inline">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'smarty' ); ?>
				</label>
				<button type="submit" class="stm-btn stm-btn_outline stm-btn_md stm-btn_blue stm-btn_icon-right" name="login" value="1"><?php esc_html_e( 'Login', 'smarty' ); ?><i class="stm-icon stm-icon-arrow-right"></i></button>
				<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			</p>

			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</div>
	</div>
</form>
