<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $data['categories'] = Categories::all();
        $data['products'] = Products::where('status', '1')->paginate(10);

        return view('client.navigation.shop.index', $data);
    }

    public function show($id)
    {
        $product = Products::where('product_id', $id)->with('categories')->first();
        $relatedProducts = Products::whereHas('categories', function ($query) use ($product) {
            $query->where('cat_id', $product->categories->cat_id);
        })->paginate(10);
        return view('client.navigation.product_detail.index', compact('product', 'relatedProducts'));
    }

    public function filterByCategory($id)
    {
        $products = Products::where('cat_id', $id)->paginate(10);
        $categories = Categories::all();
        return view('client.navigation.shop.index', compact('products', 'categories'));
    }

    public function filterByPrice(Request $request)
    {
        $minPrice = str_replace('$', '', $request->input('minPrice', '1000000'));
        $maxPrice = str_replace('$', '', $request->input('maxPrice', '45000000'));

        $minPrice = (float)$minPrice;
        $maxPrice = (float)$maxPrice;

        $products = Products::whereBetween('price', [$minPrice, $maxPrice])->paginate(10);
        $categories = Categories::all();

        return view('client.navigation.shop.index', compact('products', 'categories'));
    }
}
