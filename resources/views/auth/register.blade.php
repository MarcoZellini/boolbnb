@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <h4 class="fw-bold">Registrati </h4>

                    <form method="POST" id="registerForm" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="@error('name') is-invalid @enderror form-control" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome ') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text"
                                    class="@error('lastname') is-invalid @enderror form-control" name="lastname"
                                    value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="@error('email') is-invalid @enderror form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="@error('password') is-invalid @enderror form-control" name="password" required
                                    autocomplete="new-password">

                                {{-- PASSWORD ERROR MESSAGE --}}
                                <span id="message" style="font-weight: bolder; font-size: 14px; color: #dc354b"></span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">

                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="date_of_birth"
                                class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date"
                                    class="date-bnb @error('date_of_birth') is-invalid @enderror form-control"
                                    name="date_of_birth" required>
                                <span id="message_date_of_birth"
                                    style="font-weight: bolder; font-size: 14px; color: #dc354b"></span>
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submitBtn" class="btn btn-bnb rounded-pill">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col">
                                <span style="font-size: 0.75rem; line-height: 0.75rem;">
                                    Registrandoti, autorizzi il trattamento dei dati personali nel rispetto della vigente
                                    normativa sulla protezione dei dati personali ed, in particolare, il Regolamento Europeo
                                    per
                                    la protezione dei dati personali 2016/679, il d.lgs. 30/06/2003 n. 196 e successive
                                    modifiche e integrazioni.
                                </span>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
