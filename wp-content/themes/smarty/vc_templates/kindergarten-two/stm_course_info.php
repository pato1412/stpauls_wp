<?php
extract( shortcode_atts( array(
	'title' => '',
	'form' => '',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( ! wp_script_is( 'fancybox' ) ) {
    wp_enqueue_script( 'fancybox' );
    wp_enqueue_style( 'fancybox' );
}
?>

<div class="courses_post__meta_table <?php echo esc_attr($css_class); ?>">
    <ul>
        <li>
            <div><?php esc_html_e( 'Teacher', 'smarty' ); ?></div>
            <?php
            if( $course_teacher_id = get_post_meta( get_the_ID(), 'course_teacher', true ) ) {
                $course_teacher = '<a href="'. esc_url( get_the_permalink( $course_teacher_id ) ) .'">' . get_the_title( $course_teacher_id ) . '</a>';
            } else {
                $course_teacher = esc_html__('Teacher didn\'t  selected', 'smarty');
            }
            ?>
            <?php echo wp_kses_post( $course_teacher ); ?>
        </li>
        <li>
            <div><?php esc_html_e( 'Size', 'smarty' ); ?></div>
            <?php echo (( $course_size = get_post_meta( get_the_ID(), 'course_size', true ) ) ? $course_size : 0 ); ?>
        </li>
        <li>
            <div><?php esc_html_e( 'Age', 'smarty' ); ?></div>
            <?php echo (( $course_age = get_post_meta( get_the_ID(), 'course_age', true ) ) ? $course_age : 0 ); ?>
        </li>
        <li>
            <div><?php esc_html_e( 'Duration', 'smarty' ); ?></div>
            <?php echo (( $course_duration = get_post_meta( get_the_ID(), 'course_duration', true ) ) ? $course_duration : 0 ); ?>
        </li>
        <li>
            <div><?php esc_html_e( 'Price', 'smarty' ); ?></div>
            <?php echo (( $course_price = get_post_meta( get_the_ID(), 'course_price', true ) ) ? $course_price : 0 ); ?>
        </li>
        <li>
            <a href="#courses__form" class="stm-btn stm-btn_flat stm-btn_pink stm-btn_md stm-btn_icon-left courses__form"><?php esc_html_e( 'Enroll Your Child', 'smarty' ); ?></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>

<div class="hidden">
    <div id="courses__form" class="stm_sign_up_now">
        <div class="stm_sign_up_now_inner">
            <?php if($title): ?>
                <h3><?php echo esc_attr($title); ?></h3>
            <?php endif; ?>
            <?php if($form != '' and $form != 'none'): ?>
                <?php $cf7 = get_post($form); ?>
                <div class="stm_sign_up_form">
                    <?php echo(do_shortcode('[contact-form-7 id="'.$cf7->ID.'" title="'.($cf7->post_title).'"]')); ?>
                </div>
            <?php endif; ?>
        </div>
    </div> <!-- stm_subscribe -->
</div>