<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(5);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:225|unique:authors,full_name',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date|after:birth_date',
        ]);

        Author::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
        ]);

        return redirect()->route('author.index');
    }

    public function edit($id)
    {
        $author = Author::find($id);
        return view('authors.update', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:225|unique:authors,full_name,$id',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date|after:birth_date',
        ]);

        $author = Author::find($id);
        $author->update([
            'full_name' => $request->full_name,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
        ]);

        return redirect()->route('author.index');
    }

    public function delete($id)
    {
        Author::find($id)->delete();
        return redirect()->route('author.index');
    }
}
