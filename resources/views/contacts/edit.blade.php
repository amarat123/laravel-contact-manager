@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')
    <div class="card p-4">
        <h2 class="mb-4">Edit Contact</h2>

        <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
            @csrf 
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" value="{{ $contact->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone:</label>
                <input type="text" name="phone" value="{{ $contact->phone }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
