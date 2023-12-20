<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Message;
use Illuminate\Support\Str;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\View;
use Carbon\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.apartments.index', ['apartments' => Apartment::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(10)])->with('message', 'Appartamento sponsorizzato con successo!');;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.apartments.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $val_data = $request->validated();

        $cordinates = [
            'lat' => 0.0,
            'lon' => 0.0,
        ];

        $GeocodeUrl = "https://api.tomtom.com/search/2/geocode/";
        $TomtomKey = env('TOMTOM_KEY');
        $address = str_replace(' ', '%20', $val_data['address']);

        $GeoResponse = Http::withoutVerifying()->get($GeocodeUrl . $address .  ".json?key=" . $TomtomKey);

        if (isset($val_data['address']) && $val_data['address'] !== null) {
            if ($GeoResponse->successful()) {
                $cordinates = $GeoResponse['results'][0]['position'];
            }
        }

        $apartment = Apartment::create([
            'user_id' => Auth::user()->id,
            'title' => $val_data['title'],
            'slug' => Str::slug($val_data['title']),
            'description' => $val_data['description'],
            'rooms' => $val_data['rooms'],
            'beds' => $val_data['beds'],
            'bathrooms' => $val_data['bathrooms'],
            'square_meters' => $val_data['square_meters'],
            'address' => $val_data['address'],
            'latitude' =>  $cordinates['lat'],
            'longitude' =>  $cordinates['lon'],
            'is_visible' => $val_data['is_visible'],
        ]);

        //validazione e salvataggio immagini

        if ($images = $request->images) {
            foreach ($images as $image) {
                $path = Storage::put('apartments', $image);
                Image::create([
                    'apartment_id' => $apartment->id,
                    'path' => $path,
                    'is_main' => Image::where('apartment_id', $apartment->id)->get()->count() < 1 ? 1 : 0
                ]);
            }
        }

        $apartment->services()->attach($request->services);

        return to_route('admin.apartments.index')->with('message', 'Appartamento creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {

            if ($request->input('start_date') && $request->input('end_date')) {
                $start_date = $request->input('start_date');
                $end_date = $request->input('end_date');
            } else {
                $current_year = Carbon::now()->year;
                $start_date = $current_year . '-01-01';
                $end_date = $current_year . '-12-31';
            }

            $services = Service::all();
            $apartment_id = $apartment->id;

            /* Total Messages by month  */
            $total_month_messages = Message::whereHas('apartment', function ($query) use ($apartment_id) {
                $query->where('apartment_id', $apartment_id);
            })->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, count(*) as messages')
                ->groupBy('year', 'month')
                ->where('created_at', '>=', $start_date)
                ->where('created_at', '<=', $end_date)
                ->orderBy('year',)
                ->orderBy('month',)
                ->get();

            /* Total Views */
            $total_views = View::whereHas('apartment', function ($query) use ($apartment_id) {
                $query->where('apartment_id', $apartment_id);
            })->count();

            /* Total Views by month  */
            $total_month_views = View::whereHas('apartment', function ($query) use ($apartment_id) {
                $query->where('apartment_id', $apartment_id);
            })->selectRaw('YEAR(date) as year, MONTH(date) as month, count(*) as views')
                ->groupBy('year', 'month')
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->orderBy('year',)
                ->orderBy('month',)
                ->get();

            // STYLE CLASSES ARRAY
            $styleClasses = ['bnb-mid-img', 'bnb-tr-img', 'bnb-mid-img', 'bnb-br-img'];

            // STYLE CLASSES INDEX
            $styleIndex = 0;

            return view(
                'admin.apartments.show',
                [
                    'apartment' => $apartment,
                    'services' => $services,
                    'total_views' => $total_views,
                    'total_month_views' => $total_month_views,
                    'total_month_messages' => $total_month_messages,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'styleClasses' => $styleClasses,
                    'styleIndex' => $styleIndex,
                ],
            );
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {
            return view(
                'admin.apartments.edit',
                [
                    'apartment' => $apartment,
                    'services' => Service::all()
                ]
            );
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {

            $val_data = $request->validated();
            $val_data['slug'] = Str::slug($val_data['title']);
            $GeocodeUrl = "https://api.tomtom.com/search/2/geocode/";
            $TomtomKey = env('TOMTOM_KEY');
            $address = str_replace(' ', '%20', $val_data['address']);

            if ($request->has('address') && $request->address != $apartment->address) {
                if (isset($val_data['address']) && $val_data['address'] !== null) {
                    $GeoResponse = Http::withoutVerifying()->get($GeocodeUrl . $address .  ".json?key=" . $TomtomKey);
                    if ($GeoResponse->successful()) {
                        $cordinates = $GeoResponse['results'][0]['position'];
                        $apartment->latitude = $cordinates['lat'];
                        $apartment->longitude = $cordinates['lon'];
                        $apartment->save();
                    }
                }
            }

            $apartment->update($val_data);

            if ($images = $request->images) {
                foreach ($images as $image) {
                    $path = Storage::put('apartments', $image);
                    Image::create([
                        'apartment_id' => $apartment->id,
                        'path' => $path,
                        'is_main' => Image::where('apartment_id', $apartment->id)->get()->count() < 1 ? 1 : 0
                    ]);
                }
            }

            $apartment->services()->sync($request->services);

            return to_route('admin.apartments.index')->with('message', "Aggiornamento dell'appartamento $apartment->title  effettuato con successo!");
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {


            // eliminazione dei record dei messaggi associati a questo appartamento
            $apartment->messages()->delete();

            //applicazione metodo detach alla tabella apartment_service
            $apartment->services()->detach();
            //applicazione metodo detach alla tabella apartment_sponsorship
            $apartment->sponsorships()->detach();

            foreach ($apartment->images as $image) {
                Storage::delete($image->path);
            }
            // eliminazione dei record delle immagini associate a questo appartamento
            $apartment->images()->delete();
            // eliminazione dei record delle visualizzazioni associate a questo appartamento
            $apartment->views()->delete();

            $apartment->delete();

            return to_route('admin.apartments.index')->with('message', 'appartamento eliminato con successo!');
        } else {
            abort(403);
        }
    }
}
