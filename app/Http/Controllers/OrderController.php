<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['orders'] = Order::orderBy('create_at', 'desc')->orderByDesc('status')->with('orderDetail.product.categories')->paginate(15);
        // dd($data);
        return view('admin.laravel-navigation.orders.index', $data);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $orders = Order::query();

        if ($search) {
            $orders = $orders->where('order_id', 'LIKE', "%{$search}%");
        }

        $orders = $orders->paginate(10);

        return view('admin.laravel-navigation.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $order = Order::find($id);
        // $orderDetail = Order_detail::find($order->order_id)->with('product');

        // dd($order, $orderDetail);
        // redirect()->route('orders-management', compact($order, $orderDetail));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        // $order->status = 'đang giao';
        $order->status = 'đang giao';

        $order->update();

        return redirect()->route('orders-management')->with('success', 'orders update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->status = 'đã hủy';

        $order->update();

        return redirect()->route('orders-management')->with('success', 'orders deleted successfully!');
    }
}
