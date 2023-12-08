@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <div class="mb-3">
            <h4 class="fw-bold">Nuovo Appartamento</h4>
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

        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="col-12 mb-3 ">
                    <label for="images" class="form-label">Select images:</label>
                    <input type="file" id="images" class="custom-file-input w-100" name="images[]" multiple><br><br>
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
                    <h6 class="fs-5">Seleziona i servizi</h6>

                    <div class="row justify-content-center px-1">
                        @foreach ($services as $service)
                            <div
                                class="col-4 col-md-3 col-lg-2 form-check form-check-inline my-2 d-flex-inline flex-grow-1 bnb-service-col position-relative">

                                <input class="form-check-input me-2 services rounded-pill" type="checkbox" id="services[]"
                                    name="services[]" value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                                {{-- TODO: FINERE I CHECKBOX + RIPROPORRE IL LAYOUT IN EDIT  --}}
                                {{-- <i class="fa-regular fa-circle-check"></i> --}}

                                <div class="services_icons d-flex align-items-center ">
                                    <img style="height:20px" src="{{ asset($service->icon) }}" alt="">
                                    <label class="form-check-label" for="">{{ $service->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rooms" class="form-label text-capitalize">Camere: </label>
                    <output id="amount_rooms" name="amount_rooms" for="rooms">0</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="rooms" name="rooms" min="1" max="10"
                            value="{{ old('rooms', 1) }}" oninput="amount_rooms.value=rooms.value">
                        <span>10</span>

                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di stanze</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="beds" class="form-label text-capitalize">Letti:</label>
                    <output id="amount_beds" name="amount_beds" for="beds">0</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="beds" name="beds" min="1" max="10"
                            value="{{ old('beds', 1) }}" oninput="amount_beds.value=beds.value">
                        <span>10</span>
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di letti</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="bathrooms" class="form-label text-capitalize">Bagni:</label>
                    <output id="amount_bathrooms" name="amount_bathrooms" for="bathrooms">0</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="bathrooms" name="bathrooms" min="1" max="10"
                            value="{{ old('bathrooms', 1) }}" oninput="amount_bathrooms.value=bathrooms.value">
                        <span>10</span>
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di bagni</small>
                </div>
                <div class="col-12">
                    {{-- square meters form --}}
                    <div class="form-floating mb-3">
                        <input type="number" id="square_meters" name="square_meters" class="form-control"
                            placeholder="" id="floatingTextarea" value="{{ old('square_meters') }}" />
                        <label for="square_meters" class="text-capitalize">Metri Quadrati</label>
                        <small id="helpId" class="form-text text-muted">Inserisci la metratura</small>
                    </div>
                </div>
                <div class="col-12">
                    {{-- address form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="address" id="address" placeholder=""
                            value="{{ old('address') }}" list="Suggested_Address" />

                        <datalist id="Suggested_Address">

                        </datalist>

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

                <button type="submit" class="btn w-25 btn-bnb mt-2 rounded-pill">
                    Aggiungi
                </button>
            </div>
        </form>
    </div>
@endsection
