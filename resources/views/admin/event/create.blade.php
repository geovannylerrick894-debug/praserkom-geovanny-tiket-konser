
{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>

    {{-- Menentukan bagian header halaman --}}
    <x-slot name="header">

        {{-- Membuat container header dengan judul di kiri dan tombol di kanan --}}
        <div class="flex justify-between items-center">

            {{-- Menampilkan judul halaman --}}
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Makanan
            </h2>

            {{-- Tombol untuk kembali ke daftar makanan --}}
            <a
                href="{{ route('events.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-semibold"
            >
                ← Kembali
            </a>

        </div>
    </x-slot>

    {{-- Membuat area utama untuk form tambah makanan --}}
    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">

        {{-- Membuat form untuk menyimpan data makanan baru --}}
        <form
            action="{{ route('events.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-sm border"
        >
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">
                    Nama Event
                </label>
                <input
                    type="text"
                    name="concert_name"
                    value="{{ old('concert_name') }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: Seminar Teknologi"
                    required
                >

            </div>

            {{-- Membuat bagian pilihan kategori makanan --}}
            <div class="mb-4">

                {{-- Menampilkan label kategori --}}
                <label class="block font-medium mb-1 text-gray-700">
                    Kategori
                </label>

                {{-- Membuat dropdown untuk memilih kategori makanan --}}
                <select
                    name="category"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >

                    {{-- Pilihan default sebelum kategori dipilih --}}
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Musik" {{ old('category') == 'Musik' ? 'selected' : '' }}>
                        Musik
                    </option>

                    <option value="Festival" {{ old('category') == 'Festival' ? 'selected' : '' }}>
                        Festival
                    </option>

                    <option value="Seminar" {{ old('category') == 'Seminar' ? 'selected' : '' }}>
                        Seminar
                    </option>

                </select>

            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">
                    Harga (Rp)
                </label>
                <input
                    type="number"
                    name="ticket_price"
                    value="{{ old('ticket_price') }}"
                    min="0"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: 15000"
                    required
                >

            </div>

            {{-- Membuat bagian input deskripsi makanan --}}
            <div class="mb-4">

                {{-- Menampilkan label deskripsi --}}
                <label class="block font-medium mb-1 text-gray-700">
                    Deskripsi
                </label>

                {{-- Textarea untuk memasukkan deskripsi makanan --}}
                <textarea
                    name="description"
                    rows="3"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan deskripsi event di sini..."
                    required
                >{{ old('description') }}</textarea>

            </div>

            {{-- Membuat bagian untuk upload gambar makanan --}}
            <div class="mb-6">

                {{-- Menampilkan label gambar --}}
                <label class="block font-medium mb-1 text-gray-700">
                    Gambar Event
                </label>

                {{-- Input untuk memilih file gambar dari komputer --}}
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded-md p-2 bg-white"
                >

                {{-- Menampilkan informasi format dan ukuran gambar yang diperbolehkan --}}
                <p class="text-xs text-gray-500 mt-1">
                    Format: JPG, JPEG, PNG. Maksimal 2 MB.
                </p>

            </div>

            {{-- Membuat bagian tombol aksi --}}
            <div class="mt-6 flex items-center justify-center gap-4">

                {{-- Tombol untuk membatalkan proses dan kembali ke daftar makanan --}}
                <a
                    href="/admin/foods"
                    class="bg-gray-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-600"
                >
                    Batal
                </a>

                {{-- Tombol untuk mengirim form dan menyimpan data makanan --}}
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-blue-700"
                >
                    Simpan Data
                </button>

            </div>

        </form>

    </div>

{{-- Mengakhiri layout utama aplikasi --}}
</x-app-layout>
```