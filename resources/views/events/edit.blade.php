@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("app.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $event->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date_time">{{ trans('cruds.event.fields.start_date_time') }}</label>
                <input class="form-control datetime {{ $errors->has('start_date_time') ? 'is-invalid' : '' }}" type="text" name="start_date_time" id="start_date_time" value="{{ old('start_date_time', $event->start_date_time) }}" required>
                @if($errors->has('start_date_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="registrants">{{ trans('cruds.event.fields.registrants') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('registrants') ? 'is-invalid' : '' }}" name="registrants[]" id="registrants" multiple>
                    @foreach($registrants as $id => $registrants)
                        <option value="{{ $id }}" {{ (in_array($id, old('registrants', [])) || $event->registrants->contains($id)) ? 'selected' : '' }}>{{ $registrants }}</option>
                    @endforeach
                </select>
                @if($errors->has('registrants'))
                    <div class="invalid-feedback">
                        {{ $errors->first('registrants') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.registrants_helper') }}</span>
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
