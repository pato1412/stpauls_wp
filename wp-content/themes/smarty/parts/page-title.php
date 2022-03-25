<?php $page_id = smarty_page_id(); ?>

<?php if ( ! get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>

	<?php
		$stm_page_title_style_size = get_post_meta( $page_id, 'stm_page_title_style_size', true );
		$stm_page_title_style_color = get_post_meta( $page_id, 'stm_page_title_style_color', true );
		$stm_show_shipping_cart = get_post_meta( $page_id, 'stm_show_shipping_cart', true );
		$stm_page_title_bgimage_position = get_post_meta( $page_id, 'stm_page_title_bgimage_position', true );
		$stm_page_title_bgimage_id = get_post_meta( $page_id, 'stm_page_title_bgimage', true );
		$stm_page_title_padding = get_post_meta( $page_id, 'stm_page_title_padding', true );
		$stm_page_title_height = get_post_meta( $page_id, 'stm_page_title_height', true );
		$stm_page_title_bgcolor = get_post_meta( $page_id, 'stm_page_title_bgcolor', true );
		$stm_page_subtitle = get_post_meta( $page_id, 'stm_page_subtitle', true );
		$stm_page_title_position = get_post_meta( $page_id, 'stm_page_title_position', true );
		$stm_page_title_color = get_post_meta( $page_id, 'stm_page_title_color', true );
		$stm_page_title_sep_line_color = get_post_meta( $page_id, 'stm_page_title_sep_line_color', true );
		$stm_page_subtitle_color = get_post_meta( $page_id, 'stm_page_subtitle_color', true );

		// Page Head - Class
		$page_head_class = 'stm-page-head';

		if( $stm_show_shipping_cart && class_exists('WooCommerce') ) {
			$page_head_class .= ' stm-page-head_has_shopping-cart';
		}

		if( $stm_page_subtitle ) {
			$page_head_class .= ' stm-page-head_has_subtitle';
		}

		if( !empty( $stm_page_title_style_size ) ) {
			$page_head_class .= ' stm-page-head_size_' . esc_attr( $stm_page_title_style_size );
		} else {
			$page_head_class .= ' stm-page-head_size_small';
		}

		if( !empty( $stm_page_title_style_color ) ) {
			$page_head_class .= ' stm-page-head_color_' . esc_attr( $stm_page_title_style_color );
		} else {
			$page_head_class .= ' stm-page-head_color_white';
		}

		// Page Head - Style
		$page_head_styles = array();

		if( !empty( $stm_page_title_bgimage_id ) ) {
			$stm_page_title_bgimage_src = wp_get_attachment_image_src($stm_page_title_bgimage_id, 'full');
			$page_head_styles[] = 'background-image: url(' . esc_url( $stm_page_title_bgimage_src[0] ) . ')';
		}

		$page_head_styles[] = 'background-position:' . esc_attr( $stm_page_title_bgimage_position );

		if( !empty( $stm_page_title_padding ) ) {
			foreach( $stm_page_title_padding as $stm_page_title_padding_side => $stm_page_title_padding_val ) {
				if( $stm_page_title_padding_val ) {
					$page_head_styles[] = 'padding-' . esc_attr( $stm_page_title_padding_side ) . ':' . esc_attr( $stm_page_title_padding_val );
				}
			}
		}

		$page_head_styles[] = 'height:' . $stm_page_title_height;
		$page_head_styles[] = 'background-color:' . esc_attr( $stm_page_title_bgcolor );
		$page_head_style = smarty_element_style( $page_head_styles );

		// Title - Style
		$page_title_styles = array();
		$page_title_styles[] = 'color:' . esc_attr( $stm_page_title_color );
		$page_title_style = smarty_element_style( $page_title_styles );

		// Title Separator - Style
		$page_title_sep_line_styles = array();
		$page_title_sep_line_styles[] = 'background:' . esc_attr( $stm_page_title_sep_line_color );
		$page_title_sep_line_style = smarty_element_style( $page_title_sep_line_styles );

		// Subtitle - Style
		$page_subtitle_styles = array();
		$page_subtitle_styles[] = 'color:' . esc_attr( $stm_page_subtitle_color );
		$page_subtitle_style = smarty_element_style( $page_subtitle_styles );

		// Overlay - Style
		if( get_post_meta( $page_id, 'stm_page_title_overlay', true ) ) {

			$page_title_overlay_styles = array();
			$stm_page_title_overlay_color = get_post_meta( $page_id, 'stm_page_title_overlay_color', true );
			$stm_page_title_overlay_opacity = get_post_meta( $page_id, 'stm_page_title_overlay_opacity', true );

			if( empty( $stm_page_title_overlay_opacity ) ) {
				$stm_page_title_overlay_opacity = false;
			}

			if( !empty( $stm_page_title_overlay_color ) ) {
				$page_title_overlay_styles[] = 'background-color:'. smarty_hex2rgba($stm_page_title_overlay_color, $stm_page_title_overlay_opacity);
			}

			$page_title_overlay_style = smarty_element_style( $page_title_overlay_styles );

		}

	?>

	<div class="<?php echo esc_attr( $page_head_class ); ?>" <?php echo sanitize_text_field( $page_head_style ); ?>>

		<div class="container">
			<div class="stm-page-head__content">
                <?php if ( ! get_post_meta( $page_id, 'stm_page_breadcrumbs_hide', true ) ) : ?>

                    <?php if ( in_array( 'breadcrumb-navxt/breadcrumb-navxt.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
                        <div class="breadcrumbs">
                            <?php if(function_exists('bcn_display')) {bcn_display();} ?>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>
				<?php if( is_author() ) : ?>
					<?php the_post(); ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ) ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php printf( esc_html__( 'All posts by %s', 'smarty' ), get_the_author() ); ?></h1>
					<?php rewind_posts(); ?>
				<?php elseif( is_tag() ) : ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php printf( esc_html__( '%s', 'smarty' ), single_tag_title( '', false ) ); ?></h1>
				<?php elseif( is_category() ) : ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php printf( esc_html__( '%s', 'smarty' ), single_cat_title( '', false ) ); ?></h1>
                <?php elseif( is_tax() ) : ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php printf( esc_html__( '%s', 'smarty' ), single_cat_title( '', false ) ); ?></h1>
				<?php elseif( ! $page_id && is_home() ) : ?>
					<?php $posts_title = get_theme_mod( 'posts_title',  esc_html__( 'News', 'smarty' ) ); ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php echo esc_html( $posts_title ); ?></h1>
				<?php elseif( is_search() ) : ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php esc_html_e( 'Search results', 'smarty' ); ?></h1>
				<?php elseif( class_exists('WooCommerce') && is_product() ) : ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php the_title(); ?></h1>
				<?php elseif( $stm_page_title = get_post_meta( $page_id, 'stm_page_title', true ) ) : ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php echo esc_html( $stm_page_title ); ?></h1>
				<?php elseif( get_the_title( $page_id ) ) : ?>
					<h1 class="stm-page-head__title <?php echo esc_attr( $stm_page_title_position ); ?>" <?php echo sanitize_text_field( $page_title_style ); ?>><?php echo get_the_title( $page_id ); ?></h1>
				<?php endif; ?>

				<div class="stm-page-head__separator">
					<div class="stm-page-head__separator-line"<?php echo sanitize_text_field( $page_title_sep_line_style ); ?>></div>
				</div>

				<?php if( $stm_page_subtitle ) : ?>
					<div class="stm-page-head__subtitle" <?php echo sanitize_text_field( $page_subtitle_style ); ?>>
						<?php echo wp_kses_post( $stm_page_subtitle ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
				if( $stm_show_shipping_cart && class_exists('WooCommerce') ) {
                    smarty_get_layout_file('/parts', '/mini-cart');
				}
			?>
		</div>

		<?php if( get_post_meta( $page_id, 'stm_page_title_overlay', true ) ) : ?>
			<div class="stm-page-head__overlay" <?php echo sanitize_text_field( $page_title_overlay_style ); ?>></div>
		<?php endif; ?>
	</div>

<?php endif; ?>