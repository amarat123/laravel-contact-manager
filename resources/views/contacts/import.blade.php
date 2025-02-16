@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Import Contacts</h1>
        <a href="{{ route('contacts.index') }}" class="btn btn-primary">View Contacts</a>
    </div>
    <form method="POST" action="{{ route('contacts.import.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="xml_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Import</button>
    </form>
@endsection




