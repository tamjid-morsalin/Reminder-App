@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("app.reminder.update", [$data['user_id'], $data['event_id']]) }}" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="form-group">
                <label class="required" for="title">User Email</label>
                <input class="form-control" type="text" name="user_email" id="user_email" value="{{ old('user_email', $data['user_email']) }}" readonly>
                
            </div>
            
            <div class="form-group">
                <label class="required" for="title">Event Title</label>
                <input class="form-control" type="event_name" name="event_name" id="event_name" value="{{ old('event_name', $data['event_name']) }}" readonly>
                
            </div>

            <div class="form-group">
                <label class="" for="reminder_date_time">Reminder Date Time</label>
                <input class="form-control datetime" type="text" name="reminder_date_time" id="reminder_date_time" value="{{ old('reminder_date_time', $data['reminder_date_time']) }}">
            </div>
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
