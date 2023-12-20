<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Image;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $TomtomKey = 'zGXu3iFl86vJs8yD3Uq6OGoANFEGzFkS';

        $images = [
            "https://images.unsplash.com/photo-1505873242700-f289a29e1e0f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM3NTl8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1449247613801-ab06418e2861?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM3NTF8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1623050804066-42bcedb4e81d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjMyNjZ8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1633119712778-30d94755de54?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM4MDZ8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1650137938625-11576502aecd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM3OTh8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1492138645880-160f6a5136fa?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM3ODl8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1507652313519-d4e9174996dd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM3ODF8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1461151304267-38535e780c79?crop=entropy&cs=srgb&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM4NTl8&ixlib=rb-4.0.3&q=85",
            "https://images.unsplash.com/photo-1653242370243-5f7ca54b00db?crop=entropy&cs=srgb&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM4NzJ8&ixlib=rb-4.0.3&q=85",
            "https://images.unsplash.com/photo-1624432077947-c1b08ab86049?crop=entropy&cs=srgb&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM4Nzh8&ixlib=rb-4.0.3&q=85",
            "https://images.unsplash.com/photo-1617721595342-ab308966360c?crop=entropy&cs=srgb&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM4ODN8&ixlib=rb-4.0.3&q=85",
            "https://images.unsplash.com/photo-1650137938625-11576502aecd?crop=entropy&cs=srgb&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjM4OTB8&ixlib=rb-4.0.3&q=85",
            "https://images.unsplash.com/photo-1536376072261-38c75010e6c9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwMTN8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1632323091845-f636f89749fa?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwMzJ8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1518747993763-5c9d82d08a9e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwMzh8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1658218729615-167c32d70537?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwNDZ8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1551806405-b76c7789f4ab?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwNTN8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1628152184821-6e09cdf0a248?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwNTl8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1521604784100-e0318b4b2bad?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwNjN8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1494512163437-5d01c88c0e5a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwNjh8&ixlib=rb-4.0.3&q=80&w=1080",
            "https://images.unsplash.com/photo-1500307353842-81f527a10685?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1NDMwOTd8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MDMwNjQwNzR8&ixlib=rb-4.0.3&q=80&w=1080",
        ];

        $addresses =
            ['Via Bari, 9, 39100 Bolzano BZ', 'Via Palermo, 50-54, 39100 Bolzano BZ', 'Via Orazio, 39100 Bolzano BZ', 'Via Museo, 39100 Bolzano BZ', 'Via Serradifalco, 248, 90145 Palermo PA', 'Via Giovanni Dotto, 12, 90129 Palermo PA', 'Via Alloro, 13, 90133 Palermo PA', 'Via Dell Arsenale, 6-4, 90133 Palermo PA', 'Via Ippolito Nievo, 12, 61122 Pesaro PU', 'Via Vincenzo Toschi Mosca, 21, 61121 Pesaro PU', 'Viale Fiume, 89-79, 61121 Pesaro PU', 'Via Cervia, 1, 61122 Pesaro PU', 'Via Vanchiglia, 34, 10124 Torino TO', 'Via Perugia, 52, 10152 Torino TO', 'Via Pietro Mascagni, 10, 10154 Torino TO', 'S.da Lanzo, 160, 10148 Torino TO', 'Via Vicenza, 44, 00185 Roma RM', 'Via Lombardia, 19/21, 00187 Roma RM', 'Via Pietro Cossa, 42, 00193 Roma RM', 'Via Bernardino Telesio, 21, 00195 Roma RM', 'Via Cicco Simonetta, 16A, 20123 Milano MI', 'Via Giosuè Carducci, 25-23, 20123 Milano MI', 'C.so di Porta Nuova, 34-40, 20121 Milano MI', 'Viale Teodorico, 36, 20149 Milano MI', 'Via Pescheria, 28, 30014 Cavarzere VE', 'Via Tullio Serafin, 21, 30014 Cavarzere VE', 'Via Renier, 5, 30172 Venezia VE', 'Via Monte Avena, 37, 30173 Venezia VE', 'Viale Francesco Redi, 17, 50144 Firenze FI', 'Via Claudio Monteverdi, 44/A, 50144 Firenze FI', 'Via Francesco Baracca, 50, 50127 Firenze FI', 'Via della Cupola, 50145 Firenze FI', 'Via Giovanni Torti, 13, 16143 Genova GE', 'Via Donghi, 38, 16132 Genova GE', 'Via Paverano, 9, 16143 Genova GE', 'Via Acquarone, 19r, 16125 Genova GE', 'Via Lodovico Berti, 9-11, 40131 Bologna BO', 'Via Francesco Zanardi, 22-18, 40131 Bologna BO', 'Via Francesco Albani, 15, 40129 Bologna BO', 'Via Alfredo Calzolari, 33, 40128 Bologna BO', 'Via Michelangelo Schipa, 91, 80122 Napoli NA', 'Via Bari, 1, 80143 Napoli NA', 'Via Luigi Franciosa, 80147 Napoli NA', 'Via Roma, 28, 80040 Cercola NA', 'Via Pasquale Cugia, 14, 09129 Cagliari CA', 'Via Pietro Cavaro, 38, 09131 Cagliari CA', 'Via dei Grilli, 6-4, 09134 Cagliari CA', 'Via del Redentore, 182, 09042 Monserrato CA', 'Via Hotel Des Etats, 15, 11100 Aosta AO', 'Via B. Festaz, 13, 11100 Aosta AO', 'Via Maurice Garin, 10/P, 11100 Aosta AO', 'Via Gilles de Chevrères, 30-40, 11100 Aosta AO', 'Via della Stazione, 33, 88100 Catanzaro CZ', 'Corso Giuseppe Mazzini, 102, 88100 Catanzaro CZ', 'Via Aldo Barbaro, 17, 88100 Catanzaro CZ', 'Via Bambinello Gesù, 31, 88100 Catanzaro CZ', 'Via Silvio Spaventa, 10, 65126 Pescara PE', 'Str. delle Fornaci, 15-1, 65125 Pescara PE', 'Via Secchia, 19-1, 65015 Montesilvano PE', 'P.za John Fitzgerald Kennedy, 28-30, 65015 Montesilvano PE'];


        $users = User::all();

        $apartment_details = [
            'Stile Costiero Rilassato' => 'Questo incantevole appartamento trasuda atmosfera costiera con i suoi toni blu rilassanti, arredi in rattan e tessuti leggeri. La vista sul mare dal balcone vi catturerà all\'alba, mentre l\'interno luminoso e arioso crea un rifugio sereno per una vacanza tranquilla.',
            'Charme Vintage nel Centro Città' => 'Situato nel cuore del centro storico, questo appartamento affascina con il suo mix di mobili vintage e dettagli retrò. Le pareti color pastello, gli ornamenti d\'epoca e il pavimento a mosaico creano un\'atmosfera accogliente e nostalgica, perfetta per un soggiorno caratteristico.',
            'Minimalismo Urbano' => 'L\'elegante appartamento urbano è un esempio di minimalismo moderno. Con spazi aperti, linee pulite e arredi contemporanei, offre un rifugio tranquillo nel cuore della città. Le ampie finestre inondano gli ambienti di luce naturale, creando una sensazione di leggerezza e apertura.',
            'Cottage Rurale Immerso nel Verde' => 'Questo affascinante cottage rurale è circondato da campi e giardini rigogliosi. Gli interni accoglienti con travi a vista, camino a legna e arredi rustici creano un\'atmosfera calorosa e avvolgente. La veranda coperta è perfetta per gustare una tazza di tè mentre si ammira la natura circostante.',
            'Loft Industriale Chic' => 'In un ex magazzino riconvertito, questo loft industriale sfoggia uno stile chic e moderno. Con soffitti alti, travi in acciaio a vista e pavimenti in cemento lucido, è l\'ideale per gli amanti del design contemporaneo. La cucina open space e gli spazi minimalisti creano un ambiente cosmopolita.',
            'Appartamento Boho nel Quartiere Artistico' => 'Nel cuore del quartiere artistico, questo appartamento bohemien incanta con la sua vivacità. Colori audaci, tessuti etnici e oggetti d\'arte creano un ambiente creativo e stimolante. La terrazza coperta offre uno spazio unico per rilassarsi e godere della vita di quartiere.',
            'Vista Panoramica sulla Città' => 'Situato in un grattacielo, questo appartamento offre una vista mozzafiato sulla città. Gli interni moderni con finiture di lusso, mobili eleganti e ampie vetrate rendono ogni momento un\'esperienza di puro lusso. Il balcone privato è il luogo perfetto per godersi i tramonti spettacolari.',
            'Casa di Campagna con Piscina' => 'Immersa tra colline e vigneti, questa casa di campagna offre il massimo relax. Con una piscina privata, un giardino curato e arredi country-chic, è il luogo ideale per una fuga dal trambusto quotidiano. L\'interno con travi in legno e caminetto crea un ambiente accogliente.',
            'Design Moderno nel Quartiere Trendy' => 'Nel quartiere alla moda, questo appartamento vanta un design moderno e audace. Arredi di design, illuminazione contemporanea e colori vivaci creano uno spazio dinamico e accattivante. La cucina gourmet è perfetta per sperimentare con la cucina locale.',
            'Retreat Montano con Jacuzzi' => 'Questo rifugio di montagna offre un lusso aggiuntivo con una jacuzzi privata. Circondato da boschi e montagne, l\'interno con tronchi di legno, camino in pietra e arredi accoglienti crea una sensazione di calore e benessere. La jacuzzi all\'aperto offre una vista impagabile sulla natura circostante.',
        ];

        foreach ($addresses as $address) {

            $randomU_user_id = $users->pluck('id')->random();

            $random_key = collect(array_keys($apartment_details))->random();
            $titolo = $random_key;
            $descrizione = $apartment_details[$titolo];

            $NewApartment = new Apartment();

            $NewApartment->user_id = $randomU_user_id;

            do {
                $existing_apartments_count = Apartment::where('title', $titolo)->count();
                if ($existing_apartments_count > 0) {
                    $titolo .= ' ' . rand(1, 100);
                }
            } while ($existing_apartments_count > 0);

            $NewApartment->title = $titolo;

            $slug = Str::slug($NewApartment->title);
            $NewApartment->slug = $slug;
            $NewApartment->description = $descrizione;
            $NewApartment->rooms = rand(1, 10);
            $NewApartment->bathrooms = rand(1, 10);
            $NewApartment->square_meters = rand(50, 1000);
            $NewApartment->address = $address;

            $tt_address =  $NewApartment->address;

            $tt_address = str_replace(' ', '%20', $address);

            $geocoding = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/" .  $tt_address . ".json?key=" . $TomtomKey);

            if ($geocoding->successful()) {
                $coordinates = $geocoding['results'][0]['position'];
                $NewApartment->latitude = $coordinates['lat'];
                $NewApartment->longitude = $coordinates['lon'];
            }

            $NewApartment->is_visible = 1;
            $NewApartment->created_at = Carbon::createFromTimestamp(rand(strtotime('2020-01-01'), time()));

            $NewApartment->save();

            $random_images = collect($images)->random(rand(1, 5));

            $main_image_set = false;

            foreach ($random_images as $image_path) {
                $image = new Image();
                $image->apartment_id = $NewApartment->id;

                $image_contents = file_get_contents($image_path);

                $image_name = 'apartments/' . Str::random(12) . '.jpg';

                Storage::put($image_name, $image_contents);

                $image->path = $image_name;

                $image->is_main = !$main_image_set ? 1 : 0;
                $image->save();

                if (!$main_image_set) {
                    $main_image_set = true;
                }
            }

            $number_of_services = rand(10, 24);

            $service_ids = Service::pluck('id')->all();

            $selected_service_ids = collect($service_ids)->random($number_of_services);

            foreach ($selected_service_ids as $service_id) {
                DB::table('apartment_service')->insert([
                    'apartment_id' => $NewApartment->id,
                    'service_id' => $service_id,
                ]);
            }
        }
    }
}
