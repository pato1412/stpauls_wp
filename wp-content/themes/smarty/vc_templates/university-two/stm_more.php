<?php
$more_link = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === STYLE === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === LINK === */
$more_link = vc_build_link($more_link);
?>

<div class="<?php echo esc_attr( $css_class ); ?>">
<?php if( !empty( $more_link['url'] ) ) : ?>
    <a href="<?php echo esc_attr( $more_link['url'] ); ?>" class="stm-more-link"><?php echo esc_html( $more_link['title'] ); ?></a>
<?php endif; ?>
</div>