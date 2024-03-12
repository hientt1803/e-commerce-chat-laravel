<?php

namespace App\Http\ViewComposers;

use App\Models\Cart_detail;
use Illuminate\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $user = session('customer');
        $cartQuantity = 0;
        if ($user) {
            $cartQuantity = Cart_detail::whereHas('cart', function ($query) use ($user) {
                $query->whereHas('customer', function ($query) use ($user) {
                    $query->where('customer_id', $user->customer_id);
                });
            })->count();
        }
        $view->with('cartCount', $cartQuantity);
    }
}
