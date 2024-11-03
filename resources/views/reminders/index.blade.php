@extends('layouts.admin')
@section('content')

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
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            Event ID
                        </th>
                        <th>
                            Reminder Date Time
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($data as $key => $value)
                        <tr >
                            <td>

                            </td>
                            <td>
                                {{ $value["user_name"] ?? '' }}
                            </td>
                            <td>
                                {{ $value["user_email"] ?? '' }}
                            </td>
                            <td>
                                {{ $value["event_id"] ?? '' }}
                            </td>
                            <td>
                                {{ $value["reminder_date_time"] ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('app.reminder.setReminder', [$value['user_id'], $value['event_id']]) }}">
                                        Set
                                </a>
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
