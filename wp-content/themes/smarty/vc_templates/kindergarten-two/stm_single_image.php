<?php
/* Variables */
$img_id = '';
$img_size = '';
$img_alignment = '';
$img_responsive_enable = '';
$img_border_radius = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* Wrapper - Class */
$image_wrapper_class = '';
if( !empty( $img_alignment ) ) {
	$image_wrapper_class .= ' stm-single-image_' . esc_attr( $img_alignment );
}

/* Class */
$image_class = '';
if( $img_responsive_enable ) {
	$image_class .= ' stm-single-image_responsive';
}

if( $img_border_radius ) {
    $image_class .= ' stm-single-image_border_radius';
}

/* Image */
if( !empty( $img_id ) && $img_id > 0 ) {

	if( empty( $img_size ) ) {
		$img_size = 'full';
	}

	$img = wpb_getImageBySize(array(
		'attach_id' => $img_id,
		'thumb_size' => $img_size
	));

}
?>

<?php if( isset( $img['thumbnail'] ) && !empty( $img['thumbnail'] ) ) : ?>
<div class="stm-single-image-wrapper<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $image_wrapper_class ); ?>">
		<div class="stm-single-image<?php echo esc_attr( $image_class ); ?>"><?php echo wp_kses_post( $img['thumbnail'] ); ?></div>
</div>
<?php endif; ?>
