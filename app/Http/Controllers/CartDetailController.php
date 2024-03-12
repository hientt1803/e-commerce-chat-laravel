<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\Customers;
use App\Models\Products;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = session('customer');
        if (!$user) {
            return redirect('login')->with('success', 'Vui lòng đăng nhập!');
        }

        $user = session('customer');
        $cartDetails = Cart_detail::whereHas('cart', function ($query) use ($user) {
            $query->whereHas('customer', function ($query) use ($user) {
                $query->where('customer_id', $user->customer_id);
            });
        })
            ->with('product')
            ->get();
        // dd($cartDetails);
        return view('client.navigation.cart.index', compact('cartDetails'));
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
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if (!session('customer')) {
            return redirect('/shop/product-detail/' . $request->product_id)->with('message', 'Vui lòng đăng nhập!');
        }

        $customer = Customers::where('customer_id', session('customer')->customer_id)->with('carts')->first();
        $cart = Cart::find($customer->carts[0]->cart_id);

        $existingCartDetail = Cart_detail::where('cart_id', $cart->cart_id)
            ->where('product_id', $request->product_id)
            ->first();

        // dd($existingCartDetail);

        if ($existingCartDetail) {
            $existingCartDetail->quantity += $request->quantity;
            $existingCartDetail->save();
        } else {
            $cartDetail = new Cart_detail;
            $cartDetail->quantity = $request->quantity;
            $cartDetail->cart()->associate($cart);

            $product = Products::find($request->product_id);
            $cartDetail->product()->associate($product);

            $cartDetail->save();
        }

        // dd('run?');

        return redirect('/shop/product-detail/' . $request->product_id)->with('toastMsg', 'Thêm vào giỏ hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart_detail $cart_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart_detail $cart_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart_detail $cart_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartDetail = Cart_Detail::find($id);
        $cartDetail->delete();
        return redirect('/cart')->with('toastMsg', 'Xóa sản phẩm khỏi giỏ hàng thành công!');
    }
}
