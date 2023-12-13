@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <div class="mb-3">
            <h4 class="fw-bold">Nuovo Appartamento</h4>
            <h6>Compila il form per aggiungere un nuovo appartamento!</h6>
        </div>

        {{-- @if ($errors->has('images.*'))
            @foreach ($errors->get('images.*') as $key => $error)
                {{ dd($key, $error[0]) }}
            @endforeach
        @endif --}}

        {{-- @if ($errors->has('images.*'))
            @foreach ($errors->get('images.*') as $key => $errors)
                @foreach ($errors as $error)
                    <h6>{{ $error }}</h6>
                @endforeach
            @endforeach
        @endif --}}

        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    {{-- title form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title" id="title" placeholder=""
                            value="{{ old('title') }}" />
                        <label for="title" class="text-capitalize">Titolo</label>
                        <div class="d-flex justify-content-between">
                            <small id="helpId" class="form-text text-muted">Inserisci un titolo</small>
                            @if ($errors->get('title'))
                                @foreach ($errors->get('title') as $error)
                                    <small class="form-text text-danger d-block">{{ $error }}
                                    </small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                {{-- images form --}}
                <div class="col-12">
                    <label for="images" class="d-block mb-2">Select images:</label>
                    <input type="file" id="images" class="custom-file-input w-100" name="images[]" multiple><br><br>

                    @if ($errors->has('images.*'))
                        @foreach ($errors->get('images.*') as $key => $error)
                            @foreach ($error as $message)
                                <small class="form-text text-danger ">{{ $message }}
                                </small>
                            @endforeach
                        @endforeach
                    @endif

                </div>
                <div class="col-12">
                    {{-- description form --}}
                    <div class="form-floating mb-3">
                        <textarea id="description" name="description" class="form-control" placeholder="" id="floatingTextarea">{{ old('description') }}</textarea>
                        <label for="description" class="text-capitalize">Descrizione</label>
                        <div class="d-flex justify-content-between">
                            <small id="helpId" class="form-text text-muted">Inserisci una descrizione</small>
                            @if ($errors->has('description'))
                                @foreach ($errors->get('description') as $error)
                                    <small class="form-text text-danger ">{{ $error }}</small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <h6 class="fs-5">Seleziona i servizi</h6>

                    <div class="row justify-content-center px-3 px-md-1">
                        @foreach ($services as $service)
                            <div
                                class="col-4 col-md-3 col-lg-2 form-check form-check-inline my-2 d-flex-inline flex-grow-1 bnb-service-col position-relative">

                                <input class="form-check-input me-2 services rounded-pill" type="checkbox"
                                    id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                                {{-- TODO: FINERE I CHECKBOX + RIPROPORRE IL LAYOUT IN EDIT  --}}
                                {{-- <i class="fa-regular fa-circle-check"></i> --}}

                                <div class="services_icons d-flex align-items-center ">
                                    <img style="height:20px" src="{{ asset($service->icon) }}" alt="">
                                    <label class="form-check-label me-2"
                                        for="service_{{ $service->id }}">{{ $service->name }}</label>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-between">
                        <small id="helpId" class="form-text text-muted">Inserisci almeno un servizio</small>
                        @if ($errors->get('services'))
                            @foreach ($errors->get('services') as $error)
                                <small class="form-text text-danger">{{ $error }}
                                </small>
                            @endforeach
                        @endif
                    </div>

                </div>
                <div class="col-md-4 mb-3">
                    <label for="rooms" class="form-label text-capitalize">Camere: </label>
                    <output id="amount_rooms" name="amount_rooms" for="rooms">{{ old('rooms', 1) }}</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="rooms" name="rooms" min="1" max="10"
                            value="{{ old('rooms', 1) }}" oninput="amount_rooms.value=rooms.value">
                        <span>10</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small id="helpId" class="form-text text-muted">Inserisci il numero di stanze</small>
                        @if ($errors->has('rooms'))
                            @foreach ($errors->get('rooms') as $error)
                                <small class="form-text text-danger ">{{ $error }}
                                </small>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="beds" class="form-label text-capitalize">Letti:</label>
                    <output id="amount_beds" name="amount_beds" for="beds">{{ old('beds', 1) }}</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="beds" name="beds" min="1" max="10"
                            value="{{ old('beds', 1) }}" oninput="amount_beds.value=beds.value">
                        <span>10</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small id="helpId" class="form-text text-muted">Inserisci il numero di letti</small>
                        @if ($errors->has('beds'))
                            @foreach ($errors->get('beds') as $error)
                                <small class="form-text text-danger ">{{ $error }}
                                </small>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="bathrooms" class="form-label text-capitalize">Bagni:</label>
                    <output id="amount_bathrooms" name="amount_bathrooms" for="bathrooms">
                        {{ old('bathrooms', 1) }}</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="bathrooms" name="bathrooms" min="1"
                            max="10" value="{{ old('bathrooms', 1) }}"
                            oninput="amount_bathrooms.value=bathrooms.value">
                        <span>10</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small id="helpId" class="form-text text-muted">Inserisci il numero di bagni</small>
                        @if ($errors->has('bathrooms'))
                            @foreach ($errors->get('bathrooms') as $error)
                                <small class="form-text text-danger ">{{ $error }}
                                </small>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    {{-- square meters form --}}
                    <div class="form-floating mb-3">
                        <input type="number" id="square_meters" name="square_meters" class="form-control"
                            placeholder="" id="floatingTextarea" value="{{ old('square_meters') }}" />
                        <label for="square_meters" class="text-capitalize">Metri Quadrati</label>

                        <div class="d-flex justify-content-between">
                            <small id="helpId" class="form-text text-muted">Inserisci la metratura</small>
                            @if ($errors->has('square_meters'))
                                @foreach ($errors->get('square_meters') as $error)
                                    <small class="form-text text-danger ">{{ $error }}
                                    </small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    {{-- address form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="address" id="address" placeholder=""
                            value="{{ old('address') }}" list="suggested_address" />

                        <datalist id="suggested_address">

                        </datalist>
                        <label for="address" class="text-capitalize">Indirizzo</label>

                        <div class="d-flex justify-content-between">
                            <small id="helpId" class="form-text text-muted">Inserisci la posizione</small>
                            @if ($errors->has('address'))
                                @foreach ($errors->get('address') as $error)
                                    <small class="form-text text-danger ">{{ $error }}
                                    </small>
                                @endforeach
                            @endif
                        </div>
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
