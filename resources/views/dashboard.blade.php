@foreach($products as $product)
    <div>
        <h3>{{ $product->name }}</h3>
        <p>Harga: Rp{{ $product->price }}</p>
        <p>Stok: {{ $product->stock }}</p>
        <p>Hubungi: 
           <a href="https://wa.me/{{ $product->user->wa }}">WhatsApp</a> /
           <a href="{{ $product->user->ig }}">Instagram</a>
        </p>
    </div>
@endforeach
