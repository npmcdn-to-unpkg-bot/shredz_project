<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends ResponseController
{
    public function sendEmail(Request $request)
    {
       $data = $request->all();
        $rules = [
            "name"=>"required",
            "message"=>"required|min:10",
            "email"=>"required|confirmed|email",
        ];

        $input = [
            "name"=>$data['name'],
            "message"=>$data['message'],
            "email"=>$data['email'],
            "email_confirmation"=>$data['email_confirmation']
        ];

        $validation = Validator::make($input,$rules);

        if($validation -> fails())
        {
            //return $this->setError("Validation failed.")->setWarnings($validation->messages())->respondAPI(); //this is from combustion
            return response()->json($validation->errors(), 422);
        }

        Mail::send('emails.newTicket', ['data'=>$data], function($message) use ($input) {
            $message->to('support@shredz.com')
                ->replyTo($input['email'], $input['name'])
                ->subject('SHREDZ support ticket');
        });

        return $this->setData("Support ticket was submitted")->respondAPI();
    }
}
