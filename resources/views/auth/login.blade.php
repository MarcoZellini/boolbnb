@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div>
                    <h4 class="fw-bold">Inserisci i dati di accesso</h4>

                    {{-- LOGIN FORM --}}
                    <form method="POST" action="{{ route('login') }}" class="my-4">
                        @csrf

                        {{-- EMAIL FORM --}}
                        <div class="mb-4 row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="@error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- PASSWORD FORM --}}
                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- REMEMBER ME CHECKBOX --}}
                        <div class="mb-4 row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ricordami') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- FORGOT PASSWORD FORM --}}
                        <div class="mb-4 row mb-0">
                            <div class="col-md-8 offset-md-4">

                                <button type="submit" class="btn btn-bnb rounded-pill">
                                    {{ __('Accedi') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="focusable-bnb">
                                        {{ __('Hai dimenticato la Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
