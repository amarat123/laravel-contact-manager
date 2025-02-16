@extends('layouts.app')

@section('title', 'Contacts List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Contacts</h1>
        <div>
            <a href="{{ route('contacts.create') }}" class="btn btn-success">Add Contact</a>
            <a href="{{ route('contacts.import') }}" class="btn btn-primary">Import Contacts</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Dropdown to select the number of records per page -->
    <form method="GET" action="{{ route('contacts.index') }}" class="mb-3">
        <label for="per_page">Show:</label>
        <select name="per_page" id="per_page" class="form-select d-inline w-auto" onchange="this.form.submit()">
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
            <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>40</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
        </select>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $contacts->appends(['per_page' => $perPage])->links() }}
    </div>
@endsection
