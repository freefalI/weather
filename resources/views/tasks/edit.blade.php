@extends('layouts.app')

@section('title', __('task.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        @if (request('action') == 'delete' && $task)
        @can('delete', $task)
            <div class="card">
                <div class="card-header">{{ __('task.delete') }}</div>
                <div class="card-body">
                    <label class="control-label text-primary">{{ __('task.description') }}</label>
                    <p>{{ $task->description }}</p>
                    <label class="control-label text-primary">{{ __('task.comment') }}</label>
                    <p>{{ $task->address }}</p>
                    <label class="control-label text-primary">{{ __('task.type') }}</label>
                    <p>{{ $task->problemType->name  }}</p>
                    {!! $errors->first('task_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('task.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="station_id" type="hidden" value="{{ $task->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('task.edit') }}</div>
            <form method="POST" action="{{ route('tasks.update', $task) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="description" class="control-label">{{ __('task.description') }}</label>
                        <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('name', $task->description) }}" required>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="comment" class="control-label">{{ __('task.comment') }}</label>
                        <textarea id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" rows="4">{{ old('comment', $task->comment) }}</textarea>
                        {!! $errors->first('comment', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <label for="problemType" class="control-label">{{ __('task.type') }}</label>
                        <select id="problemType" class="form-control{{ $errors->has('problem_type_id') ? ' is-invalid' : '' }}" name="problem_type_id">
                            @foreach($problemTypes as $problemType)
                                <option value="{{$problemType->id}}" {{$problemType->id==$task->problem_type_id ? 'selected' : ''}}>{{$problemType->name}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('problem_type_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>

                    <input hidden id="area" type="text" class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area" value="{{ old('area', $task->area) }}" >

                    {!! $errors->first('area', '<span class="invalid-feedback" role="alert">:message</span>') !!}


                    <div id="mapid"></div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('task.update') }}" class="btn btn-success">
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $task)
                        <a href="{{ route('tasks.edit', [$task, 'action' => 'delete']) }}" id="del-station-{{ $task->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
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
    var mapCenter = [{{ $center->latitude }}, {{ $center->longitude }}];
    var map = L.map('mapid', {editable: true}).setView(mapCenter, {{ config('leaflet.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // var marker = L.marker(mapCenter).addTo(map);
    var drawnItems = new L.FeatureGroup();


    var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems
        },
        draw: {
            circle: false,
        }
    });



    map.addLayer(drawnItems);
    // Take advantage of the onEachFeature callback to initialize drawnItems
    function onEachFeature(feature, layer) {
        drawnItems.addLayer(layer);
    }
    var oldArea ='{!!old('area', $task->area) !!}';

        // .addTo(map);
    if(oldArea){
        var layer = L.geoJSON(JSON.parse(oldArea),{
            onEachFeature: onEachFeature
        })
    }

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
    map.on(L.Draw.Event.CREATED, function (e) {
        var type = e.layerType,
            layer = e.layer;
        if (type === 'marker') {
            // Do marker specific actions
        }
        map.addLayer(layer);
        drawnItems.addLayer(layer)
        $('#area').val(JSON.stringify(drawnItems.toGeoJSON()));
    });
    map.on('draw:edited', function (e) {
        $('#area').val(JSON.stringify(drawnItems.toGeoJSON()));
    });
    map.on('draw:deleted', function (e) {
        $('#area').val(JSON.stringify(drawnItems.toGeoJSON()));
    });


    map.addControl(drawControl);
    // function updateMarker(lat, lng) {
    //     marker
    //     .setLatLng([lat, lng])
    //     .bindPopup("Your location :  " + marker.getLatLng().toString())
    //     .openPopup();
    //     return false;
    // };
    //
    // map.on('click', function(e) {
    //     let latitude = e.latlng.lat.toString().substring(0, 15);
    //     let longitude = e.latlng.lng.toString().substring(0, 15);
    //     $('#latitude').val(latitude);
    //     $('#longitude').val(longitude);
    //     updateMarker(latitude, longitude);
    // });
    //
    // var updateMarkerByInputs = function() {
    //     return updateMarker( $('#latitude').val() , $('#longitude').val());
    // }
    // $('#latitude').on('input', updateMarkerByInputs);
    // $('#longitude').on('input', updateMarkerByInputs);
</script>
@endpush
