@extends('layouts.admin')

@section('content')
    <div class="container mt-4">

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

        <div class="row row-cols-1 pt-2 gy-1 mb-3">
            @forelse ($messages as $message)
                <div class="col">
                    <div class="card border-0 border-top rounded-0">
                        <div class="card-body d-flex px-0">
                            <div class="col-9">
                                <h5 class="card-title">
                                    {{ $message->title }} (ID: {{ $message->apartment_id }})
                                    -
                                    {{ $message->subject }}
                                </h5>
                                <p class="card-text">
                                    {{ $message->message }}
                                </p>
                            </div>
                            <div
                                class="col-3 d-flex align-items-center justify-content-center justify-content-sm-end  flex-column flex-sm-row gap-1">
                                <!-- MODAL DETAILS -->
                                <button type="button"
                                    class="btn btn-light rounded-circle border bnb-btn-shadow bnb-btn-actions align-self-center align-self-sm-center "
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
                                                    <h6><strong>Appartamento:</strong> {{ $message->title }} (ID:
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
                                                            <a href="mailto:{{ $message->email }}">
                                                                <strong>Email:</strong> {{ $message->email }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <strong>Numero di telefono:</strong> {{ $message->phone }}
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
                                    class="btn btn-danger rounded-circle bnb-btn-shadow bnb-btn-actions align-self-center align-self-sm-center "
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
                                                <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #e00b41;"></i>
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
                                                        class="btn btn-bnb rounded-pill">Cancella</button>
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
