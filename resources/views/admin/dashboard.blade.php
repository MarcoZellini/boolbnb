@extends('layouts.admin')

@section('content')
    @vite(['resources/js/chart.js'])
    <script>
        let total_month_views = @json($total_month_views);
        let total_month_messages = @json($total_month_messages);
        let start_date = @json($start_date);
        let end_date = @json($end_date);
    </script>

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

        <div class="row my-3">
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100 ">
                    <div class="card-body h-100">
                        <h5 class="bnb-color ">
                            <i class="fa-solid fa-building"></i> Totale Appartamenti registrati
                        </h5>
                        <strong class="fs-2">{{ $total_apartments }}</strong>
                    </div>
                    <div class="card-footer d-flex align-items-center flex-row-reverse p-0 py-2">
                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-bnb rounded-pill mx-2">
                            Vai ai tuoi appartamenti
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body h-100">
                        <h5 class="bnb-color">
                            <i class="fa-regular fa-comments"></i>
                            Totale Messaggi
                        </h5>
                        <strong class="fs-2">{{ $total_messages }}</strong>
                    </div>
                    <div class="card-footer d-flex align-items-center flex-row-reverse p-0 py-2">

                        <a href="{{ route('admin.messages.index') }}" class="btn btn-bnb rounded-pill mx-2">
                            Vai ai tuoi messaggi
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body h-100">
                        <h5 class="bnb-color">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            Totale Ore Sponsorizzazione
                        </h5>
                        <strong class="fs-2"> {{ $total_sponsorships_time['hours'] }} </strong>
                    </div>
                    <div class="card-footer d-flex align-items-center flex-row-reverse p-0 py-2">

                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-bnb rounded-pill mx-2">
                            Sponsorizza
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body h-100">
                        <h5 class="bnb-color">
                            <i class="fa-solid fa-money-bills"></i>
                            Totale soldi spesi
                        </h5>
                        <strong class="fs-2"> {{ $Total_cash }} </strong>
                    </div>
                    <div class="card-footer d-flex align-items-center flex-row-reverse p-0 py-2">

                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-bnb rounded-pill mx-2">
                            soldi
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>




        </div>
        <div class="row my-3">
            <div class="col-12">
                <form id="reset-form" action="{{ route('dashboard') }}" method="get"></form>
                <form id="charts_filters" action="{{ route('dashboard') }}" method="get">
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
    </div>
@endsection
