@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="row">
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

            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }} 🤩
                </div>
            @endif

            <div class="col-12">
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
            </div>

            <div class="col-12">
                <a name="" id="" class="btn btn-success" href="{{ url()->previous() }}" role="button">Back
                    To
                    Apartments</a>
                <a name="" id="" class="btn btn-primary"
                    href="{{ route('admin.apartments.show', $apartment) }}" role="button">Show
                    Apartment</a>
            </div>
        </div>
    </div>
@endsection
