<?php
/* === VARIABLES === */
$sep_alignment = '';
$sep_line_width = '';
$sep_width = '';
$sep_style = '';
$sep_color = '';
$sep_color_custom = '';
$separator_text = '';
$text_color = '';
$text_color_custom = '';
$text_size = '';
$separator_icon_library = '';
$icon_color = '';
$icon_color_custom = '';
$icon_size = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === SEPARATOR ===
 *
 * 1. Style
 * 2. Class
 * 4. Line
 *
 *  */
$sep_class = '';

if( !empty( ${'separator_icon_' . $separator_icon_library} ) || !empty( $separator_text ) ) {
	$sep_class .= ' stm-separator_has_item';
}

$sep_inline_styles = array(
	'width:' . esc_attr( $sep_line_width )
);

if( $sep_alignment === 'right' ) {
	$sep_inline_styles[] = 'margin-left:auto; margin-right:0';
} elseif( $sep_alignment === 'center' ) {
	$sep_inline_styles[] = 'margin-left: auto';
	$sep_inline_styles[] = 'margin-right: auto';
}

$sep_inline_style = smarty_element_style( $sep_inline_styles );

// 1. Style
$sep_line_inline_styles = array(
	'border-bottom-width:' . esc_attr( $sep_width ),
	'border-bottom-style:' . esc_attr( $sep_style ),
	'border-bottom-color:' . esc_attr( $sep_color_custom )
);
$sep_line_inline_style = smarty_element_style( $sep_line_inline_styles );

// 2. Class
$sep_line_class = '';

if( !empty( $sep_color ) && $sep_color !== 'custom' ) {
	$sep_line_class .= ' stm-border-bottom_color_' . esc_attr( $sep_color );
}

/* === TEXT ===
 *
 * 1. Style
 * 2. Class
 *
 * */

// 1. Style
$text_styles = array(
	'color:' . esc_attr( $text_color_custom ),
	'font-size:' . esc_attr( $text_size )
);
$text_style = smarty_element_style( $text_styles );

// 2. Class
$text_class = '';
if( $text_class != 'custom' ) {
	$text_class .= ' stm-font_color_' . esc_attr( $text_color );
}

/* === ICON ===
 *
 * 1. Style
 * 2. Class
 *
 * */

// 1. Style
$icon_styles = array(
	'color:' . esc_attr( $icon_color_custom ),
	'font-size:' . esc_attr( $icon_size )
);
$icon_style = smarty_element_style( $icon_styles );

// 2. Class
$icon_class = '';
if( $icon_color != 'custom' ) {
	$icon_class .= ' stm-font_color_' . esc_attr( $icon_color );
}

?>
<?php if( !empty( $separator_text ) || !empty( ${'separator_icon_' . $separator_icon_library} ) ) : ?>
<div class="stm-separator stm-clearfix<?php echo esc_attr( $sep_class ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $sep_inline_style ); ?>>
	<div class="stm-separator__line-holder">
		<div class="stm-separator__line<?php echo esc_attr( $sep_line_class ); ?>" <?php echo sanitize_text_field( $sep_line_inline_style ); ?>></div>
	</div>
	<?php if( !empty( ${'separator_icon_' . $separator_icon_library} ) ) : ?>
		<div class="stm-separator__item stm-separator__item_type_icon<?php echo esc_attr( $icon_class ); ?>" <?php echo sanitize_text_field( $icon_style ); ?>><i class="<?php echo esc_attr( ${'separator_icon_' . $separator_icon_library} ); ?>"></i></div>
	<?php elseif( !empty($separator_text ) ) : ?>
		<div class="stm-separator__item stm-separator__item_type_text<?php echo esc_attr( $text_class ); ?>" <?php echo sanitize_text_field( $text_style ); ?>><?php echo esc_html( $separator_text ); ?></div>
	<?php endif; ?>
	<div class="stm-separator__line-holder">
		<div class="stm-separator__line<?php echo esc_attr( $sep_line_class ); ?>" <?php echo sanitize_text_field( $sep_line_inline_style ); ?>></div>
	</div>
</div>
<?php else: ?>
	<div class="stm-separator stm-clearfix<?php echo esc_attr( $sep_class ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $sep_inline_style ); ?>>
		<div class="stm-separator__line<?php echo esc_attr( $sep_line_class ); ?>" <?php echo sanitize_text_field( $sep_line_inline_style ); ?>></div>
	</div>
<?php endif; ?>

