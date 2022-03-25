<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>
<table class="stm-table stm-table_style-1 stm-table_course-topics<?php echo esc_attr( $css_class ); ?>">
	<thead>
		<tr>
			<th><?php esc_html_e('Unit Name', 'smarty'); ?></th>
			<th><?php esc_html_e('Date', 'smarty'); ?></th>
			<th><?php esc_html_e('Assignments', 'smarty'); ?></th>
		</tr>
	</thead>
	<tbody><?php echo wpb_js_remove_wpautop( $content ); ?></tbody>
</table>
