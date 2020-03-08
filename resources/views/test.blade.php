@extends('layouts.app')

@section('content')
<div class="container">
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">Dashboard</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    You are logged in!--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <canvas id="bar" width="400" height="400"></canvas>--}}
{{--    <canvas id="scatter" width="400" height="400"></canvas>--}}

    <section class="content">


        <div class="row"><div class="col-md-12"><div class="callout callout-info">
                    <h4>Chartjs</h4>
                </div></div></div><div class="row"><div class="col-md-6"><div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bar chart</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="bar" style="width: 300px; display: block; height: 149px;" width="600" height="298" class="chartjs-render-monitor"></canvas>
                        <script>
                            $(document).ready(function () {

                                function randomScalingFactor() {
                                    return Math.floor(Math.random() * 100)
                                }

                                window.chartColors = {
                                    red: 'rgb(255, 99, 132)',
                                    orange: 'rgb(255, 159, 64)',
                                    yellow: 'rgb(255, 205, 86)',
                                    green: 'rgb(75, 192, 192)',
                                    blue: 'rgb(54, 162, 235)',
                                    purple: 'rgb(153, 102, 255)',
                                    grey: 'rgb(201, 203, 207)'
                                };

                                var barChartData = {
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                    datasets: [{
                                        label: 'Dataset 1',
                                        borderColor: window.chartColors.red,
                                        borderWidth: 1,
                                        data: [
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor()
                                        ]
                                    }, {
                                        label: 'Dataset 2',
                                        borderColor: window.chartColors.blue,
                                        borderWidth: 1,
                                        data: [
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor()
                                        ]
                                    }]

                                };

                                var ctx = document.getElementById('bar').getContext('2d');
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: barChartData,
                                    options: {
                                        responsive: true,
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Chart.js Bar Chart'
                                        }
                                    }
                                });
                            });
                        </script>
                    </div><!-- /.box-body -->
                </div>

                <script>

                </script></div><div class="col-md-6"><div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Scatter chart</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="scatter" style="width: 300px; display: block; height: 149px;" width="600" height="298" class="chartjs-render-monitor"></canvas>
                        <script>
                            $(document).ready(function () {
                                function randomScalingFactor() {
                                    return Math.floor(Math.random() * 100)
                                }

                                window.chartColors = {
                                    red: 'rgb(255, 99, 132)',
                                    orange: 'rgb(255, 159, 64)',
                                    yellow: 'rgb(255, 205, 86)',
                                    green: 'rgb(75, 192, 192)',
                                    blue: 'rgb(54, 162, 235)',
                                    purple: 'rgb(153, 102, 255)',
                                    grey: 'rgb(201, 203, 207)'
                                };

                                var ctx = document.getElementById("scatter").getContext('2d');
                                var scatterChart = new Chart(ctx, {
                                    type: 'scatter',
                                    data: {
                                        datasets: [{
                                            label: 'My First dataset',
                                            borderColor: window.chartColors.red,
                                            data: [{
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }]
                                        }, {
                                            label: 'My Second dataset',
                                            borderColor: window.chartColors.blue,
                                            data: [{
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }, {
                                                x: randomScalingFactor(),
                                                y: randomScalingFactor(),
                                            }]
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            xAxes: [{
                                                type: 'linear',
                                                position: 'bottom'
                                            }]
                                        }
                                    }
                                });
                            });
                        </script>
                    </div><!-- /.box-body -->
                </div>

                <script>

                </script></div><div class="col-md-6"><div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Line chart</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="line" style="width: 300px; display: block; height: 149px;" width="600" height="298" class="chartjs-render-monitor"></canvas>
                        <script>
                            $(document).ready(function () {

                                function randomScalingFactor() {
                                    return Math.floor(Math.random() * 100)
                                }

                                window.chartColors = {
                                    red: 'rgb(255, 99, 132)',
                                    orange: 'rgb(255, 159, 64)',
                                    yellow: 'rgb(255, 205, 86)',
                                    green: 'rgb(75, 192, 192)',
                                    blue: 'rgb(54, 162, 235)',
                                    purple: 'rgb(153, 102, 255)',
                                    grey: 'rgb(201, 203, 207)'
                                };

                                var config = {
                                    type: 'line',
                                    data: {
                                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                        datasets: [{
                                            label: 'My First dataset',
                                            backgroundColor: window.chartColors.red,
                                            borderColor: window.chartColors.red,
                                            data: [
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor()
                                            ],
                                            fill: false,
                                        }, {
                                            label: 'My Second dataset',
                                            fill: false,
                                            backgroundColor: window.chartColors.blue,
                                            borderColor: window.chartColors.blue,
                                            data: [
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor()
                                            ],
                                        }]
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

                                var ctx = document.getElementById('line').getContext('2d');
                                new Chart(ctx, config);
                            });
                        </script>
                    </div><!-- /.box-body -->
                </div>

                <script>

                </script></div></div><div class="row"><div class="col-md-6"><div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Doughnut chart</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="doughnut" style="width: 300px; display: block; height: 149px;" width="600" height="298" class="chartjs-render-monitor"></canvas>
                        <script>
                            $(document).ready(function () {

                                function randomScalingFactor() {
                                    return Math.floor(Math.random() * 100)
                                }

                                window.chartColors = {
                                    red: 'rgb(255, 99, 132)',
                                    orange: 'rgb(255, 159, 64)',
                                    yellow: 'rgb(255, 205, 86)',
                                    green: 'rgb(75, 192, 192)',
                                    blue: 'rgb(54, 162, 235)',
                                    purple: 'rgb(153, 102, 255)',
                                    grey: 'rgb(201, 203, 207)'
                                };

                                var config = {
                                    type: 'doughnut',
                                    data: {
                                        datasets: [{
                                            data: [
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                            ],
                                            backgroundColor: [
                                                window.chartColors.red,
                                                window.chartColors.orange,
                                                window.chartColors.yellow,
                                                window.chartColors.green,
                                                window.chartColors.blue,
                                            ],
                                            label: 'Dataset 1'
                                        }],
                                        labels: [
                                            'Red',
                                            'Orange',
                                            'Yellow',
                                            'Green',
                                            'Blue'
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Chart.js Doughnut Chart'
                                        },
                                        animation: {
                                            animateScale: true,
                                            animateRotate: true
                                        }
                                    }
                                };

                                var ctx = document.getElementById('doughnut').getContext('2d');
                                new Chart(ctx, config);
                            });
                        </script>
                    </div><!-- /.box-body -->
                </div>

                <script>

                </script></div><div class="col-md-6"><div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chart.js Combo Bar Line Chart</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="bar-line" style="width: 300px; display: block; height: 149px;" width="600" height="298" class="chartjs-render-monitor"></canvas>
                        <script>
                            $(document).ready(function () {

                                function randomScalingFactor() {
                                    return Math.floor(Math.random() * 100)
                                }

                                window.chartColors = {
                                    red: 'rgb(255, 99, 132)',
                                    orange: 'rgb(255, 159, 64)',
                                    yellow: 'rgb(255, 205, 86)',
                                    green: 'rgb(75, 192, 192)',
                                    blue: 'rgb(54, 162, 235)',
                                    purple: 'rgb(153, 102, 255)',
                                    grey: 'rgb(201, 203, 207)'
                                };

                                var chartData = {
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                    datasets: [{
                                        type: 'line',
                                        label: 'Dataset 1',
                                        borderColor: window.chartColors.blue,
                                        borderWidth: 2,
                                        fill: false,
                                        data: [
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor()
                                        ]
                                    }, {
                                        type: 'bar',
                                        label: 'Dataset 2',
                                        backgroundColor: window.chartColors.red,
                                        data: [
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor()
                                        ],
                                        borderColor: 'white',
                                        borderWidth: 2
                                    }, {
                                        type: 'bar',
                                        label: 'Dataset 3',
                                        backgroundColor: window.chartColors.green,
                                        data: [
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor()
                                        ]
                                    }]

                                };

                                var ctx = document.getElementById('bar-line').getContext('2d');
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: chartData,
                                    options: {
                                        responsive: true,
                                        title: {
                                            display: true,
                                            text: 'Chart.js Combo Bar Line Chart'
                                        },
                                        tooltips: {
                                            mode: 'index',
                                            intersect: true
                                        }
                                    }
                                });
                            });
                        </script>
                    </div><!-- /.box-body -->
                </div>

                <script>

                </script></div><div class="col-md-6"><div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chart.js Line Chart - Stacked Area</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="line-stacked" style="width: 300px; display: block; height: 149px;" width="600" height="298" class="chartjs-render-monitor"></canvas>
                        <script>
                            $(document).ready(function () {

                                function randomScalingFactor() {
                                    return Math.floor(Math.random() * 100)
                                }

                                window.chartColors = {
                                    red: 'rgb(255, 99, 132)',
                                    orange: 'rgb(255, 159, 64)',
                                    yellow: 'rgb(255, 205, 86)',
                                    green: 'rgb(75, 192, 192)',
                                    blue: 'rgb(54, 162, 235)',
                                    purple: 'rgb(153, 102, 255)',
                                    grey: 'rgb(201, 203, 207)'
                                };

                                var config = {
                                    type: 'line',
                                    data: {
                                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                        datasets: [{
                                            label: 'My First dataset',
                                            borderColor: window.chartColors.red,
                                            backgroundColor: window.chartColors.red,
                                            data: [
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor()
                                            ],
                                        }, {
                                            label: 'My Second dataset',
                                            borderColor: window.chartColors.blue,
                                            backgroundColor: window.chartColors.blue,
                                            data: [
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor()
                                            ],
                                        }, {
                                            label: 'My Third dataset',
                                            borderColor: window.chartColors.green,
                                            backgroundColor: window.chartColors.green,
                                            data: [
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor()
                                            ],
                                        }, {
                                            label: 'My Third dataset',
                                            borderColor: window.chartColors.yellow,
                                            backgroundColor: window.chartColors.yellow,
                                            data: [
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor(),
                                                randomScalingFactor()
                                            ],
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        title: {
                                            display: true,
                                            text: 'Chart.js Line Chart - Stacked Area'
                                        },
                                        tooltips: {
                                            mode: 'index',
                                        },
                                        hover: {
                                            mode: 'index'
                                        },
                                        scales: {
                                            xAxes: [{
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: 'Month'
                                                }
                                            }],
                                            yAxes: [{
                                                stacked: true,
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: 'Value'
                                                }
                                            }]
                                        }
                                    }
                                };

                                var ctx = document.getElementById('line-stacked').getContext('2d');
                                new Chart(ctx, config);
                            });
                        </script>
                    </div><!-- /.box-body -->
                </div>

                <script>

                </script></div></div>

    </section>
    <br>
    <br>
    <br>
    <br>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>
    <canvas id="myChart" width="400" height="400"></canvas>
</div>
@endsection
@push('styles_stack')
{{--    <script src="{{ asset('js/app.js') }}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>

{{--    <style type="text/css">--}}
{{--        BODY {--}}
{{--            width: 550PX;--}}
{{--        }--}}

{{--        #chart-container {--}}
{{--            width: 100%;--}}
{{--            height: auto;--}}
{{--        }--}}
{{--    </style>--}}
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph() {
            {
                var data = [
                    {
                        student_name: "test",
                        marks: "80"
                    },
                    {
                        student_name: "test2",
                        marks: "70"
                    },
                    {
                        student_name: "test34",
                        marks: "60"
                    },
                    {
                        student_name: "test3",
                        marks: "80"
                    },
                ];
                // $.post("data.php",
                //     function (data)
                //     {
                console.log(data);
                var name = [];
                var marks = [];

                for (var i in data) {
                    name.push(data[i].student_name);
                    marks.push(data[i].marks);
                }

                var chartdata = {
                    labels: name,
                    datasets: [
                        {
                            label: 'Student Marks',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: marks
                        }
                    ]
                };

                var graphTarget = $("#graphCanvas");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata
                });

                $(function () {
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });

                function randomScalingFactor() {
                    return Math.floor(Math.random() * 100)
                }

                window.chartColors = {
                    red: 'rgb(255, 99, 132)',
                    orange: 'rgb(255, 159, 64)',
                    yellow: 'rgb(255, 205, 86)',
                    green: 'rgb(75, 192, 192)',
                    blue: 'rgb(54, 162, 235)',
                    purple: 'rgb(153, 102, 255)',
                    grey: 'rgb(201, 203, 207)'
                };

                var barChartData = {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Dataset 1',
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    }, {
                        label: 'Dataset 2',
                        borderColor: window.chartColors.blue,
                        borderWidth: 1,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    }]

                };

                // var ctx = document.getElementById('bar').getContext('2d');
                // new Chart(ctx, {
                //     type: 'bar',
                //     data: barChartData,
                //     options: {
                //         responsive: true,
                //         legend: {
                //             position: 'top',
                //         },
                //         title: {
                //             display: true,
                //             text: 'Chart.js Bar Chart'
                //         }
                //     }
                // });
                // var ctx = document.getElementById("scatter").getContext('2d');
                // var scatterChart = new Chart(ctx, {
                //     type: 'scatter',
                //     data: {
                //         datasets: [{
                //             label: 'My First dataset',
                //             borderColor: window.chartColors.red,
                //             data: [{
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }]
                //         }, {
                //             label: 'My Second dataset',
                //             borderColor: window.chartColors.blue,
                //             data: [{
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }, {
                //                 x: randomScalingFactor(),
                //                 y: randomScalingFactor(),
                //             }]
                //         }]
                //     },
                //     options: {
                //         scales: {
                //             xAxes: [{
                //                 type: 'linear',
                //                 position: 'bottom'
                //             }]
                //         }
                //     }
                // });
            }
        }


    </script>
@endpush
