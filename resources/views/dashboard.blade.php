@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Benvenuto ') }} <span class="text-capitalize">{{ Auth::user()->name }}!</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="bnb-color">
                            <i class="fa-solid fa-building"></i> Totale Appartamenti registrati
                        </h4>
                        <strong class="fs-2">{{ $total_apartments }}</strong>
                    </div>
                    <div class="card-footer d-flex align-items-center flex-row-reverse">

                        <a href="#" class="btn btn-bnb rounded-pill">
                            vai ai tuoi appartamenti
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="bnb-color">
                            <i class="fa-regular fa-comments"></i>
                            Totale Messaggi
                        </h4>
                        <strong class="fs-2">{{ $total_messages }}</strong>
                    </div>
                    <div class="card-footer d-flex align-items-center flex-row-reverse">

                        <a href="#" class="btn btn-bnb rounded-pill">
                            vai ai tuoi appartamenti
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
