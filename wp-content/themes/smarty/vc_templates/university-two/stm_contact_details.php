<?php
/** Variables **/
$output = '';
$address = '';
$tel = '';
$skype = '';
$fax = '';
$email = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/** Styles **/
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<div class="stm-map<?php echo esc_attr( $css_class ); ?>">
	<div class="stm-map__content">
        <div class="stm-contact-details stm-contact-details_type_teacher stm-contact-details_type_contacts">
            <ul class="stm-contact-details__items">
                <?php if( !empty( $address ) ) : ?>
                    <li class="stm-contact-details__item stm-contact-details__item_type_address"><?php echo wpb_js_remove_wpautop( $address ); ?></li>
                <?php endif; ?>
                <?php if( !empty( $tel ) ) : ?>
                    <li class="stm-contact-details__item stm-contact-details__item_type_tel"><a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $tel ); ?></a></li>
                <?php endif; ?>
                <?php if( !empty( $fax ) ) : ?>
                    <li class="stm-contact-details__item stm-contact-details__item_type_fax"><a href="tel:<?php echo esc_attr( $fax ); ?>"><?php echo esc_html( $fax ); ?></a></li>
                <?php endif; ?>
                <?php if( !empty( $skype ) ) : ?>
                    <li class="stm-contact-details__item stm-contact-details__item_type_skype"><a href="skype:<?php echo esc_attr( $skype ); ?>?chat"><?php echo esc_html( $skype ); ?></a></li>
                <?php endif; ?>
                <?php if( !empty( $email ) ) : ?>
                    <li class="stm-contact-details__item stm-contact-details__item_type_email"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
                <?php endif; ?>
                <?php if( !empty( $work_schedule ) ) : ?>
                    <li class="stm-contact-details__item stm-contact-details__item_type_work_schedule"><?php echo esc_html( $work_schedule ); ?></li>
                <?php endif; ?>
                <li class="stm-contact-details__item stm-contact-details__item_type_socials">
                    <?php $socials = smarty_get_footer_socials(); ?>
                    <?php if( !empty( $socials ) ) : ?>
                        <ul class="socials-list socials-list_type_teacher">
                            <?php foreach( $socials as $social_key => $social_val ) : ?>
                                <?php if( !empty( $social_val ) ) : ?>
                                    <li class="socials-list__item">
                                        <a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $social_key ); ?>" href="<?php echo esc_url($social_val); ?>"><i class="fa fa-<?php echo esc_attr( $social_key ); ?>"></i></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
	</div>
</div>
