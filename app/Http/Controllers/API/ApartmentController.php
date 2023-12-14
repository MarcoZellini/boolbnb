<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;

class ApartmentController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Apartment::with(['images', 'sponsorships', 'user', 'services'])->paginate(20)
        ]);
    }

    public function singleApartment($id)
    {

        $apartment = Apartment::with(['images', 'sponsorships', 'user', 'services'])->where('id', $id)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'result' => $apartment
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'There is no apartment'
            ]);
        }
    }

    // ricerca: appartamenti entro un raggio variabile + filtri
    public function search(Request $request)
    {
        $inputAddressLat = $request->all('inputAddressLat');
        $inputAddressLong = $request->all('inputAddressLong');
        $maxRadius = $request->all('maxRadius');
        $minBeds = $request->all('minBeds');
        $minRooms = $request->all('minRooms');

        $apartments = Apartment::with(['images', 'sponsorships', 'user', 'services'])
            ->whereRaw('st_distance_sphere(point(apartments.latitude,apartments.longitude),point(' . implode($inputAddressLat) . ',' . implode($inputAddressLong) . ')) <=' . implode($maxRadius) . '000')
            ->where('beds', '>=', $minBeds)
            ->where('rooms', '>=', $minRooms)
            ->orderByRaw('st_distance_sphere(point(apartments.latitude,apartments.longitude),point(' . implode($inputAddressLat) . ',' . implode($inputAddressLong) . '))')
            ->get();

        return response()->json([
            'success' => true,
            'result' => $apartments
        ]);
    }

    // rotta appart sponsorizzati
}
