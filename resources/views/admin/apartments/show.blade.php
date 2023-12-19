@extends('layouts.admin')

@section('content')

    @vite(['resources/js/chart.js'])
    <script>
        let total_month_views = @json($total_month_views);
        let total_month_messages = @json($total_month_messages);
        let start_date = @json($start_date);
        let end_date = @json($end_date);
    </script>

    <div class="container my-4">

        <div class="mt-4 row p-2 align-items-center flex-column flex-sm-row">

            <div class="{{ count($apartment->images) == 5 ? 'col-12 col-sm-8' : 'col-12' }} m-0 p-0 ">

                {{-- MAIN IMAGE --}}

                {{-- SHOWS PLACEHOLDER IMAGE IF THE DB ENTRY IS EMPTY --}}
                @if (count($apartment->images) == 0)
                    <img class="w-100 object-fit-cover rounded-start bnb-main-img shadow_filter"
                        src="{{ asset('storage/placeholders/placeholder.jpg') }}" alt="Placeholder"
                        style="border-radius: 0.375rem">
                @endif

                {{-- FIND is_main IMAGE --}}
                @foreach ($apartment->images as $image)
                    @if ($image->is_main)
                        {{-- IF THERE ARE LESS THAN 5 IMAGES THE is_main IMAGE TAKES THE ENTIRE AVAIABLE SPACE AND GETS ROUNDED CORNERS --}}
                        <img class="w-100 object-fit-cover rounded-start bnb-main-img shadow_filter"
                            src="{{ URL::asset('storage/' . $image->path) }}" alt="{{ $apartment->title }}"
                            style="{{ count($apartment->images) < 5 ? 'border-radius: 0.375rem' : '' }}">
                    @endif
                @endforeach

            </div>

            {{-- OTHER IMAGES --}}

            {{-- IF THERE ARE 5 IMAGES APPLIES STYLE BASED ON THE POSITION THE IMAGE SHOULD TAKE ON THE PAGE --}}
            @if (count($apartment->images) > 1 && count($apartment->images) == 5)
                <div class="col col-sm-4 row align-items-center m-0 p-0 bnb-img-row">

                    {{-- LOOPS THE IMAGES... --}}
                    @foreach ($apartment->images as $image)
                        {{-- FIND THE IMAGES THAT ARE NOT is_main --}}
                        @if (!$image->is_main)
                            {{-- AND APPLIES STYLE --}}
                            @php
                                $styleClass = $styleClasses[$styleIndex];

                                // INCREASES THE STYLE INDEX FOR THE NEX ITERATION
                                $styleIndex++;
                            @endphp

                            {{-- APPLIES STYLECLASSES CLASSES BASED ON THE LOOP ITERATION --}}
                            <div class="col-6 m-0 p-0 bnb-extra-img-5">
                                <img class="w-100 h-100 img-fluid object-fit-cover rounded {{ $styleClass }} shadow_filter"
                                    src="{{ URL::asset('storage/' . $image->path) }}" alt="{{ $apartment->title }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- IF THERE ARE LESS THAN 5 IMAGES SHOWS THEM UNDER THE "is_main" IMAGE --}}
            @if (count($apartment->images) < 5)
                <div class="col row align-items-center m-0 p-0">

                    @foreach ($apartment->images as $image)
                        @if (!$image->is_main)
                            <div class="col m-0 p-0">
                                <img class="w-100 img-fluid object-fit-cover shadow_filter bnb-extra-img"
                                    src="{{ URL::asset('storage/' . $image->path) }}" alt="{{ $apartment->title }}"
                                    style="border-radius: 0.375rem;">
                            </div>
                        @endif
                    @endforeach

                </div>
            @endif

        </div>

        <div class="row row-cols-1">
            <div class="col-12 mt-2 mb-3">
                <a class="btn btn-primary rounded-circle border bnb-btn-shadow bnb-btn-actions  me-1 "
                    href="{{ url()->previous() }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                    </svg>
                </a>
                <a class="btn btn-success rounded-circle border bnb-btn-shadow bnb-btn-actions  me-1"
                    href="{{ route('admin.apartments.images.index', $apartment) }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-images" viewBox="0 0 16 16">
                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                        <path
                            d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10" />
                    </svg>
                </a>
                <a class="btn btn-primary rounded-circle border bnb-btn-shadow bnb-btn-actions  me-1"
                    href="{{ route('admin.apartments.sponsorships.index', $apartment) }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-currency-dollar" viewBox="0 0 16 16">
                        <path
                            d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                    </svg>
                </a>
                <a class="btn btn-warning rounded-circle border bnb-btn-shadow bnb-btn-actions  me-1"
                    href="{{ route('admin.apartments.edit', $apartment->id) }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </a>
                <!-- MODAL DELETE -->
                <button type="button" class="btn btn-danger rounded-circle border bnb-btn-shadow bnb-btn-actions  me-1"
                    data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $apartment->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                        <path
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                    </svg>
                </button>
                <div class="modal fade" id="deleteModal-{{ $apartment->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteModalLabel">
                                    Eliminare appartamento?
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #e00b41;"></i>
                                <span class="mx-1">

                                    <span class="mx-1">

                                        <strong>Attenzione</strong>: questa azione è
                                        irreversibile!
                                        <br>
                                        Verranno eliminate anche le immagini e i messaggi
                                        correlati a questo appartamento!
                                    </span>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn rounded-pill btn-outline-secondary btn-bnb-secondary"
                                    data-bs-dismiss="modal">Chiudi</button>
                                <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-bnb rounded-pill">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h1>
                {{ $apartment->title }}
            </h1>

            <div class="col col-md-6">

                {{-- DESCRIZIONE --}}
                <div class="mt-3">
                    <h3>
                        Descrizione
                    </h3>
                    <p>
                        @if (isset($apartment->description))
                            <p class="text-break">{{ $apartment->description }}</p>
                        @else
                            <p>Caro proprietario, <br>
                                Il tuo appartamento è un gioiello unico, e ora è il momento di farlo brillare nel miglior
                                modo possibile! Attualmente, la tua proprietà non ha una descrizione che possa farla
                                risplendere agli occhi degli inquilini potenziali. E chi può farlo meglio di te?
                                <br>

                                Dai uno sguardo attento alle caratteristiche speciali che rendono la tua casa unica. Che
                                siano i pavimenti in legno pregiato, la vista panoramica mozzafiato o la cucina
                                perfettamente attrezzata, ogni dettaglio conta. Metti in luce gli aspetti che rendono la tua
                                casa non solo un luogo dove vivere, ma un luogo da chiamare "casa".

                            </p>
                        @endif

                    </p>
                </div>

            </div>

            {{-- INFORMAZIONI --}}
            <div class="col col-md-6">

                <div class="ms-md-4 mt-3">
                    <h3>
                        Informazioni
                    </h3>
                    <ul class="list-unstyled">
                        <li>
                            <strong>Numero stanze</strong>: {{ $apartment->rooms }}
                        </li>
                        <li>
                            <strong>Numero letti</strong>: {{ $apartment->beds }}
                        </li>
                        <li>
                            <strong>Numero bagni</strong>: {{ $apartment->bathrooms }}
                        </li>
                        <li>
                            <strong>Superficie</strong>: {{ $apartment->square_meters }} mq
                        </li>
                        <li>
                            <strong>Indirizzo</strong>:
                            @if ($apartment->address)
                                {{ $apartment->address }}
                            @else
                                Nessun indirizzo inserito
                            @endif
                        </li>
                        <li>
                            <strong>Pubblicato su BoolBnB</strong>:
                            @if ($apartment->is_visible)
                                Si
                            @else
                                No
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            {{-- SERVIZI --}}
            <h3>
                Servizi
            </h3>
            <div class="col d-flex ">

                <div class="mt-3">
                    @foreach ($apartment->services as $service)
                        <span class="badge rounded-pill m-1 border text-black">
                            <img src="{{ asset($service->icon) }}" alt="{{ $service->name }}" style="width: 20px">
                            {{ $service->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="row my-3">
                <div class="col-12">
                    <form id="reset-form" action="{{ route('admin.apartments.show', $apartment) }}" method="get">
                    </form>
                    <form id="charts_filters" action="{{ route('admin.apartments.show', $apartment) }}" method="get">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-center justify-content-md-start align-items-md-center my-4">
                            <div class="mx-3">
                                <span>Inizio:</span>
                                <input class="form-control" type="date" id="start_date" name="start_date"
                                    value="{{ $start_date }}">
                            </div>
                            <div class="m-3">
                                <span>Fine:</span>
                                <input class="form-control" type="date" id="end_date" name="end_date"
                                    value="{{ $end_date }}">
                            </div>
                            <button type="submit" form="reset-form"
                                class="rounded-pill btn btn-bnb my-2 my-md-0 mx-md-2">Reset</button>
                            <button type="submit" class="rounded-pill btn btn-bnb my-2 my-md-0 mx-md-2">Filtra</button>
                            <div id="error" class="text-danger text-center"></div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <canvas class="col-2" id="chart-views"></canvas>
                </div>
            </div>

            {{-- MESSAGGI --}}
            <div class="col">
                <div class="mt-3 overflow-auto px-2">
                    <h3>
                        Messaggi
                    </h3>

                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                            <strong>Congratulazioni:</strong> {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="" style="height: 500px;">
                        @forelse ($apartment->messages->sortDesc() as $message)
                            <div class="card border-0 border-top rounded-0">
                                <div class="card-body d-flex px-0">
                                    <div class="col-9">
                                        <h6 class="card-title">
                                            {{ $message->name }} {{ $message->lastname }} - {{ $message->subject }}
                                        </h6>
                                        <p class="card-text text-truncate">
                                            {{ $message->message }}
                                        </p>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end align-items-center">
                                        <!-- MODAL DETAILS -->
                                        <button type="button"
                                            class="btn btn-light rounded-circle border bnb-btn-shadow bnb-btn-actions"
                                            data-bs-toggle="modal" data-bs-target="#showModal-{{ $message->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </button>
                                        <div class="modal fade" id="showModal-{{ $message->id }}" tabindex="-1"
                                            aria-labelledby="showModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="showModalLabel">
                                                            <strong>Oggetto:</strong> "{{ $message->subject }}"
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mt-2">
                                                            <h6><strong>Appartamento:</strong> {{ $apartment->title }} (ID:
                                                                {{ $message->apartment_id }})</h6>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h6><strong>Dettagli del mittente:</strong></h6>
                                                            <ul class="list-unstyled m-0">
                                                                <li>
                                                                    <strong>Nome:</strong> {{ $message->name }}
                                                                </li>
                                                                <li>
                                                                    <strong>Cognome:</strong> {{ $message->lastname }}
                                                                </li>
                                                                <li>
                                                                    <strong>Email:</strong> {{ $message->email }}
                                                                </li>
                                                                <li>
                                                                    <strong>Numero di telefono:</strong>
                                                                    {{ $message->phone }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h6><strong>Messaggio:</strong></h6>
                                                            {{ $message->message }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL DELETE -->
                                        <button type="button"
                                            class="btn btn-danger rounded-circle ms-1 bnb-btn-shadow bnb-btn-actions"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $message->id }}">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>

                                        </button>
                                        <div class="modal fade" id="deleteModal-{{ $message->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteModalLabel">
                                                            Eliminare messaggio di {{ $message->name }}?
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <i class="fa-solid fa-circle-exclamation fa-lg"
                                                            style="color: #e00b41;"></i>
                                                        <span class="mx-1">
                                                            <strong>Attenzione</strong>: questa azione è irreversibile
                                                        </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn rounded-pill btn-outline-secondary btn-bnb-secondary"
                                                            data-bs-dismiss="modal">Chiudi</button>
                                                        <form action="{{ route('admin.messages.delete', $message->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-bnb rounded-pill">Elimina</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div>
                                Attualmente non sono presenti messaggi!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
