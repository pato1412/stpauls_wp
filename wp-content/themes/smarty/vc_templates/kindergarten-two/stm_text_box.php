<?php
/* Variables */
$title = '';
$title_tag = '';
$sep_enable = '';
$sep_color = '';
$sep_color_custom = '';
$title_color = '';
$title_color_custom = '';
$title_font_size = '';
$title_line_height = '';
$title_margin_b = '';
$text_color = '';
$text_color_custom = '';
$text_font_size = '';
$text_line_height = '';
$text_margin_b = '';
$stm_bg_color = '';
$stm_bg_color_custom = '';
$padding_top = '';
$padding_bottom = '';
$padding_left = '';
$padding_right = '';
$box_margin_b = '';
$button_link = '';
$button_text = '';
$button_color_scheme = '';
$button_position = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/*
 * === Box ===
 *
 * 1. Style
 * 2. Class
 *
 * */

// 1. Style
$box_styles = array(
	'background-color:' . esc_attr( $stm_bg_color_custom ),
	'padding-top:' . esc_attr( $padding_top ),
	'padding-bottom:' . esc_attr( $padding_bottom ),
	'padding-left:' . esc_attr( $padding_left ),
	'padding-right:' . esc_attr( $padding_right )
);

$box_style = smarty_element_style( $box_styles );

// 2. Class
$box_classes = array();
$box_class = '';

if( !empty( $stm_bg_color ) ) {
	$box_classes[] = 'stm-bg_color_' . esc_attr( $stm_bg_color );
}

if( is_array( $box_classes ) && !empty( $box_classes ) ) {
	$box_class = implode( ' ', $box_classes );
}

/*
 * === Title ===
 *
 * 1. Style
 * 2. Class
 *
 * */

// 1. Style
$title_styles = array(
	'color:' . esc_attr( $title_color_custom ),
	'font-size:' . esc_attr( $title_font_size ),
	'line-height:' . esc_attr( $title_line_height ),
	'margin-bottom:' . esc_attr( $title_margin_b )
);

$title_style = smarty_element_style( $title_styles );

// 2. Class
$title_classes = array();
$title_class = '';

if( $title_color != 'custom' ) {
	$title_classes[] = 'stm-font_color_' . esc_attr( $title_color );
}

if( is_array( $title_classes ) && !empty( $title_classes ) ) {
	$title_class = implode( ' ', $title_classes );
}

/*
 * === Separator ===
 *
 * 1. Class
 * 2. Style
 *
 * */

if( $sep_enable ) {

// 1. Class
	$sep_classes = array();

	if( $sep_color != 'custom' ) {
		$sep_classes[] = 'stm-border_color_' . esc_attr( $sep_color );
	}

	if( is_array( $sep_classes ) && !empty( $sep_classes ) ) {
		$sep_class = implode( ' ', $sep_classes );
	}

// 2. Style
	$sep_styles = array(
		'border-color:' . esc_attr( $sep_color_custom )
	);

	$sep_style = smarty_element_style( $sep_styles );
}

/*
 * === Text ===
 *
 * 1. Style
 * 2. Class
 *
 * */

// 1. Style
$text_styles = array(
	'color:' . esc_attr( $text_color_custom ),
	'font-size:' . esc_attr( $text_font_size ),
	'line-height:' . esc_attr( $text_line_height ),
	'margin-bottom:' . esc_attr( $text_margin_b )
);

$text_style = smarty_element_style( $text_styles );

// 2. Class
$text_classes = array();
$text_class = '';

if( $text_color != 'custom' ) {
	$text_classes[] = 'stm-font_color_' . esc_attr( $text_color );
}

if( is_array( $text_classes ) && !empty( $text_classes ) ) {
	$text_class = implode( ' ', $text_classes );
}

/*
 * === Button ===
 *
 * 1. Link
 * 2. Class
 *
 * */

// 1. Link
if( !empty( $button_link ) ) {
	$button_link = vc_build_link( $button_link );
	if( empty( $button_link['target'] ) ) $button_link['target'] = '_self';
}

// 2. Class
$button_class = '';
$button_classes = array(
	'stm-btn_' . esc_attr( $button_color_scheme ),
	'stm-btn_position_' . esc_attr( $button_position )
);

if( is_array( $button_classes ) && !empty( $button_classes ) ) {
	$button_class = implode( ' ', $button_classes );
}

?>
<div class="stm-text-box<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $box_class ); ?>" <?php echo sanitize_text_field( $box_style ); ?>>
	<div class="stm-text-box__content">
		<?php if( !empty( $title ) ) : ?>
			<<?php echo esc_html( $title_tag ); ?> class="stm-text-box__title <?php echo esc_attr( $title_class ); ?>"<?php echo sanitize_text_field( $title_style ); ?>><?php echo esc_html( $title ); ?></<?php echo esc_html( $title_tag ); ?>>
		<?php endif; ?>
		<?php if( $sep_enable ) : ?>
			<hr class="stm-text-box__sep" <?php echo sanitize_text_field( $sep_style ); ?>>
		<?php endif; ?>
		<?php if( !empty( $content ) ) : ?>
			<div class="stm-text-box__text <?php echo esc_attr( $text_class ); ?>" <?php echo sanitize_text_field( $text_style ); ?>><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
		<?php endif; ?>
		<?php if( isset( $button_link['url'] ) && !empty( $button_link['url'] ) && !empty( $button_text ) ) : ?>
			<div class="stm-text-box__action">
				<a class="stm-btn stm-btn_outline stm-btn_md stm-btn_icon-right <?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_attr( $button_link['url'] ); ?>"><?php echo esc_attr( $button_text ); ?><i class="stm-icon stm-icon-arrow-right"></i></a>
			</div>
		<?php endif; ?>
	</div>
</div>
