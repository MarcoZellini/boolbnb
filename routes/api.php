<?php

use App\Http\Controllers\API\ApartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('apartments', [ApartmentController::class, 'index']);
Route::get('apartments/{apartment}', [ApartmentController::class, 'singleApartment']);
Route::get('apartments/advSearch', [ApartmentController::class, 'advancedSearch']);
