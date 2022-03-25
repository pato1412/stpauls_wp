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

                    <div class="breadcrumbs">
                        <?php if(function_exists('bcn_display')) {bcn_display();} ?>
                    </div>

                <?php endif; ?>

                <?php if( is_single() ): ?>
                    <header class="entry-header">
                        <div class="entry-header__heading">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            <ul class="entry-meta">
                                <?php
                                if ( ! is_multi_author() ) {
                                    printf( '<li><span class="byline"><span class="author vcard"><span class="stm-icon stm-icon-pencil"></span> <span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span></li>',
                                        _x( 'Author', 'Used before post author name.', 'smarty' ),
                                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                        get_the_author()
                                    );
                                }
                                ?>
                                <?php $event_categories_list = get_the_term_list( get_the_ID(), 'stm_event_category', '', ', ', '' ); ?>
                                <?php if( !empty( $event_categories_list ) ) : ?>
                                    <li><span class="cat-links"><span class="stm-icon stm-icon-tag_flag"></span> <?php echo wp_kses_post( $event_categories_list ); ?></span></li>
                                <?php endif; ?>
                                <?php
                                    $event_member = get_post_meta( $page_id, 'event_attended', true );
                                ?>
                                <?php if( !empty( $event_member ) ) : ?>
                                    <li>
                                        <span class="stm-icon stm-icon-attended"></span> <?php echo get_post_meta( $page_id, 'event_attended', true ); ?> <?php esc_html_e( 'attended', 'smarty' ); ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </header>
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