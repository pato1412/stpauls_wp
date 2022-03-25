<?php
$title = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( $title == '' ) {
	$title = 'Statistics';
}
?>

<div class="stm-statistics stm-statistics_vc-widget widget widget_statistics<?php echo esc_attr( $css_class ); ?>">
	<h4 class="stm-statistics__title widget__title"><?php echo esc_html( $title ); ?></h4>
	<ul class="stm-statistics__items">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</ul>
</div>
