<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{

    public function index(Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {
            return view('admin.apartments.images.index', ['apartment' => $apartment]);
        } else {
            abort(403);
        }
    }


    public function setMain(Apartment $apartment, Image $image)
    {
        if ($apartment->user_id === Auth::id()) {
            $main_image = Image::where('apartment_id', $apartment->id)->where('is_main', '1')->first();
            $main_image->update([
                'is_main' => 0
            ]);

            $image->update([
                'is_main' => 1
            ]);

            return to_route('admin.apartments.images.index', $apartment)->with('message', 'Immagine principale sostituita con successo.');
        } else {
            abort(403);
        }
    }

    public function destroy(Apartment $apartment, Image $image)
    {
        if ($apartment->user_id === Auth::id()) {
            $was_main = $image->is_main;

            Storage::delete($image->path);
            $image->delete();

            if ($was_main) {
                $new_main_image = Image::where('apartment_id', $apartment->id)->first();
                if ($new_main_image) {
                    $new_main_image->update([
                        'is_main' => 1
                    ]);
                }
            }

            return to_route('admin.apartments.images.index', $apartment)->with('message', 'Immagine eliminata con successo.');
        } else {
            abort(403);
        }
    }
}
