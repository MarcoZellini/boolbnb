<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Models\Message;
use App\Models\View;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $seconds = 0;
        $minutes = 0;
        $hours = 0;

        if ($request->input('start_date') && $request->input('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
        } else {
            $current_year = Carbon::now()->year;
            $start_date = $current_year . '-01-01';
            $end_date = $current_year . '-12-31';
        }
        /* magari dategli un occhio \(￣︶￣*\)) */
        $apartments = Apartment::where('user_id', Auth::id())->get();
        $total_cash = 0;

        foreach ($apartments as $apartment) {
            foreach ($apartment->sponsorships as $sponsorship) {
                $price = $sponsorship->price;
                $total_cash += $price;
            }
        }

        $total_apartments = Apartment::where('user_id', Auth::id())->count();

        /* total messages */
        /* Da ricontrollare?? 👇 ( ´･･)ﾉ(._.`) */
        $total_messages = Message::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        /* Total Messages by month  */
        $total_month_messages = Message::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, count(*) as messages')
            ->groupBy('year', 'month')
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->orderBy('year',)
            ->orderBy('month',)
            ->get();

        /* Total Views */
        $total_views = View::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        /* Total Views by month  */
        $total_month_views = View::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->selectRaw('YEAR(date) as year, MONTH(date) as month, count(*) as views')
            ->groupBy('year', 'month')
            ->where('date', '>=', $start_date)
            ->where('date', '<=', $end_date)
            ->orderBy('year',)
            ->orderBy('month',)
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

        return view(
            'admin.dashboard',
            [
                'total_apartments' => $total_apartments,
                'total_messages' => $total_messages,
                'total_views' => $total_views,
                'total_sponsorships_time' => [
                    'hours' => $final_hours,
                    'minutes' => $final_minutes,
                    'seconds' => $final_seconds,
                ],
                'total_month_views' => $total_month_views,
                'total_month_messages' => $total_month_messages,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_cash' => $total_cash,
            ],

        );
    }
}
