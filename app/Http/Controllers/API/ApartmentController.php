<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Apartment::all()
        ]);
    }

    // ricerca semplice: appartamenti entro un raggio di 20 km
    public function search(Request $request)
    {
        /* 
        $distance = 400000;
        $TomTomKey = 'QTQljhHM9rS4d2vJLMcDX9qzl8tyGA43';

        $baseUrl = 'https://api.tomtom.com/search/2/geometryFilter.json?key=' . $TomTomKey;

        $circle = '[{"position": "45.3967794,11.9139147","radius": 45000,"type": "CIRCLE"}]';
        $poi = '[{"address": {"freeformAddress": "Strada Statale Romea, 101, 30015 Chioggia VE"},"poi": {"name": "MC Chioggia"},"position": {"lat": 45.1804672,"lon": 12.2703012}}]';

        $completeUrl = $baseUrl . '&geometryList=' . $circle . '&poiList=' . $poi;

        [{"address": {"freeformAddress": "Strada Statale Romea, 101, 30015 Chioggia VE"},"poi": {"name": "MC Chioggia"},"position": {"lat": 45.1804672,"lon": 12.2703012}}]
         */

        $apartments = DB::table('apartments')
            ->select('title', 'address', 'latitude', 'longitude')
            ->get();

        $responseArray = [];

        foreach ($apartments as $apartment) {

            $responseItem = [
                'address' => [
                    'freeformAddress' => $apartment->address
                ],
                'poi' => $apartment->title,
                'position' => [
                    'lat' => $apartment->latitude,
                    'lon' => $apartment->longitude
                ]
            ];

            array_push($responseArray, $responseItem);
        }

        return response()->json($responseArray);
    }

    // ricerca avanzata: appartamenti entro un raggio variabile + filtri
    public function advancedSearch(Request $request)
    {
        $address = $request->query('address');
        $min_beds = $request->query('beds');
        $min_rooms = $request->query('rooms');
        $distance = $request->query('distance');

        $apartments = Apartment::where('address', 'LIKE', '%' . $address . '%')
            ->where('beds', '>=', $min_beds)
            ->where('rooms', '>=', $min_rooms)
            ->get();

        return response()->json([
            'success' => true,
            'result' => $apartments
        ]);
    }

    // rotta appart sponsorizzati
}
