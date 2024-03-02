<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data = 'Hello Test';
        return redirect('/')->with('message', $data);
    }
}
