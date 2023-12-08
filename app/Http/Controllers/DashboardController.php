<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use PharIo\Manifest\Author;


class DashboardController extends Controller
{
    public function index()
    {
        $total_apartments = apartment::where('user_id', Auth::id())->count();
        /* Da ricontrollare?? 👇 ( ´･･)ﾉ(._.`) */
        $total_messages = Message::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();;


        return view('dashboard', compact('total_apartments', 'total_messages'));
    }
}
