<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function index()
    {
        $data['customers'] = Customers::orderBy('status', 'desc')->orderBy('customer_id', 'desc')->paginate(10);
        return view('admin.laravel-navigation.customers.index', $data);
    }

    public function create()
    {
        $data['customers'] = Customers::where('status', 1)->get();
        // dd($data);
        return view('admin.laravel-navigation.customers.add-new', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|min:5|max:20',
            'birthday' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $customer = new Customers;
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->birthday = $request->birthday;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->status = true;

        $customer->save();

        return redirect()->route('customers-management')->with('success', 'Customers created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customers $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['customer'] = Customers::find($id);
        // dd($data);
        return view('admin.laravel-navigation.customers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            // 'password' => 'required|min:5|max:20',
            'birthday' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        // $request['password'] = bcrypt($request['password'] );

        $customer = Customers::find($id);

        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        // $customer->password = $request->password;
        $customer->birthday = $request->birthday;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->status = true;

        $customer->update();

        // dd('what?');

        return redirect()->route('customers-management')->with('success', 'Customer update successfully!');
    }

    public function destroy($id)
    {
        $customer = Customers::find($id);

        $customer->status = !$customer->status;

        $customer->update();

        return redirect()->route('customers-management')->with('success', 'Customers deleted successfully!');
    }
}
