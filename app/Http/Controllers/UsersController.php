<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::orderBy('role', 'desc')->paginate(10);
        return view('admin.laravel-navigation.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laravel-navigation.users.add-new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'required',
            'password' => 'required',
            'address' => '',
            'phone' => 'required|string',
            'gender' => 'required',
            'role' => 'required'
        ]);

        $user = new User;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->role = $request->role;

        // Store image
        $imagePath = $request->file('image')->store('users_images', 'public');
        $user->image = $imagePath;

        $user->save();

        return redirect()->route('users-management')->with('success', 'Users created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        // dd($data);
        return view('admin.laravel-navigation.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required',
            'address' => '',
            'phone' => 'required|string',
            'gender' => 'required',
            'role' => 'required'
        ]);

        $user = User::find($id);
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->role = $request->role;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users_images', 'public');
            $user->image = $imagePath;
        }

        $user->update();

        return redirect()->route('users-management')->with('success', 'Users updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->role == 'admin') {
            return redirect()->route('users-management')->with('success', 'Cannot deleted yourself');
        }

        $user->delete();

        return redirect()->route('users-management')->with('success', 'Users deleted successfully!');
    }
}
