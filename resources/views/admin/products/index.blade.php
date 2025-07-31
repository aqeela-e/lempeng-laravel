<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-7xl mx-auto">
        <h3 class="text-lg font-bold mb-4">Daftar Produk</h3>

        <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Produk
        </a>

        @foreach ($products as $product)
        <div class="bg-white p-4 mb-4 rounded shadow">
            <h4 class="text-lg font-semibold">{{ $product->name }}</h4>
            <p>Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <p>Stok: {{ $product->stock }}</p>

            <div class="mt-2 flex gap-2">
                <a href="{{ route('admin.products.edit', $product->id) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                    Edit
                </a>

                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus produk ini?')"
                            class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
