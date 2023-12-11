@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        <h1>Tutti i messaggi</h1>

        <div class="pt-2">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                <strong>Congratulazioni:</strong> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 pt-2 gy-1">
            @forelse ($messages as $message)
                <div class="col">
                    <div class="card border-0 border-top rounded-0">
                        <div class="card-body d-flex px-0">
                            <div class="col-9">
                                <h5 class="card-title">
                                    Apt. ID {{ $message->apartment_id }} - {{ $message->name }} {{ $message->lastname }}
                                    -
                                    {{ $message->subject }}
                                </h5>
                                <p class="card-text">
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
                                                    <h6><strong>Appartamento ID:
                                                            {{ $message->apartment_id }}</h6>
                                                </div>
                                                <div class="mt-4">
                                                    <h6><strong>Dettagli del mittente:</strong></h6>
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
                                                    Eliminare messaggio n. {{ $message->id }}?
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="#FF0000" class="bi bi-exclamation-triangle-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                                </svg>
                                                <span class="mx-1">
                                                    <strong>Attenzione</strong>: questa azione è irreversibile
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="#FF0000" class="bi bi-exclamation-triangle-fill"
                                                    viewBox="0 0 16 16">
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
                </div>
            @empty
                <div>Non ci sono messaggi per ora!</div>
            @endforelse
        </div>
    </div>
@endsection
