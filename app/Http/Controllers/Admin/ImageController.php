<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function index(Apartment $apartment)
    {
        return view('admin.apartments.images.index', ['apartment' => $apartment]);
    }


    public function setMain(Apartment $apartment, Image $image)
    {
        $main_image = Image::where('apartment_id', $apartment->id)->where('is_main', '1')->first();
        $main_image->update([
            'is_main' => 0
        ]);

        $image->update([
            'is_main' => 1
        ]);

        return to_route('admin.apartments.images.index', $apartment)->with('message', 'Immagine principale sostituita con successo.');
    }

    public function destroy(Apartment $apartment, Image $image)
    {
        $was_main = $image->is_main;

        Storage::delete($image->path);
        $image->delete();

        if ($was_main) {
            $new_main_image = Image::where('apartment_id', $apartment->id)->first();
            $new_main_image->update([
                'is_main' => 1
            ]);
        }

        return to_route('admin.apartments.images.index', $apartment)->with('message', 'Immagine eliminata con successo.');
    }
}
