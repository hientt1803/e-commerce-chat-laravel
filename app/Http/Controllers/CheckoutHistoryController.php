<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutHistoryController extends Controller
{
    public function index()
    {
        $data[] = null;
        return view('client.navigation.checkout.history', $data);
    }
}
