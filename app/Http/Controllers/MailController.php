<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function sendMail(Request  $request){


        $sale=Sale::find(27);

//        return view('emails.testmail',compact('sale'));
        $subject = "Order Confirmation";
//
        Mail::send('emails.testmail', compact('sale'), function ($message) use
        ($sale, $request, $subject) {
            $message->from('info@amaratmaterials.com', 'Amarat Materials');
            $message->subject($subject);
            $message->to($sale->customer->email);
        });

    }
}
