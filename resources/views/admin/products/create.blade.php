<!-- resources/views/admin/products/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Produk Baru
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-4xl mx-auto bg-white shadow-lg rounded-lg">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Produk -->
                <div>
                    <x-input-label for="name" :value="'Nama Produk'" />
                    <x-text-input id="name" name="name" class="w-full" placeholder="Contoh: Lempeng Singkong" required />
                </div>

                <!-- Harga -->
                <div>
                    <x-input-label for="price" :value="'Harga (Rp)'" />
                    <x-text-input id="price" name="price" type="number" class="w-full" placeholder="Contoh: 10000" required />
                </div>

                <!-- Stok -->
                <div>
                    <x-input-label for="stock" :value="'Stok Produk'" />
                    <x-text-input id="stock" name="stock" type="number" class="w-full" placeholder="Contoh: 50" required />
                </div>

                <!-- WhatsApp -->
                <div>
                    <x-input-label for="wa" :value="'Nomor WhatsApp Mitra'" />
                    <x-text-input id="wa" name="wa" class="w-full" placeholder="6281234567890" />
                </div>

                <!-- Instagram -->
                <div>
                    <x-input-label for="ig" :value="'Username Instagram Mitra'" />
                    <x-text-input id="ig" name="ig" class="w-full" placeholder="contoh: mitralempeng" />
                </div>

                <!-- Gambar Produk -->
                <div>
                    <x-input-label for="image" :value="'Gambar Produk'" />
                    <input id="image" type="file" name="image" class="block w-full mt-2 border-gray-300 shadow-sm rounded-md" />
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <x-input-label for="description" :value="'Deskripsi Produk'" />
                <textarea id="description" name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="Deskripsi lengkap produk..."></textarea>
            </div>

            <!-- Tombol -->
            <div class="text-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded shadow-md transition duration-200">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
