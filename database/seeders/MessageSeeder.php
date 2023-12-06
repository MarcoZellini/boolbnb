<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $newmessage = new Message();
            $newmessage->name = 'Gianluca';
            $newmessage->lastname = 'Vallese';
            $newmessage->email = 'email@example.it';
            $newmessage->phone = '+39 340111222';
            $newmessage->subject = 'Informazioni per appartamento 1';
            $newmessage->message = 'Ciao, sono interessato a questo appartamento, è disponibile dal 25 dicembre al 1 gennaio compreso?';
            $newmessage->apartment_id = 1;
            $newmessage->save();
        }
    }
}
