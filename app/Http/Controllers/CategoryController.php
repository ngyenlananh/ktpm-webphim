<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @return 
     */
    public function create()
    {
        $list = Category::all();
        return view('category.create', compact('list'));

    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    public function store(Request $request)
    {   
        $data = $request->all();
        $category = new Category();
        $category ->title = $data['title'];
        $category ->slug = $data['slug'];
        
        $category ->description = $data['description'];

        $category->status = $request->input('status', 0);
     //   $category->status = $data['status'];
        $category -> save(); 
        return redirect()->back();
        
        
        
    }

    /**
     * Display the specified resource.
     *   $name
     */
    public function show($id)
    {
        //
    }

    /**
      * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
         $list = Category::all();
        return view('category.create', compact('list','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $category =  Category::find($id);
        $category ->title = $data['title'];
        $category ->slug = $data['slug'];
        $category ->description = $data['description'];
        $category->status = $request->input('status', 0);
     //   $category->status = $data['status'];
        $category -> save(); 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id) ->delete();
          return redirect()->back();
    }
}
