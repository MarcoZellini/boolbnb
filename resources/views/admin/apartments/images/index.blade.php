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

            <br>

            <div class="col-12">
                <div class="col-12 mb-3">
                    <h6 class="mb-2">Gestisci le immagini:</h6>

                    <div class="table-responsive">
                        <table class="table align-middle text-center">
                            <tbody>
                                @forelse ($apartment->images as $image)
                                    <tr class="border-top">
                                        {{-- <td>{{ $image->id }}</td> --}}
                                        <td class="text-center py-4">
                                            <img height="50px" src="{{ asset('storage/' . $image->path) }}" alt="">
                                        </td>
                                        <td>

                                            @if ($image->is_main)
                                                <span>Immagine Principale</span>
                                            @else
                                                <a href=""
                                                    onclick="event.preventDefault();
                                                document.getElementById('set_main_{{ $image->id }}').submit();">Rendi
                                                    Principale</a>

                                            @endif
                                        </td>
                                        <td>

                                            <!-- Modal trigger button -->
                                            <button type="button"
                                                class="btn btn-danger rounded-circle border bnb-btn-shadow bnb-btn-actions"
                                                data-bs-toggle="modal" data-bs-target="#modalId-{{ $image->id }}">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                </svg>

                                            </button>

                                            <!-- Modal Body -->
                                            <div class="modal fade" id="modalId-{{ $image->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Eliminare l'immagine?
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <i class="fa-solid fa-circle-exclamation fa-lg"
                                                                style="color: #e00b41;"></i>
                                                            Vuoi davvero eliminare questa immagine?
                                                            <br>
                                                            L'operazione è irreversibile!
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn rounded-pill btn-outline-secondary btn-bnb-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            {{-- TODO Impostare la action per eliminare la foto --}}

                                                            <button type="submit" class="btn btn-bnb rounded-pill"
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

            <div class="col-12 mb-3">

                <a class="btn btn-primary rounded-circle border bnb-btn-shadow bnb-btn-actions me-1 "
                    href="{{ url()->previous() }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                    </svg>
                </a>

                <a class="btn btn-light rounded-circle border bnb-btn-shadow me-1 bnb-btn-actions"
                    href="{{ route('admin.apartments.show', $apartment->id) }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                        <path
                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                    </svg>
                </a>

                <a class="btn btn-warning rounded-circle border bnb-btn-shadow bnb-btn-actions  me-1"
                    href="{{ route('admin.apartments.edit', $apartment->id) }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
@endsection
