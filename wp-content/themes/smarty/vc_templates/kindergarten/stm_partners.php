<?php
$img_id = '';
$partners_url = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === LINK === */
$partners_url = vc_build_link($partners_url);
?>
<div class="stm-partner <?php echo esc_attr( $css_class ); ?>">
    <?php if( !empty( $img_id ) ) : ?>
        <?php
            $partners_photo = wpb_getImageBySize(array(
                'attach_id'  => $img_id,
                'thumb_size' => '180x140'
            ));
        ?>
        <?php if( !empty( $partners_url['url'] ) ) : ?>
            <a href="<?php echo esc_attr( $partners_url['url'] ); ?>">
        <?php endif; ?>
        <?php echo wp_kses_post( $partners_photo['thumbnail'] ); ?>
        <?php if( !empty( $partners_url['url'] ) ) : ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>
</div>

