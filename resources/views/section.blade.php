@extends('layouts.ap')

@section('content')


    <div id="map_div" style="height: 400px;"></div>

    <script type="text/javascript"
            src="//maps.googleapis.com/maps/api/js?key=AIzaSyBmQ6H_TOpkaAEWB1et1mIHre07Kocfugs"></script>
    <script>
        var map;
        google.maps.event.addDomListener(window, "load", function () {
            var map = new google.maps.Map(document.getElementById("map_div"), {
                center: new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infoWindow = new google.maps.InfoWindow();

            function createMarker(options, html) {
                var marker = new google.maps.Marker(options);
                if (html) {
                    google.maps.event.addListener(marker, "click", function () {
                        infoWindow.setContent(html);
                        infoWindow.open(options.map, this);
                    });
                }
                return marker;
            }

            var marker1 = createMarker({
                position: new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>),
                map: map
            }, "<h4><?php echo($users->name); ?></h4><p><?php echo($users->sections->phone); ?></p>");

        });
    </script>
@endsection