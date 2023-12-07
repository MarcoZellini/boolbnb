<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::orderByDesc('id')->paginate(10);
        return view('admin.messages.index', ['messages' => $messages]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {

        //dd('sto per eliminare');
        $message->delete();

        return to_route('admin.messages.index')->with('message', 'message successfully deleted');
    }
}
