<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withoutVerifying()->get("https://3bd7e14b-0b57-4476-a3ec-2878f890c41f.mock.pstmn.io/https://idealista2.p.rapidapi.com/properties/list?locationId=0-EU-IT-MI&locationName=Milano&operation=rent&country=it&locale=it&maxItems=10");

        $TomtomKey = 'zGXu3iFl86vJs8yD3Uq6OGoANFEGzFkS';
        if ($response->successful()) {
            $apartments = $response->json()['elementList'];
            foreach ($apartments as $apartment) {
                $NewApartment = new Apartment();
                $NewApartment->user_id = 5;
                $NewApartment->title = $apartment['suggestedTexts']['title'];
                $slug = Str::slug($apartment['suggestedTexts']['title']);
                $NewApartment->slug = $slug;
                $NewApartment->description = $apartment['description'];
                $NewApartment->rooms = $apartment['rooms'];
                $NewApartment->bathrooms = $apartment['bathrooms'];
                $NewApartment->square_meters = $apartment['size'];
                $NewApartment->address = $apartment['address'] . ', ' .  $apartment['municipality'] . ', ' . $apartment['province'];

                if (isset($apartment['address']) && $apartment['address'] !== null) {
                    $address =  $NewApartment->address;
                    $address = str_replace(' ', '%20', $address);
                    $Geocoding = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/" .  $address . ".json?key=" . $TomtomKey);
                    if ($Geocoding->successful()) {
                        $Coordinates = $Geocoding['results'][0]['position'];
                        $NewApartment->latitude = $Coordinates['lat'];
                        $NewApartment->longitude = $Coordinates['lon'];
                    }
                }
                $NewApartment->is_visible = 1;
                $NewApartment->save();
            }
        }
    }
}
