@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="mb-3">
            <h3>Nuovo Appartamento</h3>
            <h6>Compila il form per aggiungere un nuovo appartamento!</h6>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><strong>Errore! </strong> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.apartments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    {{-- title form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title" id="title" placeholder=""
                            value="{{ old('title') }}" />
                        <label for="title" class="text-capitalize">Titolo</label>
                        <small id="helpId" class="form-text text-muted">Inserisci un titolo</small>
                    </div>
                </div>
                <div class="col-12">
                    {{-- description form --}}
                    <div class="form-floating mb-3">
                        <textarea id="description" name="description" class="form-control" placeholder="" id="floatingTextarea"
                            style="height: 100px">{{ old('description') }}</textarea>
                        <label for="description" class="text-capitalize">Descrizione</label>
                        <small id="helpId" class="form-text text-muted">Inserisci una descrizione</small>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <p class="fs-5">Seleziona i servizi</p>

                    <div class="row justify-content-center px-3">
                        @foreach ($services as $service)
                            <div class="col-2 form-check form-check-inline my-2 d-flex-inline flex-grow-1">
                                <input class="form-check-input me-2" type="checkbox" id="services[]" name="services[]"
                                    value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                                <img style="height:20px" src="{{ asset($service->icon) }}" alt="">
                                <label class="form-check-label" for="">{{ $service->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rooms" class="form-label text-capitalize">Camere</label>
                    <div class="d-flex gap-2">
                        1<input type="range" class="form-range" id="rooms" name="rooms" min="1"
                            max="10" value="{{ old('rooms', 1) }}">10
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di stanze</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="beds" class="form-label text-capitalize">Letti</label>
                    <div class="d-flex gap-2">
                        1<input type="range" class="form-range" id="beds" name="beds" min="1"
                            max="10" value="{{ old('beds', 1) }}">10
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di letti</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="bathrooms" class="form-label text-capitalize">Bagni</label>
                    <div class="d-flex gap-2">
                        1<input type="range" class="form-range" id="bathrooms" name="bathrooms" min="1"
                            max="10" value="{{ old('bathrooms', 1) }}">10
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di bagni</small>
                </div>
                <div class="col-12">
                    {{-- square meters form --}}
                    <div class="form-floating mb-3">
                        <input type="number" id="square_meters" name="square_meters" class="form-control" placeholder=""
                            id="floatingTextarea" value="{{ old('square_meters') }}" />
                        <label for="square_meters" class="text-capitalize">Metri Quadrati</label>
                        <small id="helpId" class="form-text text-muted">Inserisci la metratura</small>
                    </div>
                </div>
                <div class="col-12">
                    {{-- address form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="address" id="address" placeholder=""
                            value="{{ old('address') }}" />
                        <label for="address" class="text-capitalize">Indirizzo</label>
                        <small id="helpId" class="form-text text-muted">Inserisci la posizione</small>
                    </div>
                </div>

                {{-- is_visible form --}}
                <div class="col-12 d-flex gap-3 mb-3">
                    <label for="address" class="text-capitalize">Rendere visibile l'appartamento?:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="1"
                            {{ old('is_visible') == '1' ? 'checked' : '' }} />
                        <label class="form-check-label text-capitalize" for="is_visible">si</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_visible" id="is_not_visible"
                            value="0" {{ old('is_visible', 0) == '0' ? 'checked' : '' }} />
                        <label class="form-check-label text-capitalize" for="is_not_visible">no</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-2">
                    Aggiungi
                </button>
            </div>
        </form>
    </div>
@endsection
