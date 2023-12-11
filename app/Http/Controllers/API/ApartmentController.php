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
            'result' => Apartment::all()
        ]);
    }
}
