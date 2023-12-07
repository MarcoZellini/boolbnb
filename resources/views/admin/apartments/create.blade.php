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
                        <input type="text" class="form-control" name="title" id="title" placeholder="" />
                        <label for="title" class="text-capitalize">Titolo</label>
                        <small id="helpId" class="form-text text-muted">Inserisci un titolo</small>
                    </div>
                </div>
                <div class="col-12">
                    {{-- description form --}}
                    <div class="form-floating mb-3">
                        <textarea id="description" name="description" class="form-control" placeholder="" id="floatingTextarea"
                            style="height: 100px"></textarea>
                        <label for="description" class="text-capitalize">Descrizione</label>
                        <small id="helpId" class="form-text text-muted">Inserisci una descrizione</small>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="rooms" class="form-label text-capitalize">Camere</label>
                    <div class="d-flex gap-2">
                        1<input type="range" class="form-range" id="rooms" name=rooms min="1" max="10">10
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di stanze</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="beds" class="form-label text-capitalize">Letti</label>
                    <div class="d-flex gap-2">
                        1<input type="range" class="form-range" id="beds" name=beds min="1" max="10">10
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di letti</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="bathrooms" class="form-label text-capitalize">Bagni</label>
                    <div class="d-flex gap-2">
                        1<input type="range" class="form-range" id="bathrooms" name="bathrooms" min="1"
                            max="10">10
                    </div>
                    <small id="helpId" class="form-text text-muted">Inserisci il numero di bagni</small>
                </div>
                <div class="col-12">
                    {{-- square meters form --}}
                    <div class="form-floating mb-3">
                        <input type="number" id="square_meters" name="square_meters" class="form-control" placeholder=""
                            id="floatingTextarea" />
                        <label for="square_meters" class="text-capitalize">Metri Quadrati</label>
                        <small id="helpId" class="form-text text-muted">Inserisci la metratura</small>
                    </div>
                </div>
                <div class="col-12">
                    {{-- address form --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="address" id="address" placeholder="" />
                        <label for="address" class="text-capitalize">Indirizzo</label>
                        <small id="helpId" class="form-text text-muted">Inserisci la posizione</small>
                    </div>
                </div>

                {{-- is_visible form --}}
                <div class="col-12 d-flex gap-3 mb-3">
                    <label for="address" class="text-capitalize">Rendere visibile l'appartamento?:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_visible" id="is_visible" value="1" />
                        <label class="form-check-label text-capitalize" for="is_visible">si</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_visible" id="is_not_visible"
                            value="0" checked />
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
