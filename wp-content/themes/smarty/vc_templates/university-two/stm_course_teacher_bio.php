<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<?php if( $courses_teacher_id = smarty_get_teachers(get_the_ID()) ) : ?>
    <div class="row<?php echo esc_attr( $css_class ); ?>">
        <?php foreach($courses_teacher_id as $course_teacher_id) : ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="stm-teacher-bio stm-teacher-bio_course">
                <?php if( has_post_thumbnail( $course_teacher_id ) ) : ?>
                    <?php
                        $course_teacher_photo = wpb_getImageBySize(array(
                            'attach_id'  => get_post_thumbnail_id( $course_teacher_id ),
                            'thumb_size' => '160x160'
                        ));
                    ?>
                    <div class="stm-teacher-bio__photo"><?php echo wp_kses_post( $course_teacher_photo['thumbnail'] ); ?></div>
                <?php endif; ?>
                <div class="stm-teacher-bio__title"><a href="<?php echo esc_url( get_the_permalink( $course_teacher_id ) ); ?>"><?php echo get_the_title( $course_teacher_id ); ?></a></div>
                <?php if( $course_teacher_position = get_post_meta( $course_teacher_id, 'stm_teacher_position', true ) ) : ?>
                    <div class="stm-teacher-bio__position"><?php echo esc_html( $course_teacher_position ); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
