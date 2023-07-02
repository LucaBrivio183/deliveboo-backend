@extends('layouts.app')

@section('content')
<div class="container bg-white py-2">
    <div class="stats">
        <h1 id="current-year">Anno</h1>
        <div id="total-orders"><strong>Numero di ordini:</strong></div>
        <div id="amount-of-money"><strong>Fatturato totale:</strong></div>
    </div>
</div>
<div class="container bg-white">
    {{-- Canvas is needed in order to render the chart --}}
    <canvas id="this-year-orders" width="400" height="150"></canvas>
    <canvas id="this-year-money" width="400" height="150" class="my-5"></canvas>
    
    <script>
        // Send the JSON to JavaScript
        const orders = {{ Js::from($orders) }};
    </script>
</div>
@endsection