<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailTestController extends Controller
{
    public function sendMail()
    {
        $email = 'bagus.slamet@pralon.com';
        $dataEmail = [
            'title' => 'testing',
            'message' => 'success send mail',
        ];

        Mail::to($email)->send(new SendMail($dataEmail));
    }
}
