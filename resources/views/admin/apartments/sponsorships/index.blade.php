@extends('layouts.admin')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4"> Seleziona una sponsorizzazione:</h2>

        <div class="col-12 mb-3">

            <a class="btn btn-primary rounded-circle border bnb-btn-shadow bnb-btn-actions me-1 "
                href="{{ route('admin.apartments.index') }}" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                </svg>
            </a>

        </div>

        <div class="wrapper my-2 mb-4">
            @forelse ($sponsorships as $sponsorship)
                <div class="card border-0 border-top rounded-0 text-center">
                    <div class="card-body row row-cols-1 row-cols-md-5 justify-content-between align-items-center px-0">

                        <div class="row row-cols-1 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">
                                <h6 class="fs-4 fw-bold">
                                    {{ $sponsorship->name }}
                                </h6>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">

                                <div>
                                    <strong>Prezzo</strong>:
                                </div>
                                <div>
                                    {{ $sponsorship->price }}
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">

                                <div>
                                    <strong>Durata</strong>:
                                </div>
                                <div>
                                    {{ explode(':', $sponsorship->duration)[0] }} Ore
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">
                                <a class="btn btn-bnb rounded-pill"
                                    href="{{ route('admin.apartments.sponsorships.payment.index', ['sponsorship' => $sponsorship->id, 'apartment' => $apartment->id]) }}"
                                    role="button">Sponsorizza
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    Attualmente non sono disponibili opzioni di sponsorizzazione.
                </div>
            @endforelse
        </div>

    </div>
@endsection
