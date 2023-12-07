<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = DB::table('messages')
            ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
            ->select('*')
            ->where('apartments.user_id', Auth::id())
            ->orderByDesc('messages.id')
            ->paginate(10);

        return view('admin.messages.index', ['messages' => $messages]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //dd('sto per eliminare');
        $message->delete();

        return to_route('admin.messages.index')->with('message', 'messaggio eliminato con successo!');
    }
}
