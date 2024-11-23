<!-- resources/views/books/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Books</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Published Year</th>
                    <th>Categories</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->published_year }}</td>
                        <td>
                            @foreach ($book->categories as $category)
                                <span class="badge bg-secondary">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if ($book->member)
                                Borrowed by {{ $book->member->name }}
                                <br>
                                <small class="text-muted">Since: {{ $book->borrowed_at->format('Y-m-d') }}</small>
                            @else
                                Available
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning ms-2">Edit</a>
                                @if (!$book->member_id)
                                    <button type="button" class="btn btn-sm btn-success ms-2" data-bs-toggle="modal"
                                        data-bs-target="#borrowModal{{ $book->id }}">
                                        Borrow
                                    </button>
                                @else
                                    <form action="{{ route('books.return', $book) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-info ms-2">Return</button>
                                    </form>
                                @endif
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ms-2"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Borrow Modal -->
                    <div class="modal fade" id="borrowModal{{ $book->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Borrow Book: {{ $book->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('books.borrow', $book) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="member_id" class="form-label">Select Member</label>
                                            <select name="member_id" id="member_id" class="form-select" required>
                                                <option value="">Choose a member...</option>
                                                @foreach (\App\Models\Member::all() as $member)
                                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Borrow Book</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
