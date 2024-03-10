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

        // dd($data['bestSeller']);
        return view('client.navigation.shop.index', $data);
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
