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

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.apartments.index', ['apartments' => Apartment::where('user_id', Auth::user()->id)->paginate(10)]);
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

        $request->validate([
            'services' => ['required', 'array', 'min:1'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png', 'max:1024'],
        ]);

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
    public function show(Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {
            $services = Service::all();

            // STYLE CLASSES ARRAY
            $styleClasses = ['bnb-mid-img', 'bnb-tr-img', 'bnb-mid-img', 'bnb-br-img'];

            // STYLE CLASSES INDEX
            $styleIndex = 0;

            return view('admin.apartments.show', ['apartment' => $apartment, 'services' => $services], compact('styleClasses', 'styleIndex'));
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
        $val_data = $request->validated();

        $GeocodeUrl = "https://api.tomtom.com/search/2/geocode/";
        $TomtomKey = env('TOMTOM_KEY');
        $address = str_replace(' ', '%20', $val_data['address']);

        /*      dd($request->address); */

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

        $request->validate([
            'services' => ['required', 'array', 'min:1'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png', 'max:1024'],
        ]);

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        /*
            - le statistiche di questo appartamento vanno eliminate?
        */

        if ($apartment->user_id === Auth::id()) {


            // eliminazione dei record dei messaggi associati a questo appartamento
            $apartment->messages()->delete();

            //applicazione metodo detach alla tabella apartment_service
            $apartment->services()->detach();

            foreach ($apartment->images as $image) {
                Storage::delete($image->path);
            }
            // eliminazione dei record delle immagini associate a questo appartamento
            $apartment->images()->delete();

            $apartment->delete();

            return to_route('admin.apartments.index')->with('message', 'appartamento eliminato con successo!');
        } else {
            abort(403);
        }
    }
}
