<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data['categories'] = Categories::all();
        $data['productNews'] = Products::orderBy('create_at', 'desc')->with('categories')->limit(10)->get();
        
        // filter
        $data['productFilter'] = Products::orderBy('create_at', 'desc')->with('categories')->limit(5)->get();
        $data['hotTrend'] = Products::orderBy('create_at', 'desc')->limit(5)->get();
        $data['bestSeller'] = Products::select('products.*', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->join('order_details', 'order_details.product_id', '=', 'products.product_id')
            ->join('orders', 'orders.order_id', '=', 'order_details.order_id')
            // Bạn có thể thêm điều kiện cho orders nếu cần, ví dụ: ->where('orders.status', 'completed')
            ->groupBy(['products.product_id', 'products.cat_id', 'products.product_name', 'products.price', 'products.quantity', 'products.description', 'products.image', 'products.status', 'products.create_at', 'products.update_at'])
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        // dd($data['hotTrend']);
        return view('client.navigation.home.index', $data);
    }
}
