<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Models\Message;
use App\Models\View;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $seconds = 0;
        $minutes = 0;
        $hours = 0;

        $total_apartments = Apartment::where('user_id', Auth::id())->count();

        /* total messages */
        /* Da ricontrollare?? 👇 ( ´･･)ﾉ(._.`) */
        $total_messages = Message::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        /* Total Messages by year */
        $total_year_messages = Message::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->selectRaw('YEAR(created_at) as year, count(*) as messages')
            ->groupBy('year')
            ->get();

        /* Total Messages by month  */
        $total_month_messages = Message::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, count(*) as messages')
            ->groupBy('year', 'month')
            ->get();

        /* Total Views */
        $total_views = View::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        /* Total Views by year */
        $total_year_views = View::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->selectRaw('YEAR(date) as year, count(*) as views')
            ->groupBy('year')
            ->get();

        /* Total Views by month  */
        $total_month_views = View::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->selectRaw('YEAR(date) as year, MONTH(date) as month, count(*) as views')
            ->groupBy('year', 'month')
            ->get();

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
            'total_year_views' => $total_year_views,
            'total_month_views' => $total_month_views,
            'total_year_messages' => $total_year_messages,
            'total_month_messages' => $total_month_messages,

        ]);
    }
}
