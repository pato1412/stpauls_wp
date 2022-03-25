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
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<?php $page_id = smarty_page_id(); ?>
<?php if ( get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>
    <h1><?php the_title(); ?></h1>
<?php endif; ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
			    <th class="product-name"><?php esc_html_e( 'Product name', 'smarty' ); ?></th>
			    <th class="product-price"><?php esc_html_e( 'Price', 'smarty' ); ?></th>
			    <th class="product-quantity"><?php esc_html_e( 'Quantity', 'smarty' ); ?></th>
			    <th class="product-subtotal"><?php esc_html_e( 'Total', 'smarty' ); ?></th>
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
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'smarty' ); ?>">
						<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo smarty_sanitize_text_field($thumbnail);
								} else {
									printf( '<a href="%s" class="product-thumbnail">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
								}
							?>
						<div class="product-name-title">
                            <div class="hidden woocommerce_product__category">
                                <?php echo smarty_sanitize_text_field($cat_name = get_the_term_list( $product_id, 'product_cat', '', ', ')); ?>
                            </div>
							<?php
								if ( ! $product_permalink ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
								} else {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ) ), $cart_item, $cart_item_key );
								}

                            // Meta data.
                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'smarty' ) . '</p>';
								}
							?>

							<?php if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) : ?>
									<?php
										$rating_count = $_product->get_rating_count();
										$review_count = $_product->get_review_count();
										$average      = $_product->get_average_rating();
									?>

									<?php if ( $rating_count > 0 ) : ?>
										<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'smarty' ), $average ); ?>">
											<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
												<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'smarty' ), '<span itemprop="bestRating">', '</span>' ); ?>
												<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'smarty' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
											</span>
											</div>
											<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'smarty' ), '<span itemprop="reviewCount" class="count">' . $review_count . '</span>' ); ?>)</a><?php endif ?>
										</div>
									<?php endif; ?>
							<?php endif; ?>
						</div>
					</td>

					<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'smarty' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'smarty' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $_product->get_max_purchase_quantity(),
								'min_value'    => '0',
								'product_name' => $_product->get_name(),
							), $_product, false );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
                    </td>

                    <td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'smarty' ); ?>">
                        <?php
                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                        ?>
                    </td>

                    <td class="product-remove">
                        <?php
                        // @codingStandardsIgnoreLine
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="stm-icon stm-icon-times-thin"></i></a>',
                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                            __( 'Remove this item', 'smarty' ),
                            esc_attr( $product_id ),
                            esc_attr( $_product->get_sku() )
                        ), $cart_item_key );
                        ?>
                    </td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
						<label for="coupon_code"><?php esc_html_e( 'Coupon', 'smarty' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'smarty' ); ?>" /> <button type="submit" class="stm-btn stm-btn_outline stm-btn_blue stm-btn_md" name="apply_coupon" value="1"><?php esc_html_e( 'Apply Coupon', 'smarty' ); ?></button>
						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				<?php } ?>

				    <button type="submit" class="wc-cart-update button stm-btn stm-btn_outline stm-btn_blue stm-btn_md stm-btn_icon-left" name="update_cart" value="1"><i class="fa fa-refresh"></i><?php esc_html_e( 'Update Cart', 'smarty' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
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
