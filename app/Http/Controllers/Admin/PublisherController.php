<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::paginate(5);
        return view('publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:225|unique:publishers,publisher_name',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:14|unique:publishers,phone',
        ]);

        Publisher::create([
            'user_id' => auth()->id(),
            'publisher_name' => $request->publisher_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
        ]);

        return redirect()->route('publisher.index');
    }

    public function edit($id)
    {
        $publisher = Publisher::find($id);
        return view('publishers.update', compact('publisher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:225|unique:publishers,publisher_name,'.$id,
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:14|unique:publishers,phone,'.$id,
        ]);

        $publisher = Publisher::find($id);
        $publisher->update([
            'publisher_name' => $request->publisher_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
        ]);

        return redirect()->route('publisher.index');
    }

    public function delete($id)
    {
        Publisher::find($id)->delete();
        return redirect()->route('publisher.index');
    }
}