<!-- resources/views/members/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Members</h1>
    <a href="{{ route('members.create') }}" class="btn btn-primary">Add New Member</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Borrowed Books</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phone_number }}</td>
                <td>
                    @if($member->books_count > 0)
                        <a href="{{ route('members.books', $member) }}" class="btn btn-sm btn-info ms-2">View Books :<span> {{ $member->books_count }}</span></a>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

