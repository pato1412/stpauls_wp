<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header(); ?>
<?php get_template_part( 'parts/page', 'title' ); ?>
<?php get_template_part( 'parts/page', 'breadcrumbs' ); ?>
<?php
	$product_sidebar = get_theme_mod('product_sidebar', 'right');
	$content_layout  = smarty_content_layout( $product_sidebar );
?>
<div class="content<?php echo esc_attr( $content_layout['content_class'] ); ?>">
	<div class="container">
		<?php if( is_active_sidebar( 'shop-sidebar' ) && $content_layout['sidebar'] ) echo wp_kses_post( $content_layout['main_before'] ); ?>
				<main class="main" role="main">
                    <?php $page_id = smarty_page_id(); ?>
                    <?php if ( get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>
                        <h1><?php the_title(); ?></h1>
                    <?php endif; ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

				</main>
			<?php if( is_active_sidebar( 'shop-sidebar' ) && $content_layout['sidebar'] ) echo wp_kses_post( $content_layout['main_after'] ); ?>
			<?php
				if( $content_layout['sidebar'] && is_active_sidebar( 'shop-sidebar' ) ) {

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
