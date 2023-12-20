<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = Apartment::all();

        $name = [
            'Luca',
            'Giulia',
            'Marco',
            'Francesca',
            'Alessandro',
            'Valentina',
            'Giovanni',
            'Elena',
            'Matteo',
            'Isabella',
        ];

        $surname = [
            'Rossi',
            'Bianchi',
            'Ferrari',
            'Esposito',
            'Ricci',
            'Rizzo',
            'Conti',
            'Moretti',
            'Bruno',
            'Mancini',
        ];

        $subjects = [
            'Richiesta di informazioni sull\'appartamento',
            'Disponibilità e prezzi',
            'Richiesta di visita',
            'Servizi aggiuntivi',
            'Prenotazione e conferma',
            'Domande sui vicini',
            'Animali domestici ammessi?',
            'Informazioni turistiche',
            'Trasporti e accessibilità',
        ];

        $messages = [
            'Mi piacerebbe avere maggiori informazioni su questo appartamento.',
            'Quali sono i costi aggiuntivi?',
            'Posso pianificare una visita?',
            'Come funziona il processo di prenotazione?',
            'Accettate animali domestici?',
            'Ci sono sconti per prenotazioni a lungo termine?',
            'Quali sono i servizi inclusi?',
            'Posso avere il vostro listino prezzi?',
            'Cosa c\'è nelle vicinanze?',
            'Grazie per le informazioni!',
            'Ciao, sono interessato a questo appartamento, è disponibile dal 25 dicembre al 1 gennaio compreso?',
        ];

        foreach ($apartments as $apartment) {
            $messagesPerApartment = rand(1, 10);

            for ($i = 0; $i < $messagesPerApartment; $i++) {
                $newmessage = new Message();

                $newmessage->apartment_id = $apartment->id;
                $newmessage->name = $name[array_rand($name)];
                $newmessage->lastname = $surname[array_rand($surname)];
                $newmessage->email = strtolower($newmessage->name . '.' . $newmessage->lastname . '@example.it');
                $newmessage->phone = '+39 ' . rand(300, 399) . ' ' . rand(1000000, 9999999);
                $newmessage->subject = $subjects[array_rand($subjects)];
                $newmessage->message = $messages[array_rand($messages)];
                $newmessage->created_at = Carbon::createFromTimestamp(rand(strtotime('2020-01-01'), time()));

                $newmessage->save();
            }
        }
    }
}
