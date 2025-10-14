<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Genre::all();
        return view('genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Genre::all();
        return view('genre.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $request->input('status', 0);
        $genre->save();

        return redirect()->back()->with('success', 'Thêm thể loại thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::findOrFail($id);
        return view('genre.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::findOrFail($id);
        $list = Genre::all();
        return view('genre.create', compact('list', 'genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $genre = Genre::findOrFail($id);
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $request->input('status', 0);
        $genre->save();

        return redirect()->back()->with('success', 'Cập nhật thể loại thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Genre::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Xóa thể loại thành công!');
    }
}
