<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Products::orderBy('status', 'desc')->orderBy('product_id', 'desc')->with('categories')->paginate(15);

        // $data['products'] = Products::orderBy('status', 'desc')
        //                         ->orderBy('product_id', 'desc')
        //                         ->with(['categories' => function ($query) {
        //                             $query->where('status', 1);
        //                         }])
        //                         ->paginate(15);

        return view('admin.laravel-navigation.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Categories::where('status', 1)->get();
        return view('admin.laravel-navigation.products.add-new', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'description' => '',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'cat_id' => 'required'
        ]);

        $product = new Products;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->cat_id = $request->cat_id;
        $product->status = true;

        // Store image
        $imagePath = $request->file('image')->store('product_images', 'public');
        $product->image = $imagePath;

        // create foreign
        $categories = Categories::find($request->cat_id);
        $product->categories()->associate($categories);

        $product->save();

        return redirect()->route('products-management')->with('success', 'Products created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['product'] = Products::find($id);
        $data['categories'] = Categories::all();
        // dd($data);
        return view('admin.laravel-navigation.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|double',
            'quantity' => 'required|double',
            'description' => '',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'cat_id' => 'required'
        ]);

        $product = Products::find($id);
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            // Store image and get path
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }
        $product->cat_id = $request->cat_id;
        $product->status = true;

        $product->update();

        // dd('what?');

        return redirect()->route('products-management')->with('success', 'Products updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::find($id);

        $product->status = !$product->status;

        $product->update();

        return redirect()->route('products-management')->with('success', 'Products deleted successfully!');
    }
}
