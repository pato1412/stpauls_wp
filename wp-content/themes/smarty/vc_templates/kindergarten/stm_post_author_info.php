<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<?php
// Author bio.
if ( get_the_author_meta( 'description' ) ) {
	get_template_part( 'parts/author','bio' );
}
?>
