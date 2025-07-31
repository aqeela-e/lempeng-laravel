<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-4xl mx-auto bg-white shadow-md rounded">
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-semibold">Nama Produk:</label>
                <input type="text" name="name" class="form-control w-full" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-semibold">Harga:</label>
                <input type="number" name="price" class="form-control w-full" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-4">
                <label for="stock" class="block font-semibold">Stok:</label>
                <input type="number" name="stock" class="form-control w-full" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="mb-4">
                <x-input-label for="wa" :value="'Nomor WhatsApp Mitra'" />
                <x-text-input type="text" name="wa" class="w-full" value="{{ old('wa', $product->wa) }}" placeholder="contoh: 6281234567890" />
            </div>

            <div class="mb-4">
                <x-input-label for="ig" :value="'Username Instagram Mitra'" />
                <x-text-input type="text" name="ig" class="w-full" value="{{ old('ig', $product->ig) }}" placeholder="contoh: mitralempeng" />
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold">Deskripsi:</label>
                <textarea name="description" class="form-control w-full">{{ old('description', $product->description) }}</textarea>
            </div>

            @if ($product->image)
                <div class="mb-4">
                    <label class="block font-semibold">Gambar Saat Ini:</label>
                    <img src="{{ asset('storage/'.$product->image) }}" width="150" class="mb-2">
                </div>
            @endif

            <div class="mb-4">
                <label for="image" class="block font-semibold">Upload Gambar Baru (Opsional):</label>
                <input type="file" name="image" class="form-control w-full">
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
