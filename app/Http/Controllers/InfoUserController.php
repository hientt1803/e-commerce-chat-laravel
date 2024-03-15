<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('admin/laravel-navigation/user-profile');
    }

    public function store(Request $request)
    {

        // $attributes = request()->validate([
        //     'fullname' => ['required', 'max:100'],
        //     'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->user_id)],
        //     'password'     => ['required'],
        //     'phone'     => ['required', 'max:11'],
        //     'gender' => ['required'],
        //     'address'    => [],
        // ]);
        // if ($request->get('email') != Auth::user()->email) {
        //     if (env('IS_DEMO') && Auth::user()->id == 1) {
        //         return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
        //     }
        // } else {
        // $attribute = request()->validate([
        //     'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->user_id)],
        // ]);
        // }
        // User::where('user_id', Auth::user()->user_id)
        //     ->update([
        //         'fullname'    => $attributes['fullname'],
        //         'email' => $attribute['email'],
        //         'password'     => $attributes['password'],
        //         'phone'     => $attributes['phone'],
        //         'gender' => $attributes['gender'],
        //         'address'    => $attributes["address"],
        //     ]);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required',
            'address' => 'string',
            'phone' => 'required|string',
            'gender' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        dd($request);

        $user = User::find(Auth()->user()->user_id);
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users_images', 'public');
            $user->image = $imagePath;
        }

        dd($user);

        $user->update();

        return redirect('/admin/user-profile')->with('success', 'Profile updated successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'birthday' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        // dd($request);

        $customer = Customers::find($id);

        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->birthday = $request->birthday;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->status = true;

        $customer->update();

        session(['customer' => $customer]);

        return redirect('/user/profile')->with('toasmg', 'Cập nhật Tài khoản thành công');
    }
}
