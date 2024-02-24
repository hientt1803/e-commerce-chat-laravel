<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'message' => 'Hello laravel'
        ];
        return view('client.home', $data);
    }
}
