@extends('layouts.app')

@section('title', __('task.create'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ __('task.create') }}</div>
            <form method="POST" action="{{ route('tasks.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                @dump($errors)
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="control-label">{{ __('task.description') }}</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">{{ __('task.comment') }}</label>
                        <textarea id="address" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" rows="4">{{ old('comment') }}</textarea>
                        {!! $errors->first('comment', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="problemType" class="control-label">{{ __('task.type') }}</label>
                        <select id="problemType" class="form-control{{ $errors->has('problem_type_id') ? ' is-invalid' : '' }}" name="problem_type_id">
                        @foreach($problemTypes as $problemType)
                            <option value="{{$problemType->id}}">{{$problemType->name}}</option>
                        @endforeach
                        </select>
                        {!! $errors->first('problem_type_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>


                    <input id="area" type="text" class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area" value="{{ old('area', request('area')) }}" >

                    {!! $errors->first('area', '<span class="invalid-feedback" role="alert">:message</span>') !!}

                    <div id="mapid"></div>
                    <br>

                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('task.create') }}" class="btn btn-success">
                    <a href="{{ route('tasks.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 600px; }
</style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>

<script>

    var mapCenter = [{{ request('latitude1', config('leaflet.map_center_latitude')) }}, {{ request('longitude1', config('leaflet.map_center_longitude')) }}];
   // mapCenter=[-104.99404, 39.75621];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.zoom_level') }});
    // var map = L.map('mapid').setView([51.505, -0.09], 13);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    // FeatureGroup is to store editable layers
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems
        },
        draw: {
            circle: false,
        }
    });
    map.addControl(drawControl);

    // var geojsonFeature = {
    //     "type": "Feature",
    //     "properties": {
    //         "name": "Coors Field",
    //         "amenity": "Baseball Stadium",
    //         "popupContent": "This is where the Rockies play!"
    //     },
    //     "geometry": {
    //         "type": "Point",
    //         "coordinates": [-104.99404, 39.75621]
    //     }
    // };
    //
    // var oldArea = JSON.parse('[{"type":"Feature","properties":{},"geometry":{"type":"Point","coordinates":[30.55624,50.463296]}},{"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[30.510406,50.467011],[30.510406,50.472365],[30.523281,50.472365],[30.523281,50.467011],[30.510406,50.467011]]]}},{"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[30.535812,50.451711],[30.535641,50.45193],[30.530577,50.449635],[30.530577,50.449635],[30.542765,50.444114],[30.542765,50.444114],[30.542078,50.450236],[30.542078,50.450236],[30.535812,50.451711]]]}},{"type":"Feature","properties":{},"geometry":{"type":"LineString","coordinates":[[30.521393,50.448979],[30.521393,50.448979],[30.551262,50.432798],[30.551262,50.432798],[30.585938,50.456411],[30.585938,50.456411]]}},{"type":"Feature","properties":{},"geometry":{"type":"Point","coordinates":[30.479164,50.472365]}},{"type":"Feature","properties":{},"geometry":{"type":"Point","coordinates":[30.526543,50.477827]}}]')
    // L.geoJSON(  oldArea ).addTo(map);
    // L.geoJSON(  oldArea[1]  ).addTo(map);
// var map = L.map('map', {drawControl: true}).setView([51.505, -0.09], 13);
    // L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    // }).addTo(map);
    //
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);

    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        // let latitude = e.latlng.lat.toString().substring(0, 15);
        // let longitude = e.latlng.lng.toString().substring(0, 15);
        // $('#latitude1').val(latitude);
        // $('#longitude1').val(longitude);
        // updateMarker(latitude, longitude);
    });

    // map.on('draw:created', function (e) {
    //     console.log(e)
    //     var layers = e.layers;
    //     layers.eachLayer(function (layer) {
    //         console.log(layer)
    //         //do whatever you want; most likely save back to db
    //     });
    // });
    var selectedAreas=[];
    map.on(L.Draw.Event.CREATED, function (e) {
        var type = e.layerType,
            layer = e.layer;
        if (type === 'marker') {
            // Do marker specific actions
        }
        // Do whatever else you need to. (save to db; add to map etc)
        map.addLayer(layer);
        console.log(layer);
        var shape = layer.toGeoJSON()
        // layer.properties = 23;
        shape.properties.id =  Math.random().toString(36).substr(2, 9);
        var shape_for_db = JSON.stringify(shape);
        console.log(shape);
        console.log(shape_for_db);
        selectedAreas.push(shape);
        $('#area').val(JSON.stringify(selectedAreas));
        drawnItems.addLayer(layer)
        console.log(drawnItems.layers)
        console.log(drawnItems.toGeoJSON())
        drawnItems._layers.forEach(function (layer) {
            var shape = layer.toGeoJSON()
            console.log(shape);
            //do whatever you want; most likely save back to db
        });
    });
    // map.on('draw:created', function (e) {
    //     var type = e.layerType;
    //     var layer = e.layer;
    //
    //     var shape = layer.toGeoJSON()
    //     var shape_for_db = JSON.stringify(shape);
    //     selectedAreas.push(shape);
    //
    // });

    map.on('draw:edited', function (e) {
        var layers = e.layers;
        layers.eachLayer(function (layer) {
            //do whatever you want; most likely save back to db
        });
    });

    map.on('draw:deleted', function (e) {
        var layers = e.layers;
        layers.eachLayer(function (layer) {
        //     //do whatever you want; most likely save back to db
            selectedAreas.forEach(function(el){
                // console.log(el)
                // console.log(selectedAreas[el])
                if(el.properties.id===layer.id)
                    console.log('found')
            })
        });
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }

</script>
@endpush
