@extends('layouts.app')

@section('title', __('tasks.list'))

@section('content')
    <div class="mb-3">
        <div class="float-right">
            @can('create', new App\Station)
                <a href="{{ route('tasks.create') }}" class="btn btn-success">{{ __('tasks.create') }}</a>
            @endcan
        </div>
        <h1 class="page-title">{{ __('tasks.list') }} <small>{{ __('app.total') }} : {{ $tasks->total() }} {{ __('tasks.tasks') }}</small></h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                        <div class="form-group">
                            <label for="q" class="control-label">{{ __('tasks.search') }}</label>
                            <input placeholder="{{ __('tasks.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                        </div>
                        <input type="submit" value="{{ __('tasks.search') }}" class="btn btn-secondary">
                        <a href="{{ route('tasks.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                    </form>
                </div>
                <table class="table table-sm table-responsive-sm">
                    <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('tasks.description') }}</th>
                        <th>{{ __('tasks.type') }}</th>
                        <th>{{ __('tasks.comment') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $key => $task)
                        <tr>
                            <td class="text-center">{{ $tasks->firstItem() + $key }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{!! $task->problemType->name !!}</td>
                            <td>{{ $task->comment }}</td>
                            <td class="text-center">
                                <a href="{{ route('tasks.show', $task) }}" id="show-station-{{ $task->id }}">{{ __('app.show') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card-body">{{ $tasks->appends(Request::except('page'))->render() }}</div>
            </div>
        </div>
    </div>
@endsection
