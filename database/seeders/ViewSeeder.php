<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\View;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* $apartments = DB::table('apartments')
            ->pluck('id')
            ->toArray(); */

        $apartments = DB::table('apartments')
            ->select('id', 'created_at')
            ->get();

        foreach ($apartments as $apartment) {

            $apartment_created_at = Carbon::parse($apartment->created_at);

            for ($i = 0; $i < 100; $i++) {

                $new_view = new View();
                $new_view->apartment_id = $apartment->id;
                $new_view->ip_address = long2ip(mt_rand());

                $random_date = Carbon::create(
                    rand($apartment_created_at->year, Carbon::now()->year),
                    rand(1, 12),
                    rand(1, 28),
                    rand(0, 24),
                    rand(0, 60),
                    rand(0, 60)
                );
                $new_view->date = $random_date->between($apartment_created_at, Carbon::now()) ? $random_date : $apartment_created_at;
                $new_view->save();
            }
        }
    }
}
