@extends('themes.default.layout')

@section('content')
    <div class="processing-block"></div>


    <main class="paypal-success">
        <img src="{{ asset('images/processing-icon.png') }}">
        <h1>Processing Payment</h1>
    </main>
@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('js/pages/paypalSuccess.js')}}" ></script>
@append