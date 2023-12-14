@extends('layouts.admin')

@section('content')
    <div class="container">
        <input type="hidden" id="client_token" value="{{ $client_token }}" />

        <form id="payment-form"
            action="{{ route('admin.apartments.sponsorships.payment.process', ['sponsorship' => $sponsorship->id, 'apartment' => $apartment->id]) }}"
            method="post" class="d-flex flex-column jusity-content-center align-items-center mt-5">
            <h3>Inserisci i dati della tua carta</h3>
            @csrf
            {{-- Putting the empty container you plan to pass to
            'braintree.dropin.create' inside a form will make layout and flow
            easier to manage --}}
            <div id="dropin-container"></div>
            <input type="submit" />
            <input type="hidden" id="nonce" name="payment_method_nonce" />
        </form>
    </div>
@endsection
