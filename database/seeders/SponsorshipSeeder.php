<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Sponsorship::create([
            'name' => 'BASIC',
            'price' => 3.99,
            'duration' => '24:00:00',
        ]);
        Sponsorship::create([
            'name' => 'ADVANCED',
            'price' => 5.99,
            'duration' => '72:00:00',
        ]);
        Sponsorship::create([
            'name' => 'PREMIUM',
            'price' => 9.99,
            'duration' => '144:00:00',
        ]);
    }
}
