<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row" id="customer_login">

	<div class="col-sm-6 col-xs-12">

		<form method="post" class="login">

			<h3><?php esc_html_e( 'Login', 'smarty' ); ?></h3>

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<div class="form-row form-row-wide">
				<input type="text" class="input-text" name="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="<?php esc_attr_e( 'Username or email address', 'smarty' ); ?> *" />
			</div>
			<div class="form-row form-row-wide">
				<input class="input-text" type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password', 'smarty' ); ?> *" />
			</div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<div class="wc-login-group">
					<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'smarty' ); ?></a>
					<div class="wc-remember-me inline">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
						<label for="rememberme"><?php esc_html_e( 'Remember me', 'smarty' ); ?></label>
					</div>
				</div>
				<button type="submit" class="stm-btn stm-btn_outline stm-btn_md stm-btn_blue stm-btn_icon-right" name="login" value="1"><?php esc_html_e( 'Login', 'smarty' ); ?><i class="stm-icon stm-icon-arrow-right"></i></button>
			</div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div class="col-sm-6 col-xs-12">

		<form method="post" class="register">

			<h3><?php esc_html_e( 'Register', 'smarty' ); ?></h3>

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<div class="form-row form-row-wide">
					<input type="text" class="input-text" name="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="<?php esc_attr_e( 'Username', 'smarty' ); ?> *" />
				</div>

			<?php endif; ?>

			<div class="form-row form-row-wide">
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" placeholder="<?php esc_attr_e( 'Email address', 'smarty' ); ?> *" />
			</div>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<div class="form-row form-row-wide">
					<input type="password" class="input-text" name="password" id="reg_password" placeholder="<?php esc_attr_e( 'Password', 'smarty' ); ?> *" />
				</div>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'smarty' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<div class="form-row">
				<?php wp_nonce_field( 'woocommerce-register' ); ?>
				<button type="submit" class="stm-btn stm-btn_outline stm-btn_blue stm-btn_md stm-btn_icon-right" name="register" value="1"><?php esc_html_e( 'Register', 'smarty' ); ?><i class="stm-icon stm-icon-arrow-right"></i></button>
			</div>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
