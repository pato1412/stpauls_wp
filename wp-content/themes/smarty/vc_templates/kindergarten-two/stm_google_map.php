<?php
/** Variables **/
$output = '';
$contact_details_enable = '';
$contact_form_enable = '';
$address = '';
$tel = '';
$skype = '';
$fax = '';
$email = '';
$map_coordinates = '';
$latitude = '';
$longitude = '';
$height = '';
$zoom = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$map_id = uniqid('stm_map_');

$map_styles = array(
    'height:' . esc_attr( $height )
);
$map_style = smarty_element_style( $map_styles );

if( !empty( $map_coordinates ) && $map_coordinates == 'event' && get_post_type() == 'stm_event' ) {
    $latitude = get_post_meta( get_the_ID(), 'stm_event_map_lat', true );
    $longitude = get_post_meta( get_the_ID(), 'stm_event_map_lng', true );
}

if( empty( $zoom ) ) {
    $zoom = '14';
}

/** Styles **/
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<div class="stm-map<?php echo esc_attr( $css_class ); ?>">
    <div class="stm-map__content">
        <?php if( $contact_details_enable ) : ?>
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
        <?php endif; ?>
        <script type="text/javascript">
            <?php $google_api_key = get_theme_mod( 'google_api_key' ); ?>
            var mapId = '<?php echo esc_js( $map_id ); ?>',
                mapLat = '<?php echo esc_js( $latitude ); ?>',
                mapLng = '<?php echo esc_js( $longitude ); ?>',
                mapZoom = <?php echo esc_js( $zoom ); ?>;

            function initialize_map_<?php echo esc_js( $map_id ); ?>() {
                var myLatlng = new google.maps.LatLng( mapLat, mapLng );
                var mapOptions = {
                    zoom: mapZoom,
                    navigationControl: false,
                    scrollwheel: false,
                    mapTypeControl: false,
                    center: myLatlng
                };

                var map = new google.maps.Map(document.getElementById( mapId ), mapOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    animation: google.maps.Animation.DROP
                });

            }

            function loadScript() {
                var script = document.createElement("script");
                script.type = "text/javascript";
                <?php if( !empty($google_api_key) ) { ?>
                script.src = "https://maps.googleapis.com/maps/api/js?key=<?php echo smarty_sanitize_text_field($google_api_key); ?>&v=3.exp&signed_in=true&callback=initialize_map_"+mapId+"&language=en";
                <?php } else { ?>
                script.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&callback=initialize_map_"+mapId+"&language=en";
                <?php } ?>
                document.body.appendChild(script);
            }

            window.onload = loadScript;

        </script>
        <div class="stm-map__canvas" id="<?php echo esc_attr( $map_id ); ?>" <?php echo sanitize_text_field( $map_style ); ?>></div>

        <?php if( $contact_form_enable ) : ?>
        <div class="container">
            <?php if($form != '' and $form != 'none'): ?>
                <?php $cf7 = get_post($form); ?>
                <div class="stm-map__form">
                    <?php echo(do_shortcode('[contact-form-7 id="'.$cf7->ID.'" title="'.($cf7->post_title).'"]')); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>