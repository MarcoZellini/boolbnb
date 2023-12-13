@extends('layouts.admin')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4">Lista Sponsorizzazioni</h2>

        <div class="wrapper my-2">
            @forelse ($sponsorships as $sponsorship)
                <div class="card border-0 border-top rounded-0">
                    <div class="card-body row row-cols-1 row-cols-md-5 justify-content-between align-items-center px-0">
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">
                                <h4>
                                    {{ $sponsorship->id }}
                                </h4>
                            </div>
                        </div>
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">
                                <h4>
                                    {{ $sponsorship->name }}
                                </h4>
                            </div>
                        </div>
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">

                                <div>
                                    <strong>Price</strong>:
                                </div>
                                <div>
                                    {{ $sponsorship->price }}
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">

                                <div>
                                    <strong>Durata</strong>:
                                </div>
                                <div>
                                    {{ explode(':', $sponsorship->duration)[0] }} Ore
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2 row-cols-md-1 align-items-center my-1">
                            <div class=" align-self-start">
                                <a class="btn btn-primary"
                                    href="{{ route('admin.apartments.sponsorships.store', ['sponsorship' => $sponsorship->id, 'apartment' => $apartment->id]) }}"
                                    role="button">Sponsorizza!</a>

                            </div>
                        </div>
                        {{-- <div class="d-flex align-items-center justify-content-xsm-center  justify-content-end">
                            <a class="btn btn-light rounded-circle border bnb-btn-shadow me-1 bnb-btn-actions"
                                href="{{ route('admin.apartments.show', $apartment->id) }}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg>
                            </a>
                        </div> --}}
                    </div>
                </div>
            @empty
                <div>
                    Non sono ancora stati caricati appartamenti!
                </div>
            @endforelse
        </div>
    </div>
@endsection
