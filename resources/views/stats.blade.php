@extends('layouts.app')

@section('title', __('station.detail'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('stats.stats') }}</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tbody>
                        <tr>
                            <td>{{ __('stats.total_stations') }}</td>
                            <td>{{$stats['total_stations']}}</td>
                        </tr>
                        <tr>
                            <td>{{ __('stats.avg_humidity') }}</td>
                            <td>{{$stats['avg_humidity']}}</td>
                        </tr><tr>
                            <td>{{ __('stats.avg_pressure') }}</td>
                            <td>{{$stats['avg_pressure']}}</td>
                        </tr><tr>
                            <td>{{ __('stats.avg_precipitation') }}</td>
                            <td>{{$stats['avg_precipitation']}}</td>
                        </tr><tr>
                            <td>{{ __('stats.avg_air_temperature') }}</td>
                            <td>{{$stats['avg_air_temperature']}}</td>
                        </tr><tr>
                            <td>{{ __('stats.avg_road_temperature') }}</td>
                            <td>{{$stats['avg_road_temperature']}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
{{--                <div class="card-footer">--}}

{{--                </div>--}}

            </div>

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
