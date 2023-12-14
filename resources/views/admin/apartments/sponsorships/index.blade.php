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
                                    href="{{ route('admin.apartments.sponsorships.payment.index', ['sponsorship' => $sponsorship->id, 'apartment' => $apartment->id]) }}"
                                    role="button">Sponsorizza!
                                </a>
                            </div>
                        </div>
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
