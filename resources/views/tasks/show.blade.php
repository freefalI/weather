@extends('layouts.app')

@section('title', __('task.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('task.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('task.description') }}</td><td>{{ $task->description }}</td></tr>
                        <tr><td>{{ __('task.comment') }}</td><td>{{ $task->comment }}</td></tr>
                        <tr><td>{{ __('task.type') }}</td><td>{{ $task->problemType->name }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $task)
                    <a href="{{ route('tasks.edit', $task) }}" id="edit-station-{{ $task->id }}" class="btn btn-warning">{{ __('task.edit') }}</a>
                @endcan
                @if(auth()->check())
                    <a href="{{ route('tasks.index') }}" class="btn btn-link">{{ __('task.back_to_index') }}</a>
                @else
                    <a href="{{ route('tasks.map') }}" class="btn btn-link">{{ __('task.back_to_index') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ trans('task.location') }}</div>
{{--            @if ($task->coordinate)--}}
            <div class="card-body" id="mapid"></div>
{{--            @else--}}
{{--            <div class="card-body">{{ __('task.no_coordinate') }}</div>--}}
{{--            @endif--}}
        </div>
    </div>

</div>
<br>
<br>
<div class="row  justify-content-center" >
    <div class="col-md-8">
        <canvas id="myChart" height="250" ></canvas>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 400px; }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $center->latitude}}, {{$center->longitude  }}], {{ config('leaflet.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    var oldArea ='{!!$task->area!!}';

    L.geoJSON( JSON.parse(oldArea)).addTo(map);

   /* L.marker([{{ $task->latitude }}, {{ $task->longitude }}]).addTo(map)
        .bindPopup('{!! $task->map_popup_content !!}');*/

</script>
<script>
</script>
@endpush
