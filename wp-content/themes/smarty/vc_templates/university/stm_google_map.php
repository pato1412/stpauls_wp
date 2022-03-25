<?php
/** Variables **/
$output = '';
$map_coordinates = '';
$latitude = '';
$longitude = '';
$height = '';
$zoom = '';
$contact_photo = '';

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
        <?php if( !empty( $contact_photo ) ) : ?>
            <?php
            $contact_map_photo = wpb_getImageBySize(array(
                'attach_id'  => $contact_photo,
                'thumb_size' => '700x700'
            ));
            ?>
            <div class="stm-contact__photo"><?php echo wp_kses_post( $contact_map_photo['thumbnail'] ); ?></div>
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
    </div>
</div>
