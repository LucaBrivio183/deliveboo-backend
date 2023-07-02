
    <div class="container">
        <h1>Grazie per l'acquisto, {{ $order->name }}!</h1>

        <div>I tuoi ordini:</div>

        <ul>
            @foreach ($order->products as $product)
            <li>
                <span>{{ $product->name }}: </span>
                <span>{{ $product->pivot->quantity }} pezzi</span>
                @endforeach
            </li>
        </ul>
        <div class="my-4">Prezzo totale: {{ $order->total_price }} €</div>
    </div>  
