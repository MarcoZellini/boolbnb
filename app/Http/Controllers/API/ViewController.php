<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\View;
use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use Carbon\Carbon;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViewRequest $request)
    {

        $val_data = $request->validated();

        $apartment_id = $val_data['apartment_id'];

        $ip_address = $val_data['ip_address'];

        $date = $val_data['date'];

        if (!View::where('ip_address', $ip_address)
            ->where('apartment_id', $apartment_id)
            ->where('date', '>', Carbon::parse($date)->subDay()->format('Y-m-d H:i:s'))
            ->exists()) {

            $new_view = View::create($val_data);

            return response()->json(['message' => 'Visita aggiunta al database']);
        }

        return response()->json(['message' => 'Visitato entro le 24 ore']);
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        //
    }
}
