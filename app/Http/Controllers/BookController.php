<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $books = Book::with(['categories', 'member'])->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $members = Member::all();
        return view('books.create', compact('categories', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'isbn' => 'required|unique:books',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $book = Book::create($validated);
        $book->categories()->attach($request->categories);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
        $categories = Category::all();
        $members = Member::all();
        return view('books.edit', compact('book', 'categories', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $book->update($validated);
        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }

    public function borrow(Request $request, Book $book)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id'
        ]);

        $book->update([
            'member_id' => $validated['member_id'],
            'borrowed_at' => now()
        ]);

        return redirect()->route('books.index')->with('success', 'Book borrowed successfully');
    }

    public function return(Book $book)
    {
        $book->update([
            'member_id' => null,
            'borrowed_at' => null
        ]);

        return redirect()->route('books.index')->with('success', 'Book returned successfully');
    }
}
