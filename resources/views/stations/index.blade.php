@extends('layouts.app')

@section('title', __('station.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Station)
            <a href="{{ route('stations.create') }}" class="btn btn-success">{{ __('station.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('station.list') }} <small>{{ __('app.total') }} : {{ $stations->total() }} {{ __('station.station') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="control-label">{{ __('station.search') }}</label>
                        <input placeholder="{{ __('station.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('station.search') }}" class="btn btn-secondary">
                    <a href="{{ route('stations.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('station.name') }}</th>
                        <th>{{ __('station.address') }}</th>
                        <th>{{ __('station.latitude') }}</th>
                        <th>{{ __('station.longitude') }}</th>
                        <th>{{ __('station.status') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stations as $key => $station)
                    <tr>
                        <td class="text-center">{{ $stations->firstItem() + $key }}</td>
                        <td>{!! $station->name_link !!}</td>
                        <td>{{ $station->address }}</td>
                        <td>{{ $station->latitude }}</td>
                        <td>{{ $station->longitude }}</td>
                        <td style="background-color:{{ $station->statusColor}};">{{ $station->status }}</td>
                        <td class="text-center">
                            <a href="{{ route('stations.show', $station) }}" id="show-station-{{ $station->id }}">{{ __('app.show') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $stations->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
