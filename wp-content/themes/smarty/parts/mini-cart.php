<?php if ( class_exists( 'WooCommerce' ) ): ?>
<div class="shopping-cart shopping-cart_small stm-border_color_green">
	<a href="<?php echo  wc_get_cart_url(); ?>" class="shopping-cart__link">
	<div class="shopping-cart__content">
		<div class="shopping-cart__left stm-font_color_green"><i class="stm-icon stm-icon-basket"></i></div>
		<div class="shopping-cart__body">
			<h6 class="shopping-cart__title"><?php esc_html_e('Shopping cart', 'smarty'); ?></h6>
			<div class="shopping-cart__products">
			<?php if ( ! WC()->cart->is_empty() ) : ?>
				<?php echo sprintf (_n( '%d product for', '%d products for', WC()->cart->get_cart_contents_count(), 'smarty' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?>
			<?php else : ?>
				<?php esc_html_e( 'No products in the cart.', 'smarty' ); ?>
			<?php endif; ?>
			</div>
            <?php if ( smarty_get_layout_mode() === 'kindergarten' ) : ?>
                <?php if ( ! WC()->cart->is_empty() ) : ?>
                    <div class="shopping-cart__products shopping-cart__product"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'smarty' ), WC()->cart->get_cart_contents_count() ); ?></div>
                <?php else : ?>

                <?php endif; ?>
            <?php endif; ?>
		</div>
	</div>
	</a>
</div>
<?php endif; ?>