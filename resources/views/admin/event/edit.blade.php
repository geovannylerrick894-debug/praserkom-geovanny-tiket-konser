
{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>

    {{-- Menentukan bagian header halaman --}}
    <x-slot name="header">

        {{-- Membuat container header dengan judul di kiri dan tombol di kanan --}}
        <div class="flex justify-between items-center">

            {{-- Menampilkan judul halaman --}}
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Event
            </h2>

            {{-- Tombol untuk kembali ke daftar event --}}
            <a
                href="{{ route('events.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-semibold"
            >
                ← Kembali
            </a>

        </div>
    </x-slot>

    {{-- Membuat area utama untuk form edit event --}}
    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">

        {{-- Membuat form untuk memperbarui data event --}}
        <form
            action="{{ route('events.update', $event->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-sm border"
        >

            {{-- Melindungi form dari serangan CSRF --}}
            @csrf

            {{-- Menggunakan method PUT untuk proses update data --}}
            @method('PUT')

            {{-- Membuat bagian input nama event --}}
            <div class="mb-4">

                {{-- Menampilkan label nama event --}}
                <label class="block font-medium mb-1 text-gray-700">
                    Nama Event
                </label>

                {{-- Menampilkan nama event yang tersimpan dan dapat diedit --}}
                <input
                    type="text"
                    name="concert_name"
                    value="{{ old('concert_name', $event->concert_name) }}"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >

            </div>

            {{-- Membuat bagian pilihan kategori event --}}
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

                    {{-- Pilihan kategori Makanan --}}
                    <option value="Musik" {{ old('category', $event->category) == 'Musik' ? 'selected' : '' }}>
                        Musik
                    </option>

                    {{-- Pilihan kategori Minuman --}}
                    <option value="Festival" {{ old('category', $event->category) == 'Festival' ? 'selected' : '' }}>
                        Festival
                    </option>

                    {{-- Pilihan kategori Cemilan --}}
                    <option value="Seminar" {{ old('category', $event->category) == 'Seminar' ? 'selected' : '' }}>
                        Seminar
                    </option>

                </select>

            </div>

            {{-- Membuat bagian input harga event --}}
            <div class="mb-4">

                {{-- Menampilkan label harga event --}}
                <label class="block font-medium mb-1 text-gray-700">
                    Harga (Rp)
                </label>

                {{-- Menampilkan harga lama dan memungkinkan admin mengubahnya --}}
                <input
                    type="number"
                    name="ticket_price"
                    value="{{ old('ticket_price', $event->ticket_price) }}"
                    min="0"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >

            </div>

            {{-- Membuat bagian input deskripsi event --}}
            <div class="mb-4">

                {{-- Menampilkan label deskripsi --}}
                <label class="block font-medium mb-1 text-gray-700">
                    Deskripsi
                </label>

                {{-- Menampilkan deskripsi lama dan memungkinkan admin mengubahnya --}}
                <textarea
                    name="description"
                    rows="3"
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >{{ old('description', $event->description) }}</textarea>

            </div>

            {{-- Mengecek apakah event sudah memiliki gambar --}}
            @if($event->image)

                {{-- Membuat bagian untuk menampilkan gambar yang sedang digunakan --}}
                <div class="mb-4">

                    {{-- Menampilkan label gambar saat ini --}}
                    <label class="block font-medium mb-2 text-gray-700">
                        Gambar Saat Ini
                    </label>

                    {{-- Menampilkan gambar event yang tersimpan --}}
                    <img
                        src="{{ asset('storage/' . $event->image) }}"
                        alt="{{ $event->name }}"
                        class="w-32 h-32 object-cover rounded-md border"
                    >

                </div>

            @endif

            {{-- Membuat bagian untuk mengganti gambar event --}}
            <div class="mb-6">

                {{-- Menampilkan label untuk gambar baru --}}
                <label class="block font-medium mb-1 text-gray-700">
                    Gambar Baru
                    <span class="text-gray-500 font-normal">(Opsional)</span>
                </label>

                {{-- Membuat input untuk memilih gambar baru dari komputer --}}
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded-md p-2 bg-white"
                >

                {{-- Memberikan informasi bahwa gambar baru bersifat opsional --}}
                <p class="text-xs text-gray-500 mt-1">
                    Kosongkan jika tidak ingin mengganti gambar.
                </p>

            </div>

            {{-- Membuat bagian tombol aksi --}}
            <div class="mt-6 flex items-center justify-center gap-4">

                {{-- Tombol untuk membatalkan proses edit dan kembali ke daftar event --}}
                <a
                    href="/admin/events"
                    class="bg-gray-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-600"
                >
                    Batal
                </a>

                {{-- Tombol untuk mengirim form dan memperbarui data event --}}
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-blue-700"
                >
                    Update Data
                </button>

            </div>

        </form>

    </div>

{{-- Mengakhiri layout utama aplikasi --}}
</x-app-layout>
```