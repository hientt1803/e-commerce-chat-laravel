<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutHistoryController extends Controller
{
    public function index()
    {
        $data['orderHistory'] = Order::where('customer_id', session('customer')->customer_id)->with('orderDetail')->paginate(10);
        // dd(session('customer')); 31
        // dd($data);
        return view('client.navigation.checkout.history', $data);
    }
}
