<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function sendMail(Request  $request){
        $subject = "Invited to join a group";

        Mail::send('emails.testmail', ['groupcode' => 'sdfsdfs'], function ($message) use ($request, $subject) {
            $message->from('noreply@yoolah.com', 'Yoolah');
            $message->subject($subject);
            $message->to("m.aliahmed0@gmail.com");
        });

    }
}
