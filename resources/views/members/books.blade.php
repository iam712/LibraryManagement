<!-- resources/views/members/books.blade.php -->
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Books Borrowed by {{ $member->name }}</h2>
    </div>
    <div class="card-body">
        @if($books->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Borrowed Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->borrowed_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('books.return', $book) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-info">Return Book</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No books currently borrowed by this member.</p>
        @endif

        <a href="{{ route('members.index') }}" class="btn btn-secondary">Back to Members</a>
    </div>
</div>
@endsection
