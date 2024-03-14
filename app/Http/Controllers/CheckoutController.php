<?php

namespace App\Http\Controllers;

use App\Models\Cart_detail;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);
        session(['selected_items' => $selectedItems]);

        $selectedItems = session('selected_items', []);

        if (!$selectedItems) {
            return redirect('/cart')->with('toastMsg', 'Vui lòng chọn sản phẩm cần thanh toán');
        }

        $cartDetails = Cart_detail::whereIn('cart_detail_id', $selectedItems)->with(['product'])->get();

        // dd($cartDetails);
        return view('client.navigation.checkout.index', compact('cartDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_receiver' => 'required',
            'phone_receiver' => 'required',
            'address_receiver' => 'required',
        ]);

        // dd($request);

        $order = new Order();
        $order->name_receiver = $request->name_receiver;
        $order->phone_receiver = $request->phone_receiver;
        $order->address_receiver = $request->address_receiver;
        $order->notes = $request->notes;
        $order->total_price = $request->totalPrice;

        // create constrain
        $customer = Customers::find(session('customer')->customer_id);
        $order->customer()->associate($customer);

        $order->save();

        // Thêm sản phẩm vào bảng orderDetails
        foreach ($request->productDetail as $item) {
            $orderDetail = new Order_detail();
            $orderDetail->order_id = $order->order_id;
            $orderDetail->product_id = $item['product_id'];
            $orderDetail->price = $item['price'];
            $orderDetail->quantity = $item['quantity'];

            $orderDetail->save();

            // delete item from cartDetail
            $cartDetail = Cart_detail::find($item['cart_detail_id']);
            if ($cartDetail) {
                $cartDetail->delete();
            }
        }

        return redirect()->route('cart')->with('toastMsg', 'Đặt hàng thành công!');
    }
}
