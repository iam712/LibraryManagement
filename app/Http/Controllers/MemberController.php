<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $members = Member::withCount('books')->get();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:members',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        Member::create($validated);
        return redirect()->route('members.index')->with('success', 'Member created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        $member->update($validated);
        return redirect()->route('members.index')->with('success', 'Member updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully');
    }

    public function books(Member $member)
    {
        $books = $member->books;
        return view('members.books', compact('member', 'books'));
    }

    

}
