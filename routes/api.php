<?php

use App\Http\Controllers\API\ApartmentController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\ViewController;
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
Route::get('search', [ApartmentController::class, 'search']);

Route::get('services', [ServiceController::class, 'index']);
Route::post('contacts', [MessageController::class, 'store']);
Route::post('views', [ViewController::class, 'store']);
