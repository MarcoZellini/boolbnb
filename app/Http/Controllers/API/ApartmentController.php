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
            'result' => Apartment::with(['images', 'sponsorships', 'user', 'services'])->paginate(20)
        ]);
    }

    public function apartments(Request $request)
    {

        $id = $request->all();

        $apartments = DB::table('apartments')->whereIn('id', $id)->get();

        return response()->json([
            'success' => true,
            'result' => $apartments
        ]);
    }

    // ricerca semplice: appartamenti entro un raggio di 20 km
    public function search(Request $request)
    {
        $apartments = Apartment::all();
        $responseArray = [];

        foreach ($apartments as $apartment) {
            $responseItem = [
                'id' => $apartment->id,
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

        //dd($responseArray);

        return response()->json($responseArray);
    }

    // ricerca avanzata: appartamenti entro un raggio variabile + filtri
    public function advancedSearch(Request $request)
    {
        $id = $request->query('id');
        $min_beds = $request->query('beds');
        $min_rooms = $request->query('rooms');
        //$radius = $request->query('radius');

        dd($id);

        $apartments = Apartment::where('id', $id)
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
