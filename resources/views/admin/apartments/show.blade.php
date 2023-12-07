@extends('layouts.admin')

@section('content')
    <div class="container my-4">

        <div class="py-4 row px-3">
            <div class="col-8 m-0 p-0">
                <img src="https://picsum.photos/400/200" alt="" class="w-100">
            </div>
            <div class="col-4 row align-items-center m-0 p-0">
                <div class="col-6 m-0 p-0">
                    <img src="https://picsum.photos/400/400?random=1" alt="" class="w-100">
                </div>
                <div class="col-6 m-0 p-0">
                    <img src="https://picsum.photos/400/400?random=2" alt="" class="w-100">
                </div>
                <div class="col-6 m-0 p-0">
                    <img src="https://picsum.photos/400/400?random=3" alt="" class="w-100">
                </div>
                <div class="col-6 m-0 p-0">
                    <img src="https://picsum.photos/400/400?random=4" alt="" class="w-100">
                </div>
            </div>
        </div>

        <div class="mt-3">
        </div>

        <div class="row row-cols-2 pt-3">
            <div class="col">
                <h1>
                    {{ $apartment->title }}
                </h1>
                <div class="mt-2">
                    <h3>
                        Descrizione
                    </h3>
                    <p>
                        {{ $apartment->description }}
                    </p>
                </div>
                <div class="mt-2">
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
                                Indirizzo non presente
                            @endif
                        </li>
                        <li>
                            <strong>Pubblicato su BoolBnB</strong>:
                            @if ($apartment->is_visible)
                                SI
                            @else
                                NO
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="mt-2">
                    <h3>
                        Servizi
                    </h3>
                    @foreach ($apartment->services as $service)
                        <span class="badge bg-primary m-1">
                            <img src="{{ asset($service->icon) }}" alt="" style="width: 20px;">
                            {{ $service->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="col">
                <div class="mt-2">
                    <h1>
                        Messaggi
                    </h1>
                    <div class="overflow-auto" style="height: 500px;">
                        @foreach ($apartment->messages as $message)
                            <div class="card border-bottom rounded-0">
                                <div class="card-body d-flex px-5">
                                    <div class="col-9">
                                        <h6 class="card-title">
                                            {{ $message->name }} {{ $message->lastname }} - {{ $message->subject }}
                                        </h6>
                                        <p class="card-text text-truncate"">
                                            {{ $message->message }}
                                        </p>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end align-items-center">
                                        <!-- MODAL DETAILS -->
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#showModal-{{ $message->id }}">
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
                                                            Messaggio n. {{ $message->id }}: {{ $message->subject }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mt-2">
                                                            <h5>ID appartamento: {{ $message->apartment_id }}</h5>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h5>Dettagli interessato</h5>
                                                            <ul class="list-unstyled m-0">
                                                                <li>
                                                                    Nome: {{ $message->name }}
                                                                </li>
                                                                <li>
                                                                    Cognome: {{ $message->lastname }}
                                                                </li>
                                                                <li>
                                                                    Email: {{ $message->email }}
                                                                </li>
                                                                <li>
                                                                    Telefono: {{ $message->phone }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h5>Messaggio</h5>
                                                            {{ $message->message }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL DELETE -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $message->id }}">
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
                                                            Eliminare messaggio n. {{ $message->id }}?
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="#FF0000"
                                                            class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                                        </svg>
                                                        <span class="mx-1">
                                                            <strong>Attenzione</strong>: questa azione è irreversibile
                                                        </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="#FF0000"
                                                            class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                                        </svg>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.messages.delete', $message->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
