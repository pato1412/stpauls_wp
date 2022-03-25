<?php
$sidebar_id = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$sidebar = get_post( $sidebar_id );
?>

<?php if( $sidebar ) : ?>
	<div class="stm-vc-sidebar<?php echo esc_attr( $css_class ); ?>">
		<style type="text/css" scoped>
			<?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
		</style>
		<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
	</div>
<?php endif; ?>
