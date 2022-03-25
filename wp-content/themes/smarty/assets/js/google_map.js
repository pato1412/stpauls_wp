function initialize_map() {

    var $ = jQuery;

    $('.stm-map__canvas').each(function () {
        var mapId = $(this).attr('id');
        var mapSettings = window[mapId];
        var mapLat = mapSettings['latitude'];
        var mapLng = mapSettings['longitude'];
        var mapZoom = parseFloat(mapSettings['zoom']);

        var myLatlng = new google.maps.LatLng(mapLat, mapLng);
        var mapOptions = {
            zoom: mapZoom,
            navigationControl: false,
            scrollwheel: false,
            mapTypeControl: false,
            center: myLatlng
        };

        var map = new google.maps.Map(document.getElementById(mapId), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            animation: google.maps.Animation.DROP
        });

    });

}