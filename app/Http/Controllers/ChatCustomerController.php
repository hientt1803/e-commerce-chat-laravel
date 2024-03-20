<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Messages;
use Illuminate\Http\Request;

class ChatCustomerController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $conversion = Conversion::OrderBy('create_at', 'desc')
            ->where('customer.customer_id', session('customer_id'))
            ->get();

        $msg = new Messages;
        $msg->content = $request->content;

        if ($conversion) {
            $msg->sender_type = 'customer';
            $msg->receiver_type = 'user';

            $msg->sender_id = session('customer')->customer_id;
            $msg->receiver_id = 1;

            $msg->conversion()->associate($conversion);

            $msg->save();
        } else {
            $newConversation = new Conversion;
            $newConversation->status = true;
            $newConversation->save();

            $msg->sender_type = 'customer';
            $msg->receiver_type = 'user';

            $msg->sender_id = session('customer')->customer_id;
            $msg->receiver_id = 1;

            // create foreign
            $msg->conversion()->associate($newConversation);

            $msg->save();
        }

        return response()->json(['status' => 200, 'message' => 'message send success', 'data' => $msg]);
    }
}
