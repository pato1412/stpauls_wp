<?php
/** Variables **/
$output = '';
$img_id = '';
$question = '';
$name = '';
$tel = '';
$email = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( $img_id ) {
	$img = wpb_getImageBySize(array(
		'attach_id' => esc_attr( $img_id ),
		'thumb_size' => '200x200'
	));
}

/** Styles **/
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>

<div class="stm-contact-person<?php echo esc_attr( $css_class ); ?>">
	<?php if( isset( $img['thumbnail'] ) ) : ?>
		<div class="stm-contact-person__photo"><?php echo wp_kses_post( $img['thumbnail'] ); ?></div>
	<?php endif; ?>
	<div class="stm-contact-person__data">
		<?php if( $question != '' ) : ?>
			<div class="stm-contact-person__question"><?php echo esc_html( $question ); ?></div>
		<?php endif; ?>
		<?php if( $name != '' ) : ?>
			<h5 class="stm-contact-person__name"><?php echo esc_html( $name ); ?></h5>
		<?php endif; ?>
		<?php if( $tel != '' || $email != '' ) : ?>
			<ul class="stm-contact-person__contacts">
				<?php if( $tel != '' ) : ?>
					<li class="stm-contact-person__contact stm-contact-person__contact_type_tel"><a href="tel:<?php echo esc_attr( str_replace(' ', '', $tel) ); ?>"><?php echo esc_html( $tel ); ?></a></li>
				<?php endif; ?>
				<?php if( $email != '' ) : ?>
					<li class="stm-contact-person__contact stm-contact-person__contact_type_email"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>
