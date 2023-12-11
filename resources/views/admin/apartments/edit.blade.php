@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="mb-3">
            <h3>Modifica Appartamento</h3>
            <h6>Compila il form per modificare l'appartamento!</h6>
        </div>



        <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12">
                    {{-- title form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title" id="title" placeholder=""
                            value="{{ old('title', $apartment->title) }}" />
                        <label for="title" class="text-capitalize">Titolo</label>
                        <div class="d-flex justify-content-between">
                            <small id="helpId" class="form-text text-muted">Inserisci un titolo</small>
                            @if ($errors->has('title'))
                                @foreach ($errors->get('title') as $error)
                                    <small class="form-text text-danger ">{{ $error }}
                                    </small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="images" class="text-capitalize d-block">Immagini</label>

                    @forelse($apartment->images as $image)
                        <img height="50px" src="{{ asset('storage/' . $image->path) }}" alt="">
                    @empty
                        <h5>Non sono presenti immagini</h5>
                    @endforelse

                </div>

                <div class="col-12 mb-3">
                    <a class="btn btn-bnb rounded-pill" href="{{ route('admin.apartments.images.index', $apartment) }}"
                        role="button">Gestisci Immagini</a>
                </div>

                <div class="col-12">
                    <label for="images" class="d-block mb-2">Aggiungi immagini:</label>
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

                <div class="col-12 mb-3">
                    {{-- description form --}}
                    <div class="form-floating mb-3">
                        <textarea id="description" name="description" class="form-control" placeholder="" id="floatingTextarea">{{ old('description', $apartment->description) }}</textarea>
                        <label for="description" class="text-capitalize">Descrizione</label>

                        <div class="d-flex justify-content-between">
                            <small id="helpId" class="form-text text-muted">Inserisci una descrizione</small>
                            @if ($errors->has('description'))
                                @foreach ($errors->get('description') as $error)
                                    <small class="form-text text-danger ">{{ $error }}
                                    </small>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <h6 class="fs-5">Seleziona i servizi</h6>

                    <div class="row justify-content-center px-3">
                        @foreach ($services as $service)
                            <div
                                class="col-4 col-md-3 col-lg-2 form-check form-check-inline my-2 d-flex-inline flex-grow-1 bnb-service-col position-relative">
                                @if ($errors->any())
                                    <input class="form-check-input me-2 services rounded-pill" type="checkbox"
                                        id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                                @else
                                    <input class="form-check-input me-2 services rounded-pill" type="checkbox"
                                        id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                                        {{ $apartment->services->contains($service->id) ? 'checked' : '' }} />
                                @endif
                                <img style="height:20px" src="{{ asset($service->icon) }}" alt="">
                                <label class="form-check-label me-2"
                                    for="service_{{ $service->id }}">{{ $service->name }}</label>
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
                    <label for="rooms" class="form-label text-capitalize">Camere:</label>
                    <output id="amount_rooms" name="amount_rooms" for="rooms">1</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="rooms" name="rooms" min="1" max="10"
                            value="{{ old('rooms', $apartment->rooms) }}" oninput="amount_rooms.value=rooms.value">
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
                    <output id="amount_beds" name="amount_beds" for="beds">1</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="beds" name="beds" min="1"
                            max="10" value="{{ old('beds', $apartment->beds) }}"
                            oninput="amount_beds.value=beds.value">
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
                    <output id="amount_bathrooms" name="amount_bathrooms" for="bathrooms">1</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="bathrooms" name="bathrooms" min="1"
                            max="10" value="{{ old('bathrooms', $apartment->bathrooms) }}"
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
                            placeholder="" id="floatingTextarea"
                            value="{{ old('square_meters', $apartment->square_meters) }}" />
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
                            value="{{ old('address', $apartment->address) }}" list="suggested_address" />

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
                            {{ old('is_visible', $apartment->is_visible) == '1' ? 'checked' : '' }} />
                        <label class="form-check-label text-capitalize" for="is_visible">si</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_visible" id="is_not_visible"
                            value="0" {{ old('is_visible', $apartment->is_visible) == '0' ? 'checked' : '' }} />
                        <label class="form-check-label text-capitalize" for="is_not_visible">no</label>
                    </div>
                </div>

                <button type="submit" class="w-25 btn btn-bnb mt-2 rounded-pill">
                    Modifica
                </button>
            </div>
        </form>
    </div>
@endsection
