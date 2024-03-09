<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;

class HomeController extends Controller
{
    public function index()
    {
        $data['productNews'] = Products::orderBy('create_at', 'desc')->with('categories')->limit(8)->get();
        $data['categories'] = Categories::all();
        // dd($data);
        return view('client.navigation.home.index', $data);
    }
}
