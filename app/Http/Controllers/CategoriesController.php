<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = Categories::orderBy('status', 'desc')->orderBy('cat_id', 'desc')->paginate(5);
        return view('admin.laravel-navigation.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laravel-navigation.categories.add-new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // if (!$request->category_name) {
        //     return redirect()->back()->withErrors(['message' => 'Vui lòng nhập vào tên danh mục']);
        // }

        $category = new Categories;
        $category->category_name = $request->category_name;
        $category->status = true;

        $category->save();

        return redirect()->route('categories-management')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        return view('admin.categories.update');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['category'] = Categories::find($id);
        // dd($data);
        return view('admin.laravel-navigation.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = Categories::find($id);

        $category->category_name = $request->category_name;
        $category->status = true;

        $category->update();

        // dd('what?');

        return redirect()->route('categories-management')->with('success', 'Category update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Categories::find($id);

        $category->status = !$category->status;

        $category->update();
        return redirect()->route('categories-management')->with('success', 'Category deleted successfully!');
    }
}
