@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('app.import-csv.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="messages">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div class="fields">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
                    <label class="input-group-text" for="import_csv">Upload</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Import CSV</button>
        </form>
    </div>
</div>



@endsection
