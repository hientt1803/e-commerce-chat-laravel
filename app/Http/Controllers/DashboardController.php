<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['customers'] = DB::select("SELECT * FROM customers;");
        return view('admin.dashboard', $data);
    }


}
