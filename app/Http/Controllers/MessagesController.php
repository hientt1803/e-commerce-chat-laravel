<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'cvs_id' => 'required'
        ]);

        $msg = new Messages;
        $msg->content = $request->content;

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'user') {
            $msg->sender_type = 'user';
            $msg->receiver_type = 'customer';

            $msg->sender_id = Auth::user()->user_id;
            $msg->receiver_id = $request->customer_id;
        } else {
            $msg->sender_type = 'customer';
            $msg->receiver_type = 'user';

            $msg->sender_id = Auth::user()->user_id;
            $msg->receiver_id = 1;
        }

        // create foreign
        $conversion = Conversion::find($request->cvs_id);
        $msg->conversion()->associate($conversion);

        // dd($msg);

        $msg->save();

        // return redirect()->route('conversation-management', ['cvs_id' => $request->cvs_id]);
        return redirect('/admin/conversation-management/' . $request->cvs_id);
    }
}
