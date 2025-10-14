<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = country::all();
        return view('country.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = country::all();
        return view('country.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $country = new country();
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->status = $request->input('status', 0);
        $country->save();

        return redirect()->back()->with('success', 'Thêm thể loại thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = country::findOrFail($id);
        return view('country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = country::findOrFail($id);
        $list = country::all();
        return view('country.create', compact('list', 'country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $country = country::findOrFail($id);
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->status = $request->input('status', 0);
        $country->save();

        return redirect()->back()->with('success', 'Cập nhật thể loại thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        country::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Xóa thể loại thành công!');
    }
}
