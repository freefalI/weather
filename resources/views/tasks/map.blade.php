@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body" id="mapid"></div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { min-height: 500px; }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }}, {{ config('leaflet.map_center_longitude') }}], {{ config('leaflet.zoom_level') }});
    var baseUrl = "{{ url('/') }}";

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);


    // var drawnItems = new L.FeatureGroup();
    // map.addLayer(drawnItems);
    // var drawControl = new L.Control.Draw({
    //     edit: {
    //         featureGroup: drawnItems
    //     },
    //     draw: {
    //         circle: false,
    //     }
    // });
    // map.addControl(drawControl);


    // if (!areas) {
    //     areas.forEach(function (el) {
    //         L.geoJSON(el).bindPopup(function (layer) {
    //             return '234';
    //         }).addTo(map);
    //     });
    // }
    axios.get('{{ route('api.tasks.index') }}')
        .then(function (response) {
            // console.log(response.data);
            var area;
            for (var dataKey in response.data.collection) {
                // console.log(response.data);
                var item;
                for (var dataKey in response.data.collection) {
                    item = response.data.collection[dataKey];
                    var decodedArea  = JSON.parse(item.area)
                    if(!decodedArea)continue;
                    decodedArea.features.forEach(function(layer){
                        layer.properties.title =item.description;
                        layer.properties.subtitle =item.comment;

                    })
                    L.geoJSON(decodedArea).bindPopup(function (layer) {
                        console.log(layer.feature.properties)
                        // return layer.feature.properties.title ;
                        return '<b>'+layer.feature.properties.title + '</b><br>'+layer.feature.properties.subtitle+
                            '<br><a href="{{ route('tasks.index') }}/1">Open task</a>'

                    }).addTo(map);
                }
            }
        })
        .catch(function (error) {
            console.log(error);
        });


   /* axios.get('{{ route('api.stations.index') }}')
    .then(function (response) {
        console.log(response.data);
        L.geoJSON(response.data, {
            pointToLayer: function(geoJsonPoint, latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function (layer) {
            return layer.feature.properties.map_popup_content;
        }).addTo(map);
    })
    .catch(function (error) {
        console.log(error);
    });*/

    @can('create-commented', new App\Task())
    var theMarker;

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        var popupContent = "Your location : " + latitude + ", " + longitude + ".";
        popupContent += '<br><a href="{{ route('tasks.create') }}?latitude=' + latitude + '&longitude=' + longitude + '">Add new station here</a>';

        theMarker = L.marker([latitude, longitude]).addTo(map);
        theMarker.bindPopup(popupContent)
        .openPopup();
    });
    @endcan
</script>
@endpush
