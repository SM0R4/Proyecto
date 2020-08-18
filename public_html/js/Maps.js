/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var map;
var cr_lat = 9.9333;
var cr_lng = -84.0833;
//var directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions:{strokeColor:'#2E9AFE'}});
//var directionsService = new google.maps.DirectionsService();
"use strict";

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: {
            lat: cr_lat,
            lng: cr_lng
        },
        zoom: 15
    });
    return get_my_location();
}

function get_my_location(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function (position) {
            //var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            
            // Do whatever you want with userLatLng.
            var marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: pos,
                title: 'Your Location'
            });
            map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
            $('#Ubicacion').val(position.coords.latitude + ',' + position.coords.longitude);
            marker.addListener('dragend', function(evt){
                map.setZoom(15);
                map.setCenter(marker.getPosition());
                $('#Ubicacion').val(evt.latLng.lat() + ',' + evt.latLng.lng());
            });
        });
    
    }
}

/*dynamicallyCreatedMarkers = [];

            function addMarkerListener(map)
            {
                map.addListener('click', function(e) {
                    var marker = new google.maps.Marker({
                        position: e.latLng,
                        map: map
                    });

                    map.panTo(e.latLng);

                    dynamicallyCreatedMarkers.push({
                        position: e.latLng
                    });
                });
            }

            $('#enviar').click(function() {
                $.ajax({
                    type: "POST",
                    url: '../backend/controller/usuariosController.php',
                    data: dynamicallyCreatedMarkers.serialize(),
                    success: function(response)
                    {
                        console.log('success')
                    }
                });
            });*/