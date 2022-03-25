<?php
$title = '';
$desc = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === STYLE === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<div class="<?php echo esc_attr( $css_class ); ?>">
    <div class="stm-mailchimp">
        <?php if( !empty( $icon ) ) : ?>
            <div class="stm-mailchimp-icon">
                <?php $stm_mailchimp_icon = get_template_directory_uri() . '/assets/img/frontend-customizer/mailchimp-envelope.svg'; ?>
                <img src="<?php echo esc_url($stm_mailchimp_icon) ?>"/>
            </div>
        <?php endif; ?>
        <?php if( !empty( $title ) ) : ?>
            <div class="stm-mailchimp-title"><?php echo do_shortcode( esc_html( $title ) ); ?></div>
        <?php endif; ?>
        <?php if( !empty( $desc ) ) : ?>
            <div class="stm-mailchimp-description"><?php echo do_shortcode( esc_html( $desc ) ); ?></div>
        <?php endif; ?>
        <?php if( !empty( $shortcode ) ) : ?>
            <div class="stm-mailchimp-form"><?php echo do_shortcode( esc_html( $shortcode ) ); ?></div>
        <?php endif; ?>
    </div>
</div>


<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $(".stm-mailchimp-form input[type='submit']").wrap("<div class='stm-mailchimp-btn'></div>");
        });
    })(jQuery);
</script>