<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function index()
    {
        $readers = Reader::paginate(5);
        return view('readers.index', compact('readers'));
    }

    public function create()
    {
        return view('readers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reader_full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:readers,email',
            'phone' => 'required|string|max:14|unique:readers,phone',
            'address' => 'nullable|string|max:255',
        ]);

        Reader::create([
            'user_id' => auth()->id(),
            'reader_full_name' => $request->reader_full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('reader.index');
    }

    public function edit($id)
    {
        $reader = Reader::find($id);
        return view('readers.update', compact('reader'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reader_full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:readers,email,'. $id,
            'phone' => 'required|string|max:14|unique:readers,phone,'. $id,
            'address' => 'nullable|string|max:255',
        ]);

        $reader = Reader::find($id);
        $reader->update([
            'reader_full_name' => $request->reader_full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('reader.index');
    }

    public function delete($id)
    {
        Reader::find($id)->delete();
        return redirect()->route('reader.index');
    }
}