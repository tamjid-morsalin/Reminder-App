@extends('layouts.admin')
@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("app.events.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
        </a>

        <a class="btn btn-success" href="{{ route("app.import-csv.index") }}">
            {{ trans('global.import_csv') }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.start_date_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.registrants') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                        <tr data-entry-id="{{ $event->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $event->id ?? '' }}
                            </td>
                            <td>
                                {{ $event->title ?? '' }}
                            </td>
                            <td>
                                {{ $event->description ?? '' }}
                            </td>
                            <td>
                                {{ $event->start_date_time ?? '' }}
                            </td>
                            <td>
                                @foreach($event->registrants as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('app.events.show', $event->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('app.events.edit', $event->id) }}">
                                    {{ trans('global.edit') }}
                                </a>


                                <form action="{{ route('app.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
@endsection
