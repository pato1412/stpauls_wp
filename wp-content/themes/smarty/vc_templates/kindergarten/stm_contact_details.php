<?php
/* === VARIABLES === */
$output = '';
$contact_address = '';
$contact_tel = '';
$contact_skype = '';
$contact_url = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === STYLE === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === LINK === */
$contact_url = vc_build_link($contact_url);
?>

<div class="stm-contact-details_box stm-contact-details_type_contact<?php echo esc_attr( $css_class ); ?>">
	<ul class="stm-contact-details__items_box">

		<?php if( !empty( $contact_tel ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_tel"><span class="stm-icon stm-icon-phone"></span> <?php echo esc_html( $contact_tel ); ?></li>
		<?php endif; ?>
		<?php if( !empty( $contact_skype ) ) : ?>
			<li class="stm-contact-details__item stm-contact-details__item_type_skype"><span class="stm-icon stm-icon-skype"></span> <a href="skype:<?php echo esc_attr( $contact_skype ); ?>?chat"><?php echo esc_html( $contact_skype ); ?></a></li>
		<?php endif; ?>
        <?php if( !empty( $contact_email ) ) : ?>
            <li class="stm-contact-details__item stm-contact-details__item_type_email"><span class="stm-icon stm-icon-mail"></span> <a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a></li>
        <?php endif; ?>
        <?php if( !empty( $contact_url['url'] ) ) : ?>
            <li class="stm-contact-details__item stm-contact-details__item_type_url"><span class="stm-icon stm-icon-web-address"></span> <a href="<?php echo esc_attr( $contact_url['url'] ); ?>"><?php echo esc_html( $contact_url['title'] ); ?></a></li>
        <?php endif; ?>
        <?php if( !empty( $contact_fax ) ) : ?>
            <li class="stm-contact-details__item stm-contact-details__item_type_fax"><span class="stm-icon stm-icon-printer"></span> <?php echo esc_html( $contact_fax ); ?></li>
        <?php endif; ?>
        <?php if( !empty( $contact_schedule ) ) : ?>
            <li class="stm-contact-details__item stm-contact-details__item_type_schedule"><span class="stm-icon stm-icon-time"></span> <?php echo esc_html( $contact_schedule ); ?></li>
        <?php endif; ?>
        <?php if( !empty( $contact_address ) ) : ?>
            <li class="stm-contact-details__item stm-contact-details__item_type_address"><span class="stm-icon stm-icon-location"></span> <?php echo esc_html( $contact_address ); ?></li>
        <?php endif; ?>

	</ul>

    <?php
        $socials = smarty_get_footer_socials();
        if( !empty( $socials ) ) : ?>
        <ul class="list list_inline list_social-networks<?php echo esc_attr( $css_class ); ?>">
            <?php foreach( $socials as $social_key => $social_val ) : ?>
                <li class="list__item"><a class="list__item-link list__item-link_<?php echo esc_attr( $social_key ); ?>" href="<?php echo esc_url($social_val); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $social_key ); ?>"></i></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
