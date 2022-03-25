<?php
/* === VARIABLES === */
$output = '';
$administrator_address = '';
$administrator_tel = '';
$administrator_skype = '';
$administrator_email = '';
$administrator_url = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === STYLE === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === LINK === */
$administrator_url = vc_build_link($administrator_url);
?>

<div class="stm-contact-details stm-contact-details_type_teacher<?php echo esc_attr( $css_class ); ?>">
	<ul class="stm-contact-details__items">
		<?php if( !empty( $administrator_address ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_address"><?php echo esc_html( $administrator_address ); ?></li>
		<?php endif; ?>
		<?php if( !empty( $administrator_tel ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_tel"><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $administrator_tel ) ); ?>"><?php echo esc_html( $administrator_tel ); ?></a></li>
		<?php endif; ?>
		<?php if( !empty( $administrator_skype ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_skype"><a href="skype:<?php echo esc_attr( $administrator_skype ); ?>?chat"><?php echo esc_html( $administrator_skype ); ?></a></li>
		<?php endif; ?>
        <?php if( !empty( $administrator_email ) ) : ?>
            <li class="stm-contact-details__item stm-contact-details__item_type_email"><a href="mailto:<?php echo esc_attr( $administrator_email ); ?>"><?php echo esc_html( $administrator_email ); ?></a></li>
        <?php endif; ?>
		<?php if( !empty( $administrator_url['url'] ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_url"><a href="<?php echo esc_attr( $administrator_url['url'] ); ?>"><?php echo esc_html( $administrator_url['title'] ); ?></a></li>
		<?php endif; ?>
		<li class="stm-contact-details__item stm-contact-details__item_type_socials">
				<?php
					$administrator_socials = array(
						'facebook' => get_post_meta( get_the_ID(), 'stm_administrator_fb', true ),
						'twitter' => get_post_meta( get_the_ID(), 'stm_administrator_tw', true ),
						'google-plus' => get_post_meta( get_the_ID(), 'stm_administrator_gplus', true ),
						'instagram' => get_post_meta( get_the_ID(), 'stm_administrator_inst', true ),
						'envelope' => get_post_meta( get_the_ID(), 'stm_administrator_email', true ),
					)
				?>
				<ul class="socials-list socials-list_type_teacher">
					<?php foreach( $administrator_socials as $administrator_social_name => $administrator_social_url ) : ?>
						<?php if( !empty( $administrator_social_url ) ) : ?>
							<li class="socials-list__item">
								<?php if( $administrator_social_name == 'envelope' ) : ?>
									<a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $administrator_social_name ) ?>" href="mailto:<?php echo esc_attr( $administrator_social_url ); ?>">
								<?php else : ?>
										<a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $administrator_social_name ) ?>" href="<?php echo esc_url( $administrator_social_url ); ?>" target="_blank">
								<?php endif; ?>
									<?php if( $administrator_social_name !== 'instagram' && $administrator_social_name !== 'envelope' ): ?>
										<span class="fa fa-<?php echo esc_attr( $administrator_social_name ); ?>"></span>
									<?php else: ?>
										<span class="stm-icon stm-icon-<?php echo esc_attr( $administrator_social_name ); ?>"></span>
									<?php endif; ?>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>

		</li>
	</ul>
</div>
