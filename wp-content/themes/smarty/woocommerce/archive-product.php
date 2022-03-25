<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' ); ?>

<?php get_template_part( 'parts/page', 'title' ); ?>
<?php get_template_part( 'parts/page', 'breadcrumbs' ); ?>
<?php
	$shop_sidebar = get_theme_mod('shop_sidebar', 'right');
	$content_layout = smarty_content_layout( $shop_sidebar );
?>
<div class="content<?php echo esc_attr( $content_layout['content_class'] ); ?>">
	<div class="container">

		<?php if( is_active_sidebar( 'shop-sidebar' ) && $content_layout['sidebar'] ) echo wp_kses_post( $content_layout['main_before'] ); ?>

				<main class="main" role="main">
                    <?php $page_id = smarty_page_id(); ?>
                    <?php if ( get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>
                        <h1><?php woocommerce_page_title(); ?></h1>
                    <?php endif; ?>

					<?php if ( have_posts() ) : ?>

						<div class="woocommerce-order-bar">
							<?php
								/**
								 * woocommerce_before_shop_loop hook.
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>

						<?php woocommerce_product_loop_start(); ?>
							<?php woocommerce_product_subcategories(); ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php wc_get_template_part( 'content', 'product' ); ?>
							<?php endwhile; // end of the loop. ?>
						<?php woocommerce_product_loop_end(); ?>
						<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>
					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
						<?php wc_get_template( 'loop/no-products-found.php' ); ?>
					<?php endif; ?>

				</main>

			<?php if( is_active_sidebar( 'shop-sidebar' ) && $content_layout['sidebar'] ) echo wp_kses_post( $content_layout['main_after'] ); ?>
			<?php
				if( is_active_sidebar( 'shop-sidebar' ) && $content_layout['sidebar'] ) {

					/**
					 * woocommerce_sidebar hook.
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */

					echo wp_kses_post( $content_layout['sidebar_before'] );
					do_action( 'woocommerce_sidebar' );
					echo wp_kses_post( $content_layout['sidebar_after'] );
				}
			?>

	</div>
</div>
<?php get_footer(); ?>
