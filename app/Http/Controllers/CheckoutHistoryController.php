<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutHistoryController extends Controller
{
    public function index()
    {
        $data['orderHistory'] = Order::where('customer_id', session('customer')->customer_id)->orderByDesc('status')->orderByDesc('create_at')->with('orderDetail.product')->paginate(10);
        // dd(session('customer')); 31
        // dd($data);
        return view('client.navigation.checkout.history', $data);
    }

    public function updateOrderStatus($id)
    {
        $order = Order::find($id);

        $order->status = 'đã giao';

        $order->update();

        return redirect()->route('checkout-history')->with('success', 'Đã xác nhận hoàn thành đơn hàng');
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);

        $order->status = 'đã hủy';

        $order->update();

        return redirect()->route('checkout-history')->with('success', 'Đã xác nhận hoàn thành đơn hàng');
    }
}
