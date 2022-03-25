<?php
extract( shortcode_atts( array(
	'button_title' => '',
	'button_sub_title' => '',
	'box_title' => '',
	'form' => '',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<div class="leave_review__button <?php echo esc_attr($css_class); ?>">
    <?php if($button_title): ?>
    <a href="#review__form" class="courses__form">
        <span class="review_icon">
            <i class="fa fa-commenting" aria-hidden="true"></i>
        </span>
        <span class="button_title"><?php echo esc_attr($button_title); ?></span>
        <?php if($button_sub_title): ?>
            <span class="button_sub_title"><?php echo esc_attr($button_sub_title); ?></span>
        <?php endif; ?>
    </a>
    <?php endif; ?>
</div>

<div class="hidden">
    <div id="review__form" class="leave_review__form">
        <?php if($box_title): ?>
            <h3><?php echo esc_attr($box_title); ?></h3>
        <?php endif; ?>
        <?php if($form != '' and $form != 'none'): ?>
            <?php $cf7 = get_post($form); ?>
            <div class="stm_sign_up_form">
                <?php echo(do_shortcode('[contact-form-7 id="'.$cf7->ID.'" title="'.($cf7->post_title).'"]')); ?>
            </div>
        <?php endif; ?>
    </div> <!-- stm_subscribe -->
</div>