<?php

use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ApartmentController;

use App\Http\Controllers\DashboardController;


use App\Http\Controllers\Admin\ImageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    if (Auth::check()) {
        return view('dashboard');
    } else {
        return view('auth.login');
    }
});

/* controllare se ha senso ＼(((￣(￣(￣▽￣)￣)￣)))／ */
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/apartments', ApartmentController::class);
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.delete');
    Route::put('/apartments/{apartment}/images/{image}', [ImageController::class, 'setMain'])->name('apartments.image.setMain');
    Route::delete('/apartments/{apartment}/images/{image}', [ImageController::class, 'destroy'])->name('apartments.image.delete');
    Route::get('/apartments/{apartment}/images', [ImageController::class, 'index'])->name('apartments.images.index');
    Route::get('/apartments/{apartment}/sponsorships', [SponsorshipController::class, 'index'])->name('apartments.sponsorships.index');
    Route::get('/apartments/{apartment}/sponsorships/{sponsorship}', [SponsorshipController::class, 'store'])->name('apartments.sponsorships.store');
});

require __DIR__ . '/auth.php';
