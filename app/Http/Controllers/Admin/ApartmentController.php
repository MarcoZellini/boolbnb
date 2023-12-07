<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Str;
use App\Models\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.apartments.index', ['apartments' => Apartment::where('user_id', Auth::user()->id)->get()]);
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

        $request->validate([
            'services' => ['required', 'array', 'min:1']
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
            'latitude' => ((rand(0, 90000000) / 1000000) * (rand(0, 1) ? 1 : -1)),
            'longitude' => ((rand(0, 180000000) / 1000000) * (rand(0, 1) ? 1 : -1)),
            'is_visible' => $val_data['is_visible'],
        ]);


        $apartment->services()->attach($request->services);

        return to_route('admin.apartments.index')->with('message', 'Appartamento creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', ['apartment' => $apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        return view(
            'admin.apartments.edit',
            [
                'apartment' => $apartment,
                'services' => Service::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $val_data = $request->validated();

        $request->validate([
            'services' => ['required', 'array', 'min:1']
        ]);

        $apartment->update($val_data);

        $apartment->services()->sync($request->services);

        return to_route('admin.apartments.index')->with('message', 'Aggiornamento effettuato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
