<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function index(Apartment $apartment)
    {
        if ($apartment->user_id === Auth::id()) {
            $sponsorships = Sponsorship::all();
            return view('admin.apartments.sponsorships.index', ['sponsorships' => $sponsorships, 'apartment' => $apartment]);
        } else {
            abort(403);
        }
    }

    public function store(Apartment $apartment, Sponsorship $sponsorship)
    {


        if ($apartment->user_id === Auth::id()) {

            //prendo l'ultima sponsorizzazione attiva
            $previous_sponsorships = $apartment->sponsorships()->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))->orderByPivot('created_at', 'desc')->first();

            //controllo se esiste
            if ($previous_sponsorships) {
                $previous_sponsorships_end_date = $previous_sponsorships->pivot->end_date;

                //dd($previous_sponsorships_end_date);

                //uso la data di scadenza dell'ultima sponsorizzazione come partenza
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $previous_sponsorships_end_date);
            } else {
                //uso la data attuale come partenza
                $end_date = Carbon::now();
            }

            //separo ore minuti e secondi
            $time = explode(':', $sponsorship->duration);

            $hours = (int)$time[0];
            $minutes = (int)$time[1];
            $seconds = (int)$time[2];


            //li aggiungo alla data se ci sono
            if ($hours) {
                $end_date->addHours($hours);
            }
            if ($minutes) {
                $end_date->addMinutes($minutes);
            }
            if ($seconds) {
                $end_date->addSeconds($seconds);
            }

            //aggiungo un nuovo record dove viene segnata che sponsorizzazione viene scelta e la data di scadenza (se ci sono sponsorizzazioni attive vengono sommate)
            $apartment->sponsorships()->attach([$sponsorship->id => ['end_date' => $end_date]]);

            return to_route('admin.apartments.index')->with('message', 'Appartamento sponsorizzato con successo!');
        } else {
            abort(403);
        }

        /* !!!!!!!!!!!!!! NON ELIMINARE  !!!!!!!!!!!!!!!! */

        /* $previous_sponsorship = $apartment->sponsorships()->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))->first(); */

        //Considerazione: Al momento posso avere una sponsorship alla volta, una volta scaduta posso averne un'altra
        /* if (!$previous_sponsorship) {
            $end_date = Carbon::now();
            $time = explode(':', $sponsorship->duration);

            $hours = (int)$time[0];
            $minutes = (int)$time[1];
            $seconds = (int)$time[2];

            if ($hours) {
                $end_date->addHours($hours);
            }
            if ($minutes) {
                dd($minutes);
                $end_date->addMinuts($minutes);
            }
            if ($seconds) {
                dd($seconds);
                $end_date->addSeconds($seconds);
            }

            $apartment->sponsorships()->sync([$sponsorship->id => ['end_date' => $end_date]]);


            return to_route('admin.apartments.index')->with('message', 'Appartamento sponsorizzato con successo!');
        } else {
            return to_route('admin.apartments.index')->with('error', "Questo appartamento ha già una sponsorizzazione!");
        } */

        /* !!!!!!!!!!!!!! NON ELIMINARE  !!!!!!!!!!!!!!!! */
    }
}
