<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Models\Message;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $seconds = 0;
        $minutes = 0;
        $hours = 0;

        $total_apartments = Apartment::where('user_id', Auth::id())->count();
        /* Da ricontrollare?? 👇 ( ´･･)ﾉ(._.`) */
        $total_messages = Message::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();;

        foreach (Apartment::where('user_id', Auth::id())->get() as $apartment) {

            $sponsorships = $apartment->sponsorships;

            foreach ($sponsorships as $sponsorship) {

                $hour_minutes_seconds_list = explode(':', $sponsorship->duration);

                $seconds += (int)$hour_minutes_seconds_list[2];
                $minutes += (int)$hour_minutes_seconds_list[1];
                $hours += (int)$hour_minutes_seconds_list[0];
            }
        }

        $final_seconds = (int)($seconds % 60);
        $final_minutes = (int)(($seconds / 60) + (int)($minutes)) % 60;
        $final_hours = (int)($hours) + (int)((($seconds / 60) + ($minutes)) / 60);

        return view('admin.dashboard', [
            'total_apartments' => $total_apartments,
            'total_messages' => $total_messages,
            'total_sponsorships_time' => [
                'hours' => $final_hours,
                'minutes' => $final_minutes,
                'seconds' => $final_seconds,
            ],
        ]);
    }
}
