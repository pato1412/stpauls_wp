<?php
/* === VARIABLE === */
$cite = '';
$footer_space_t = '';
$blockquote_view_style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === CLASS === */
$blockquote_class = '';
if( !empty( $blockquote_view_style ) ) {
	$blockquote_class .= ' stm-blockquote_' . esc_attr( $blockquote_view_style );
}

/* === STYLE === */
$blockquote_class .= vc_shortcode_custom_css_class( $css, ' ' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $blockquote_class, $this->settings['base'], $atts );

$footer_styles = array(
	'padding-top:' . esc_attr( $footer_space_t )
);
$footer_style = smarty_element_style( $footer_styles );
?>

<div class="stm-blockquote<?php echo esc_attr( $css_class ); ?>">
	<?php echo wpb_js_remove_wpautop( $content, true ); ?>
	<?php if( !empty( $cite ) ) :?>
		<footer <?php echo sanitize_text_field( $footer_style ); ?>>
			<cite><?php echo wp_kses_post( $cite );  ?></cite>
		</footer>
	<?php endif; ?>
</div>
