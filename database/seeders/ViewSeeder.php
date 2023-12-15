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
        $apartments = DB::table('apartments')
            ->pluck('id')
            ->toArray();

        for ($i = 0; $i < 100; $i++) {
            $new_view = new View();
            $new_view->apartment_id = $apartments[rand(0, count($apartments) - 1)];
            $new_view->ip_address = long2ip(mt_rand());
            $new_view->date = Carbon::create(2024, rand(1, 12), rand(1, 28), rand(0, 24), rand(0, 60), rand(0, 60));
            $new_view->save();
        }
    }
}
