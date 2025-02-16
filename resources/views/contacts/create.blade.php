@extends('layouts.app')

@section('title', 'Add Contact')

@section('content')
    <div class="card p-4">
        <h2>Add Contact</h2>

        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone:</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Save Contact</button>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
