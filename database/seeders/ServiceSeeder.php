<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicesArray = config('apartmentServices');

        foreach ($servicesArray as $service) {

            //dd($service['name']);

            $newservice = new Service();
            $newservice->name = $service['name'];
            //$newservice->icon = $service['icon'];
            $newservice->save();
        }
    }
}
