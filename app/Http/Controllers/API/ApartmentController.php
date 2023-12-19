<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{
    public function index()
    {
        $field_string = '';
        $sponsorized_apartments = DB::table('apartment_sponsorship')
            ->select('apartment_id')
            ->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->groupBy('apartment_id')
            ->get();

        foreach ($sponsorized_apartments as $apartment) {
            $field_string !== '' ? $field_string .= ',' . $apartment->apartment_id : $field_string .= $apartment->apartment_id;
        }

        /*  */
        $query = Apartment::with([
            'images',
            'sponsorships' => function ($query) {
                $query->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))->orderByDesc('end_date');
            },
            'user',
            'services'
        ]);

        if ($field_string) {
            $apartments = $query->orderByRaw('FIELD(id, ' . $field_string . ') DESC')->paginate(20);
        } else {
            $apartments = $query->paginate(20);
        }

        $apartments = $apartments->toArray();

        foreach ($apartments['data'] as $key => $apartment) {
            if ($apartment['sponsorships']) {
                $apartments['data'][$key]['sponsorships'] = array_slice($apartment['sponsorships'], 0, 1);
            }
        }

        return response()->json([
            'success' => true,
            'result' => $apartments
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
        $field_string = '';

        $sponsorized_apartments = DB::table('apartment_sponsorship')
            ->select('apartment_id')
            ->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->groupBy('apartment_id')
            ->get();

        foreach ($sponsorized_apartments as $apartment) {
            $field_string !== '' ? $field_string .= ',' . $apartment->apartment_id : $field_string .= $apartment->apartment_id;
        }

        //$apartments = Apartment::with(['images', 'sponsorships', 'user', 'services'])->orderByRaw('FIELD(id, ' . $field_string . ') DESC')->paginate(20);

        /* $apartments */
        $query = Apartment::with([
            'images',
            'sponsorships' => function ($query) {
                $query->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))->orderByDesc('end_date');
            },
            'user',
            'services'
        ])->whereRaw('st_distance_sphere(point(apartments.latitude,apartments.longitude),point(' . implode($inputAddressLat) . ',' . implode($inputAddressLong) . ')) <=' . implode($maxRadius) . '000')
            ->where('beds', '>=', $minBeds)
            ->where('rooms', '>=', $minRooms);

        if ($field_string) {
            $apartments = $query->orderByRaw('FIELD(id, ' . $field_string . ') DESC, st_distance_sphere(point(apartments.latitude,apartments.longitude),point(' . implode($inputAddressLat) . ',' . implode($inputAddressLong) . '))')
                ->paginate(20);
        } else {
            $apartments = $query->orderByRaw('st_distance_sphere(point(apartments.latitude,apartments.longitude),point(' . implode($inputAddressLat) . ',' . implode($inputAddressLong) . '))')
                ->paginate(20);
        }

        $apartments = $apartments->toArray();

        foreach ($apartments['data'] as $key => $apartment) {
            if ($apartment['sponsorships']) {
                $apartments['data'][$key]['sponsorships'] = array_slice($apartment['sponsorships'], 0, 1);
            }
        }

        return response()->json([
            'success' => true,
            'result' => $apartments
        ]);
    }

    // rotta appart sponsorizzati
}
