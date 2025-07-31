{{-- resources/views/mitra_dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('📦 Dashboard Mitra') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold mb-6 text-gray-700">👋 Halo, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mb-6">Berikut adalah daftar produk milik Anda:</p>

                <!-- Alert -->
                @if(session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 border border-green-300 p-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 text-red-700 bg-red-100 border border-red-300 p-3 rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if($products->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-md border hover:shadow-lg transition p-4">
                                @if ($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" 
                                        class="w-full h-40 object-cover rounded mb-3 hover:scale-105 transition duration-300 ease-in-out">
                                @endif

                                <h4 class="text-lg font-bold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">💰 Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-600">📦 Stok saat ini: <strong>{{ $product->stock }}</strong></p>

                                <!-- Form Kurangi Stok -->
                                <form method="POST" action="{{ route('mitra.products.stock', $product->id) }}" class="mt-4">
                                    @csrf
                                    <label class="text-sm block text-gray-700 mb-1">Kurangi Stok:</label>
                                    <div class="flex items-center gap-2">
                                        <input type="number" name="stock" min="0" max="{{ $product->stock }}"
                                            class="border-gray-300 rounded px-3 py-1 w-24 shadow-sm focus:ring-green-500 focus:border-green-500"
                                            placeholder="0" required>

                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-1 rounded transition">
                                            Kurangi stok
                                        </button>
                                    </div>
                                    @error('stock')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 mt-4">Belum ada produk yang Anda tambahkan.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
