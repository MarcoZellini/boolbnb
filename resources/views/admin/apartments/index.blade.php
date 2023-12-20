<?php

use Carbon\Carbon;

?>

@extends('layouts.admin')

@section('content')
    <div class="container mt-4">

        <h1 class="text-center text-lg-start">Lista appartamenti</h1>

        <div class="my-4 d-flex justify-content-center justify-content-lg-end">
            <a class="btn btn-bnb mt-2 rounded-pill d-flex justify-content-center align-items-center"
                href="{{ route('admin.apartments.create') }}" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                <span class="ms-2">Aggiungi Appartamento</span>
            </a>
        </div>

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }} 🤩
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }} 😒
            </div>
        @endif

        @forelse  ($apartments as $apartment)
            <div class="row border-top mt-2 align-items-center py-1">
                {{-- col-10 col-md-9 --}}
                <div class="col mt-2">
                    <div class="d-flex flex-column gap-1 flex-lg-row align-items-lg-center ">
                        <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start ">
                            @if ($apartment->images->where('is_main', true)->first()?->path)
                                <img class="p-3 object-fit-cover img-fluid"
                                    src="{{ asset('storage/' . $apartment->images->where('is_main', true)->first()->path) }}">
                            @else
                                <img class="p-3 object-fit-cover img-fluid"
                                    src="{{ asset('storage/placeholders/placeholder.jpg') }}">
                            @endif
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="col d-flex flex-column align-items-center">
                                <div>
                                    <strong class="fs-3">Titolo</strong>
                                </div>
                                <div>
                                    {{ $apartment->title }}
                                </div>
                            </div>

                            <div class="col d-flex flex-column align-items-center">
                                <div>
                                    <strong class="fs-3">Indirizzo</strong>
                                </div>
                                <div>
                                    {{ $apartment->address ? $apartment->address : 'Non Impostato' }}
                                </div>
                            </div>

                            <div class="col d-flex flex-column align-items-center">
                                <div>
                                    <strong class="fs-3">Sponsorizzato</strong>
                                </div>
                                <div>
                                    {{ $apartment->sponsorships()->orderByPivot('created_at', 'desc')->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))->first()? 'Si': 'No' }}
                                </div>
                            </div>

                            <div class="col d-flex flex-column align-items-center">
                                <div>
                                    <strong class="fs-3">Visibile su BoolBnB</strong>
                                </div>
                                <div>
                                    {{ $apartment->is_visible ? 'Si' : 'No' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-2 dropup-center dropup d-flex justify-content-center">
                            <button class="btn btn-lg btn-bnb rounded-pill border-0 dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Azioni
                            </button>
                            <ul class="dropdown-menu p-0">
                                <li class="d-flex justify-content-center">
                                    <a class="btn btn-light w-100 rounded-0"
                                        href="{{ route('admin.apartments.show', $apartment->id) }}" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                        Mostra
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-success w-100 rounded-0"
                                        href="{{ route('admin.apartments.images.index', $apartment) }}" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                            <path
                                                d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10" />
                                        </svg>
                                        Gestisci Immagini
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-primary w-100 rounded-0"
                                        href="{{ route('admin.apartments.sponsorships.index', $apartment) }}"
                                        role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                            <path
                                                d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                                        </svg>
                                        Sponsorizza
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-warning w-100 rounded-0"
                                        href="{{ route('admin.apartments.edit', $apartment->id) }}" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                        Modifica
                                    </a>
                                </li>
                                <!-- MODAL DELETE -->
                                <li>
                                    <button type="button" class="btn btn-danger w-100 rounded-0" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $apartment->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                        </svg>
                                        Elimina
                                    </button>
                                </li>
                            </ul>
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
                                            <span class="mx-1">
                                                <i class="fa-solid fa-circle-exclamation fa-lg"
                                                    style="color: #e00b41;"></i>
                                                <span class="mx-1">
                                                    <strong>Attenzione</strong>: questa azione è
                                                    irreversibile e verranno eliminati immagini e messaggi
                                                    correlati a questo appartamento
                                                </span>
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn rounded-pill btn-outline-secondary btn-bnb-secondary"
                                                data-bs-dismiss="modal">Chiudi</button>
                                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-bnb rounded-pill">Elimina</button>
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
            <h3 class="border-top">
                Non sono ancora stati caricati appartamenti!
            </h3>
        @endforelse

        <div class="py-2">
            {{ $apartments->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
