<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Messages;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['conversions'] = Conversion::OrderBy('create_at', 'desc')
            ->with(['messages' => function ($query) {
                $query->orderBy('create_at', 'desc')->first();
            }])
            ->with('user')
            ->with('customer')
            ->get();

        // dd($data);
        return view('admin.laravel-navigation.conversation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $messages = Messages::where('cvs_id', $id)
            ->orderBy('send_time', 'asc')
            ->with('conversion')
            ->get();

        $data['messages'] = $messages;
        $data['cvs_id'] = $id;

        $latestMessage = Messages::where('cvs_id', $id)
            ->orderBy('send_time', 'desc')
            ->with('conversion.customer')
            ->latest()
            ->first();

        if ($latestMessage) {
            $latestMessage->update(['status' => 'read']);

            // dd($latestMessage);
            $data['customer'] = $latestMessage->conversion->customer;
        }

        // dd($data['customer']);

        return view('admin.laravel-navigation.conversation.inbox', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversion $conversion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversion $conversion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversion $conversion)
    {
        //
    }
}
