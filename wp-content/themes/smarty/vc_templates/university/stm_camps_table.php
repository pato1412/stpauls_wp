<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<div class="stm-table-container stm-table-container_camps">
	<table class="stm-table stm-table_style-1 stm-table_camps<?php echo esc_attr( $css_class ); ?>">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</table>
</div>
