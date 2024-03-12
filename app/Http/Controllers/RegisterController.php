<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => ['required', 'email', 'max:50', Rule::unique('customers', 'email')],
            'password' => 'required|min:5|max:20',
            'agreement' => 'required'
        ]);

        $request['password'] = bcrypt($request['password']);

        $customer = new Customers;
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->password = $request->password;
        $customer->status = true;

        $customer->save();

        // Create a cart for each customer
        $cart = new Cart;
        $cart->customer()->associate($customer);
        $cart->status = true;

        $cart->save();

        return redirect()->route('login')->with('success', 'Tài khoản đã được tạo thành công!');

        // $attributes = request()->validate([
        //     'name' => ['required', 'max:50'],
        //     'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
        //     'password' => ['required', 'min:5', 'max:20'],
        //     'agreement' => ['accepted']
        // ]);
        // $attributes['password'] = bcrypt($attributes['password']);



        // session()->flash('success', 'Your account has been created.');
        // $user = User::create($attributes);
        // Auth::login($user);
        // return redirect('/dashboard');
    }
}
