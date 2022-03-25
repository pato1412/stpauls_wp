<?php
$title = '';
$img_id = '';
$position = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>
<div class="stm-teacher-bio stm-teacher-bio_trainer">
	<div class="stm-teacher-bio__content">
		<div class="stm-teacher-bio__data">
			<?php if( !empty( $img_id ) ) : ?>
				<?php
					$teacher_photo = wpb_getImageBySize(array(
						'attach_id'  => $img_id,
						'thumb_size' => '160x160'
					));
				?>
				<div class="stm-teacher-bio__photo"><?php echo wp_kses_post( $teacher_photo['thumbnail'] ); ?></div>
			<?php endif; ?>
			<?php if( !empty( $title ) ) : ?>
				<div class="stm-teacher-bio__title"><?php echo esc_html( $title ); ?></div>
			<?php endif; ?>
			<?php if( !empty( $position ) ) : ?>
				<div class="stm-teacher-bio__position"><?php echo esc_html( $position ); ?></div>
			<?php endif; ?>
		</div>
		<div class="stm-teacher-bio__text"><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
	</div>
</div>

