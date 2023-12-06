@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="my-4 text-end">
            <a class="btn btn-primary d-flex d-inline-flex align-items-center gap-1"
                href="{{ route('admin.apartments.create') }}" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                Aggiungi Appartamento
            </a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">Apartments List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-info table-striped table-bordered border-dark align-middle text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-capitalize">titolo</th>
                                        <th scope="col" class="text-capitalize">image</th>
                                        <th scope="col" class="text-capitalize">indirizzo</th>
                                        <th scope="col" class="text-capitalize">visibile</th>
                                        <th scope="col" class="text-capitalize">azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apartments as $apartment)
                                        <tr>
                                            <td>{{ $apartment->title }}</td>
                                            <td>
                                                @if ($apartment->images->where('is_main', true)->first()?->path)
                                                    <img style="height:60px"
                                                        src="{{ asset('storage/' . $apartment->images->where('is_main', true)->first()->path) }}">
                                                @else
                                                    <img style="height:60px"
                                                        src="{{ asset('storage/placeholders/placeholder.jpg') }}">
                                                @endif

                                            </td>
                                            <td>{{ $apartment->address ? $apartment->address : 'Non Impostato' }}</td>
                                            <td>{{ $apartment->is_visible ? 'Si' : 'No' }}</td>
                                            <td class="">
                                                <a class="btn btn-primary d-flex d-inline-flex align-items-center gap-1"
                                                    href="#" role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path
                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                    Mostra
                                                </a>
                                                <a class="btn btn-warning d-flex d-inline-flex align-items-center gap-1"
                                                    href="#" role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                                    </svg>
                                                    Modifica
                                                </a>
                                                <a class="btn btn-danger d-flex d-inline-flex align-items-center gap-1"
                                                    href="#" role="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                    Elimina
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
