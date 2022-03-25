<?php
/* === VARIABLES === */
$output = '';
$teacher_address = '';
$teacher_tel = '';
$teacher_skype = '';
$teacher_email = '';
$teacher_url = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === STYLE === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === LINK === */
$teacher_url = vc_build_link($teacher_url);
?>

<div class="stm-contact-details stm-contact-details_type_teacher<?php echo esc_attr( $css_class ); ?>">
	<ul class="stm-contact-details__items">
		<?php if( !empty( $teacher_address ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_address"><?php echo esc_html( $teacher_address ); ?></li>
		<?php endif; ?>
		<?php if( !empty( $teacher_tel ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_tel"><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $teacher_tel ) ); ?>"><?php echo esc_html( $teacher_tel ); ?></a></li>
		<?php endif; ?>
		<?php if( !empty( $teacher_skype ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_skype"><a href="skype:<?php echo esc_attr( $teacher_skype ); ?>?chat"><?php echo esc_html( $teacher_skype ); ?></a></li>
		<?php endif; ?>
        <?php if( !empty( $teacher_email ) ) : ?>
            <li class="stm-contact-details__item stm-contact-details__item_type_email"><a href="mailto:<?php echo esc_attr( $teacher_email ); ?>"><?php echo esc_html( $teacher_email ); ?></a></li>
        <?php endif; ?>
		<?php if( !empty( $teacher_url['url'] ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_url"><a href="<?php echo esc_attr( $teacher_url['url'] ); ?>"><?php echo esc_html( $teacher_url['title'] ); ?></a></li>
		<?php endif; ?>
		<li class="stm-contact-details__item stm-contact-details__item_type_socials">
				<?php
					$teacher_socials = array(
						'facebook' => get_post_meta( get_the_ID(), 'stm_teacher_fb', true ),
						'twitter' => get_post_meta( get_the_ID(), 'stm_teacher_tw', true ),
						'google-plus' => get_post_meta( get_the_ID(), 'stm_teacher_gplus', true ),
						'instagram' => get_post_meta( get_the_ID(), 'stm_teacher_inst', true ),
						'envelope' => get_post_meta( get_the_ID(), 'stm_teacher_email', true ),
					)
				?>
				<ul class="socials-list socials-list_type_teacher">
					<?php foreach( $teacher_socials as $teacher_social_name => $teacher_social_url ) : ?>
						<?php if( !empty( $teacher_social_url ) ) : ?>
							<li class="socials-list__item">
								<?php if( $teacher_social_name == 'envelope' ) : ?>
									<a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $teacher_social_name ) ?>" href="mailto:<?php echo esc_attr( $teacher_social_url ); ?>">
								<?php else : ?>
										<a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $teacher_social_name ) ?>" href="<?php echo esc_url( $teacher_social_url ); ?>" target="_blank">
								<?php endif; ?>
									<?php if( $teacher_social_name !== 'instagram' && $teacher_social_name !== 'envelope' ): ?>
										<span class="fa fa-<?php echo esc_attr( $teacher_social_name ); ?>"></span>
									<?php else: ?>
										<span class="stm-icon stm-icon-<?php echo esc_attr( $teacher_social_name ); ?>"></span>
									<?php endif; ?>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>

		</li>
	</ul>
</div>
