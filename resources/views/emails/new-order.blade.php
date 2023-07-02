
    <h1>
        Hai ricevuto un ordine da {{ $order->name }}!
    </h1>  

    <div>
        Dettagli del cliente:
    </div>
    <ul>
        <li>
            <strong>Nome: </strong>{{ $order->name}}
        </li>
        <li>
            <strong>Indirizzo: </strong>{{ $order->address}}
        </li>
        <li>
            <strong>Numero di telefono: </strong>{{$order->phone_number}}
        </li>
        <li>
            <strong>Indirizzo email: </strong>{{ $order->email }}
        </li>
    </ul>

    <div>Quanto hanno speso: {{ $order->total_price }} €</div>

    <div>
        Cosa hanno acquistato: 
    </div>

    <ul>
        @foreach ($order->products as $product)
            <li>
                <span>{{ $product->name }}: </span>
                <span>{{ $product->pivot->quantity }} pezzi</span>
            </li>
        @endforeach
    </ul>