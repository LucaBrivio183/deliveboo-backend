@extends('layouts.app')

@section('content')
<div class="container bg-white">
    {{-- Canvas is needed in order to render the chart --}}
    <canvas id="this-year-orders" width="400" height="150"></canvas>
    <canvas id="this-year-money" width="400" height="150"></canvas>
    
    <script>
        // Send the JSON to JavaScript
        const orders = {{ Js::from($orders) }};
    </script>
</div>
@endsection