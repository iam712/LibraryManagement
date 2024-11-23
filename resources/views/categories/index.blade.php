<!-- resources/views/categories/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Books Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->books_count }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning ms-2">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
                {{-- {{ $category->name }} --}}
                <td>
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-secondary ms-2">Book List</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
