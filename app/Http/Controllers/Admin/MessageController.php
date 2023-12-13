<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = DB::table('messages')
            ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
            ->select('messages.id', 'messages.apartment_id', 'apartments.title', 'messages.name', 'messages.lastname', 'messages.email', 'messages.phone', 'messages.subject', 'messages.message')
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
        $previous_url = URL::previous();
        $message->delete();

        $alert = 'messaggio eliminato con successo!';

        if (str_contains($previous_url, 'admin/apartments')) {
            return to_route('admin.apartments.show', $message->apartment_id)->with('message', $alert);
        } else {
            return to_route('admin.messages.index')->with('message', $alert);
        }
    }
}
