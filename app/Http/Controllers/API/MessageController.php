<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all()['message'],
            [
                'apartment_id' => ['required'],
                'name' => ['required', 'string', 'max:50'],
                'lastname' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email'],
                'phone' => ['required',],
                'subject' => ['required', 'string', 'max:50'],
                'message' => ['required', 'string'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }



        /* Message::create([
            'apartment_id' => $request->apartment_id,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]); */

        $stored_message = Message::create($request->all()['message']);

        return response()->json([
            'success' => true,
            'result' => $stored_message
        ]);
    }
}
