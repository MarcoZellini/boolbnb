<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicesArray = config('apartmentServices');

        foreach ($servicesArray as $service) {

            $icon_name = Str::slug($service, '-');
            $icon_path = 'storage/icons/' . $icon_name . '.svg';

            //dd($icon_path);

            $newservice = new Service();
            $newservice->name = $service;
            $newservice->icon = $icon_path;
            $newservice->save();
        }
    }
}
