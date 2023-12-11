@extends('layouts.admin')

@section('content')

    <div class="container my-4">

        <div class="mt-4 row p-2 flex-column flex-sm-row">

            <div class="{{ count($apartment->images) == 5 ? 'col-12 col-sm-8' : 'col-12' }} m-0 p-1 ">

                {{-- MAIN IMAGE --}}

                {{-- SHOWS PLACEHOLDER IMAGE IF THE DB ENTRY IS EMPTY --}}
                @if (count($apartment->images) == 0)
                    <img class="w-100 object-fit-cover rounded-start bnb-main-img shadow"
                        src="{{ asset('storage/placeholders/placeholder.jpg') }}" alt="Placeholder"
                        style="border-radius: 0.375rem">
                @endif

                {{-- FIND is_main IMAGE --}}
                @foreach ($apartment->images as $image)
                    @if ($image->is_main)
                        {{-- IF THERE ARE LESS THAN 5 IMAGES THE is_main IMAGE TAKES THE ENTIRE AVAIABLE SPACE AND GETS ROUNDED CORNERS --}}
                        <img class="w-100 object-fit-cover rounded-start bnb-main-img shadow"
                            src="{{ URL::asset('storage/' . $image->path) }}" alt="{{ $apartment->title }}"
                            style="{{ count($apartment->images) < 5 ? 'border-radius: 0.375rem' : '' }}">
                    @endif
                @endforeach

            </div>

            {{-- OTHER IMAGES --}}

            {{-- IF THERE ARE 5 IMAGES APPLIES STYLE BASED ON THE POSITION THE IMAGE SHOULD TAKE ON THE PAGE --}}
            @if (count($apartment->images) > 1 && count($apartment->images) == 5)
                <div class="col col-sm-4 row align-items-center m-0 p-0">

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

                            {{-- APPLIES PADDING CLASSES BASED ON THE LOOP ITERATION --}}
                            <div class="col-6 m-0 p-1 h-50">
                                <img class="h-100 img-fluid object-fit-cover rounded {{ $styleClass }} shadow"
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
                            <div class="col m-0 p-1">
                                <img class="w-100 img-fluid object-fit-cover shadow bnb-extra-img"
                                    src="{{ URL::asset('storage/' . $image->path) }}" alt="{{ $apartment->title }}"
                                    style="border-radius: 0.375rem;">
                            </div>
                        @endif
                    @endforeach

                </div>
            @endif

        </div>

        <div class="row row-cols-1 mt-4">

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
                            {{ $apartment->description }}
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

                <div class="mt-3">
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
            <div class="col">

                <div class="mt-3">
                    <h3>
                        Servizi
                    </h3>
                    @foreach ($apartment->services as $service)
                        <span class="badge rounded-pill me-1 border text-black">
                            <img src="{{ asset($service->icon) }}" alt="{{ $service->name }}" style="width: 20px;">
                            {{ $service->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- MESSAGGI --}}
            <div class="col">
                <div class="mt-3">
                    <h3>
                        Messaggi
                    </h3>

                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                            <strong>Congratulazioni:</strong> {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="overflow-auto" style="height: 500px;">
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
                                        <button type="button" class="btn btn-light rounded-circle border bnb-btn-shadow"
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
                                        <button type="button" class="btn btn-danger rounded-circle ms-1 bnb-btn-shadow"
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
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.messages.delete', $message->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-bnb rounded-pill">Delete</button>
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
