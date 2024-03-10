<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return redirect('admin/dashboard')->with(['success' => 'You are logged in.']);
        } else {
            $customer = Customers::where('email', $attributes['email'])->first();

            if ($customer && Hash::check($attributes['password'], $customer->password)) {
                session(['customer' => $customer]);
                return redirect('/')->with(['success' => 'You are logged in as a customer.']);
            } else {
                return back()->withErrors(['email' => 'Email or password invalid.']);
            }
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->forget('customer');
        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
