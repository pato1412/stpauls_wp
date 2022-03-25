<?php
$cta_classes = $img_id = $title = $title_css = $img_size = $img_enable = $img_position = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Image
if( $img_id ) {
	if( ! $img_size ) {
		$img_size = '380x196';
	}

	$img = wpb_getImageBySize( array(
		'attach_id' => $img_id,
		'thumb_size' => $img_size
	) );
}

// General
if( !empty( $cta_bg_color ) ) {
	$cta_classes .= ' stm-bg_color_' . $cta_bg_color;
}

if( !empty( $cta_border_color ) ) {
	$cta_classes .= ' stm-border_color_' . $cta_border_color;
}

// Title style
$title_styles = array(
	'color:' . $title_color,
	'font-weight:' . $title_font_weight,
	'font-size:' . $title_font_size,
	'font-style:' . $title_font_style,
	'line-height:' . $title_line_height
);

$title_inline_style = smarty_element_style($title_styles);

// Description style
$descr_styles = array(
	'color:' . $descr_color,
	'font-weight:' . $descr_font_weight,
	'font-size:' . $descr_font_size,
	'font-style:' . $descr_font_style,
	'line-height:' . $descr_line_height
);

$descr_inline_style = smarty_element_style( $descr_styles );

?>

<div class="stm-cta<?php echo esc_attr( $cta_classes ); ?> <?php echo esc_attr( trim( $css_class ) ); ?>">
	<div class="stm-cta__content">

		<?php if( $img_id && $img_position === 'left' ) : ?>
			<div class="stm-cta__image"><?php echo wp_kses_post( $img['thumbnail'] ); ?></div>
		<?php endif; ?>

		<div class="stm-cta__action">
			<h2 class="stm-cta__action-title" <?php echo sanitize_text_field( $title_inline_style ); ?>><?php echo esc_html( $title ); ?></h2>
			<div class="stm-cta__action-body">
				<div class="stm-cta__action-descr" <?php echo sanitize_text_field( $descr_inline_style ); ?>><?php echo wpb_js_remove_wpautop($content, true); ?></div>
				<?php $btn_link = vc_build_link( $btn_link ); ?>

				<?php if( $btn_link['url'] ) : ?>

						<div class="stm-cta__action-btn">

						<?php
							$btn_classes = 'stm-btn stm-btn_flat stm-btn_md stm-btn_icon-left';
							$btn_ic = '';

							if( ! $btn_link['target'] ) {
								$btn_link['target'] = '_self';
							}

							if( $btn_color ) {
								$btn_classes .= ' stm-btn_' . esc_attr( $btn_color );
							}
						?>

						<a href="<?php echo esc_url( $btn_link['url'] ); ?>" target="<?php echo esc_attr( $btn_link['target'] ); ?>" class="<?php echo esc_attr( $btn_classes ); ?>"><i class="stm-icon stm-icon-duck" style="margin-top:-3px;margin-right:19px"></i><?php echo esc_html( $btn_link['title'] ); ?></a>

					</div>

				<?php endif; ?>

			</div>
		</div>

		<?php if( $img_id && $img_position === 'right' ) : ?>
			<div class="stm-cta__image"><?php echo wp_kses_post( $img['thumbnail'] ); ?></div>
		<?php endif; ?>

	</div>
</div>