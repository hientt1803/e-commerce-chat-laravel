<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;

class CheckoutHistoryController extends Controller
{
    public function index()
    {
        $user = session('customer');
        if (!$user) {
            return redirect('login')->with('success', 'Vui lòng đăng nhập!');
        }

        $data['orderHistory'] = Order::where('customer_id', session('customer')->customer_id)->orderByDesc('status')->orderByDesc('create_at')->with('orderDetail.product')->paginate(10);
        // dd(session('customer')); 31
        // dd($data);
        return view('client.navigation.checkout.history', $data);
    }

    public function updateOrderStatus($id)
    {
        $order = Order::find($id);
        $orderUpdateProduct = Order::with('orderDetail.product')->find($id);

        if (!$orderUpdateProduct) {
            return redirect()->route('checkout-history')->with('success', 'Đơn hàng không tồn tại');
        }
        
        $order->status = 'đã giao';

        $order->update();

        foreach ($orderUpdateProduct->orderDetail as $index => $od) {
            $product = Products::find($od->product->product_id);
            if ($product) {
                $product->quantity -= $od->quantity;
                $product->update();
            }
        }


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
