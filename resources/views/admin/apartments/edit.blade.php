@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="mb-3">
            <h3>Modifica Appartamento</h3>
            <h6>Compila il form per modificare l'appartamento!</h6>
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

        @forelse ($apartment->images as $image)
            <form id="set_main_{{ $image->id }}"
                action="{{ route('admin.apartments.image.setMain', [$apartment, $image]) }}" method="POST">
                @csrf
                @method('PUT')
            </form>
            <form id="delete_image_{{ $image->id }}"
                action="{{ route('admin.apartments.image.delete', [$apartment, $image]) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @empty
        @endforelse

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
                        <small id="helpId" class="form-text text-muted">Inserisci un titolo</small>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="images">Aggiungi immagini:</label>
                    <input type="file" id="images" name="images[]" multiple><br><br>
                </div>

                <div class="col-12 mb-3">
                    <h6>Gestisci immagini</h6>
                    <div class="table-responsive">
                        <table class="table table-info table-striped table-bordered border-dark align-middle text-center">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-uppercase">id</th>
                                    <th scope="col" class="text-capitalize">Immagine</th>
                                    <th scope="col" class="text-capitalize">principale</th>
                                    <th scope="col" class="text-capitalize">azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($apartment->images as $image)
                                    <tr>
                                        <td>{{ $image->id }}</td>
                                        <td>
                                            <img height="50px" src="{{ asset('storage/' . $image->path) }}" alt="">
                                        </td>
                                        <td>

                                            @if ($image->is_main)
                                                <span>Si</span>
                                            @else
                                                <button type="submit" class="btn btn-success"
                                                    form="set_main_{{ $image->id }}">Imposta
                                                    Principale</button>
                                            @endif
                                        </td>
                                        <td>

                                            <!-- Modal trigger button -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalId-{{ $image->id }}">
                                                Elimina
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modalId-{{ $image->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Eliminare immagine #{{ $image->id }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">Vuoi davvero eliminare questa immagine?
                                                            Quest'azione non e' reversibile.</div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            {{-- TODO Impostare la action per eliminare la foto --}}

                                                            <button type="submit" class="btn btn-danger"
                                                                form="delete_image_{{ $image->id }}">Elimina</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            Non ci sono immagini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="col-12">
                    {{-- description form --}}
                    <div class="form-floating mb-3">
                        <textarea style="min-height: 150px" id="description" name="description" class="form-control" placeholder=""
                            id="floatingTextarea" style="height: 100px">{{ old('description', $apartment->description) }}</textarea>
                        <label for="description" class="text-capitalize">Descrizione</label>
                        <small id="helpId" class="form-text text-muted">Inserisci una descrizione</small>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <p class="fs-5">Seleziona i servizi</p>

                    <div class="row justify-content-center px-3">
                        @foreach ($services as $service)
                            <div class="col-2 form-check form-check-inline my-2 d-flex-inline flex-grow-1">
                                @if ($errors->any())
                                    <input class="form-check-input me-2" type="checkbox" id="services[]" name="services[]"
                                        value="{{ $service->id }}"
                                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                                @else
                                    <input class="form-check-input me-2" type="checkbox" id="services[]"
                                        name="services[]" value="{{ $service->id }}"
                                        {{ $apartment->services->contains($service->id) ? 'checked' : '' }} />
                                @endif
                                <img style="height:20px" src="{{ asset($service->icon) }}" alt="">
                                <label class="form-check-label" for="">{{ $service->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rooms" class="form-label text-capitalize">Camere:</label>
                    <output id="amount_rooms" name="amount_rooms" for="rooms">0</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="rooms" name="rooms" min="1"
                            max="10" value="{{ old('rooms', $apartment->rooms) }}"
                            oninput="amount_rooms.value=rooms.value">
                        <span>10</span>
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di stanze</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="beds" class="form-label text-capitalize">Letti:</label>
                    <output id="amount_beds" name="amount_beds" for="beds">0</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="beds" name="beds" min="1"
                            max="10" value="{{ old('beds', $apartment->beds) }}"
                            oninput="amount_beds.value=beds.value">
                        <span>10</span>
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di letti</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="bathrooms" class="form-label text-capitalize">Bagni:</label>
                    <output id="amount_bathrooms" name="amount_bathrooms" for="bathrooms">0</output>

                    <div class="d-flex align-items-center gap-2">
                        <span>1</span>
                        <input type="range" class="slider" id="bathrooms" name="bathrooms" min="1"
                            max="10" value="{{ old('bathrooms', $apartment->bathrooms) }}"
                            oninput="amount_bathrooms.value=bathrooms.value">
                        <span>10</span>
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di bagni</small>
                </div>
                <div class="col-12">
                    {{-- square meters form --}}
                    <div class="form-floating mb-3">
                        <input type="number" id="square_meters" name="square_meters" class="form-control"
                            placeholder="" id="floatingTextarea"
                            value="{{ old('square_meters', $apartment->square_meters) }}" />
                        <label for="square_meters" class="text-capitalize">Metri Quadrati</label>
                        <small id="helpId" class="form-text text-muted">Inserisci la metratura</small>
                    </div>
                </div>
                <div class="col-12">
                    {{-- address form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="address" id="address" placeholder=""
                            value="{{ old('address', $apartment->address) }}" list="Suggested_Address" />
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
