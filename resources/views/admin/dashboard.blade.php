@extends('layouts.admin')

@section('content')
    @vite(['resources/js/chart.js'])
    <script>
        let total_month_views = @json($total_month_views);
        let total_month_messages = @json($total_month_messages);
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

        <div class="row mt-3">
            <div class="col-12 col-md-6 col-lg-4 mb-3">
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

            <div class="col-12 col-md-6 col-lg-4 mb-3">
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

            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body h-100">
                        <h5 class="bnb-color">
                            <i class="fa-regular fa-comments"></i>
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



        </div>
        <div class="row my-3">
            <div class="col-12 col-md-6">
                <select name="year-dropdown" id="year-dropdown">
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
                <canvas class="col-2" id="chart-views"></canvas>

            </div>
            <div class="col-12 col-md-6">

                <canvas class="col" id="chart-message"></canvas>
            </div>

        </div>
    </div>
@endsection
