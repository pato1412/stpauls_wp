<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>
<?php if( $course_teacher_id = get_post_meta( get_the_ID(), 'course_teacher', true ) ) : ?>
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

<?php endif; ?>
