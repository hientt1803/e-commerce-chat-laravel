<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleEmail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $recipient = 'hienttpc03323@fpt.edu.vn'; // Change to the recipient's email address
        $data = [
            'name' => 'Deepak Prasad',
            'username' => 'deeepak_pd',
            'welcomeMessage' => 'Thank you for joining our platform! We’re excited to have you with us.',
            'startLink' => 'https://example.com/get-started'
        ];

        Mail::to($recipient)->send(new SampleEmail($data['name'], $data['username'], $data['welcomeMessage'], $data['startLink']));

        return response()->json(['message' => 'Email sent successfully to ' . $recipient]);
    }
}
