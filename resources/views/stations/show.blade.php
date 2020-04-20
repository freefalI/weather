@extends('layouts.app')

@section('title', __('station.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('station.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('station.name') }}</td><td>{{ $station->name }}</td></tr>
                        <tr><td>{{ __('station.address') }}</td><td>{{ $station->address }}</td></tr>
                        <tr><td>{{ __('station.latitude') }}</td><td>{{ $station->latitude }}</td></tr>
                        <tr><td>{{ __('station.longitude') }}</td><td>{{ $station->longitude }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $station)
                    <a href="{{ route('stations.edit', $station) }}" id="edit-station-{{ $station->id }}" class="btn btn-warning">{{ __('station.edit') }}</a>
                @endcan
                @if(auth()->check())
                    <a href="{{ route('stations.index') }}" class="btn btn-link">{{ __('station.back_to_index') }}</a>
                @else
                    <a href="{{ route('station_map.index') }}" class="btn btn-link">{{ __('station.back_to_index') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ trans('station.location') }}</div>
            @if ($station->coordinate)
            <div class="card-body" id="mapid"></div>
            @else
            <div class="card-body">{{ __('station.no_coordinate') }}</div>
            @endif
        </div>
    </div>

</div>
<br>
<br>
@if(!$measureData->count())
No data for charts
@endif
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
    var map = L.map('mapid').setView([{{ $station->latitude }}, {{ $station->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $station->latitude }}, {{ $station->longitude }}]).addTo(map)
        .bindPopup('{!! $station->map_popup_content !!}');
</script>
<script>
    $(document).ready(function () {

        function randomScalingFactor() {
            return Math.floor(Math.random() * 100)
        }
        // return;
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
        @if($measureData->count())
            var config = {
                type: 'line',
                data: {
                   // labels:{!! json_encode($measureData['App\Humidity']->map(function ($val){return $val->measured_at/*Carbon\Carbon::parse($val->measured_at)->format('l jS \\of F Y h:i:s A')*/;})->toArray())!!},
                    // options: {
                    //     scales: {
                    //         yAxes: [{
                    //             id: 'A',
                    //             type: 'linear',
                    //             position: 'left',
                    //             // ticks: {
                    //             //     max: 300,
                    //             //     min: 5
                    //             // }
                    //         }, {
                    //             id: 'B',
                    //             type: 'linear',
                    //             position: 'right',
                    //             ticks: {
                    //                 max: 1000,
                    //                 min: 1
                    //             }
                    //         }]
                    //     }
                    // },

                    datasets: [{
                        label: 'Humidity',
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: {{json_encode($measureData['App\Humidity']->map(function ($val){return (float)$val->value;})->toArray())}},
                            // randomScalingFactor(),
                            // randomScalingFactor(),
                            // randomScalingFactor(),
                            // randomScalingFactor(),
                            // randomScalingFactor(),
                            // randomScalingFactor(),
                            // randomScalingFactor()
                        // ],
                        fill: false,
                        yAxesID: 'A',
                    },
                        {
                        label: 'Precipitation',
                        fill: false,
                        yAxesID: 'A',
                        backgroundColor: window.chartColors.green,
                        borderColor: window.chartColors.green,
                        data:  {{json_encode($measureData['App\Precipitation']->map(function ($val){return (float)$val->value;})->toArray())}},
                            // [
                        //     randomScalingFactor(),
                        //     randomScalingFactor(),
                        //     randomScalingFactor(),
                        //     randomScalingFactor(),
                        //     randomScalingFactor(),
                        //     randomScalingFactor(),
                        //     randomScalingFactor()
                        // ],
                    },
                        {{--{--}}
                        {{--    label: 'AtmospherePressure',--}}
                        {{--    fill: false,--}}
                        {{--    yAxesID: 'B',--}}

                        {{--    backgroundColor: window.chartColors.purple,--}}
                        {{--    borderColor: window.chartColors.purple,--}}
                        {{--    data:  {{json_encode($measureData['App\AtmospherePressure']->map(function ($val){return (float)$val->value;})->toArray())}},--}}
                        {{--    // [--}}
                        {{--    //     randomScalingFactor(),--}}
                        {{--    //     randomScalingFactor(),--}}
                        {{--    //     randomScalingFactor(),--}}
                        {{--    //     randomScalingFactor(),--}}
                        {{--    //     randomScalingFactor(),--}}
                        {{--    //     randomScalingFactor(),--}}
                        {{--    //     randomScalingFactor()--}}
                        {{--    // ],--}}
                        {{--},--}}
                        {
                            label: 'AirTemperature',
                            fill: false,
                            yAxesID: 'A',

                            backgroundColor: window.chartColors.grey,
                            borderColor: window.chartColors.grey,
                            data:  {{json_encode($measureData['App\AirTemperature']->map(function ($val){return (float)$val->value;})->toArray())}},
                            // [
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor()
                            // ],
                        },
                        {
                            label: 'RoadTemperature',
                            fill: false,
                            yAxesID: 'A',

                            backgroundColor: window.chartColors.orange,
                            borderColor: window.chartColors.orange,
                            data:  {{json_encode($measureData['App\RoadTemperature']->map(function ($val){return (float)$val->value;})->toArray())}},
                            // [
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor(),
                            //     randomScalingFactor()
                            // ],
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Chart.js Line Chart'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }]
                    }
                }
            };

            var ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, config);
        @endif
    });
</script>
@endpush
