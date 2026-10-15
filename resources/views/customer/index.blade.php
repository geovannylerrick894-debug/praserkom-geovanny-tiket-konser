<!-- Menentukan jenis dokumen HTML -->
<!DOCTYPE html>

<!-- Membuat halaman dengan bahasa Indonesia -->
<html lang="id">

<!-- Menentukan bagian kepala halaman -->
<head>

    <!-- Menentukan karakter yang digunakan -->
    <meta charset="UTF-8">

    <!-- Membuat tampilan responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Menentukan judul halaman -->
    <title>Event</title>

    <!-- Menggunakan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- Membuat tampilan utama halaman -->
<body class="bg-gray-100 p-6 font-sans">

    <!-- Membatasi lebar konten halaman -->
    <div class="max-w-5xl mx-auto">

        <!-- Menampilkan judul event restoran -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Event</h1>

            <!-- Menampilkan petunjuk untuk pelanggan -->
            <p class="text-gray-500 text-sm mt-1">
                Pilih event yang ingin Anda ikuti
            </p>
        </div>

        <!-- Menampilkan pesan berhasil -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Menampilkan pesan error -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <!-- Mengecek apakah terdapat error validasi -->
        @if($errors->any())

            <!-- Menampilkan daftar error validasi -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 font-semibold">

                <!-- Membuat daftar error -->
                <ul class="list-disc list-inside">

                    <!-- Mengulang semua pesan error -->
                    @foreach($errors->all() as $error)

                        <!-- Menampilkan pesan error -->
                        <li>{{ $error }}</li>

                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Membuat tombol filter berdasarkan kategori -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">

            <!-- Tombol untuk menampilkan semua event -->
            <button
                type="button"
                onclick="filterCategory('all', this)"
                class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-blue-600 text-white shadow-md"
            >
                Semua Event
            </button>

            <!-- Tombol untuk menampilkan Musik -->
            <button
                type="button"
                onclick="filterCategory('Musik', this)"
                class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-white text-gray-600 hover:bg-gray-200 border"
            >
                Musik
            </button>

            <!-- Tombol untuk menampilkan Festival -->
            <button
                type="button"
                onclick="filterCategory('Festival', this)"
                class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-white text-gray-600 hover:bg-gray-200 border"
            >
                Festival
            </button>

            <!-- Tombol untuk menampilkan Seminar -->
            <button
                type="button"
                onclick="filterCategory('Seminar', this)"
                class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-white text-gray-600 hover:bg-gray-200 border"
            >
                Seminar
            </button>
        </div>

        <!-- Membuat form untuk mengirim pesanan -->
        <form id="orderForm" action="{{ route('customer.checkout') }}" method="POST">

            <!-- Melindungi form dari serangan CSRF -->
            @csrf

            <!-- Membuat bagian informasi pemesan -->
            <div class="bg-white p-6 rounded-xl shadow-sm border mb-6">

                <!-- Menampilkan judul informasi pemesan -->
                <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">
                    1. Informasi Pemesan
                </h2>

                <!-- Membuat layout input pemesan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Input nama pemesan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="customer_name"
                            name="customer_name"
                            required
                            placeholder="Masukkan nama pemesan"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        >
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">
                            Email
                        </label>

                        <input
                            type="email"
                            id="customer_email"
                            name="customer_email"
                            required
                            placeholder="Contoh: john.doe@example.com"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        >
                    </div>
                </div>
            </div>

            <!-- Menampilkan judul bagian pilihan event -->
            <h2 class="text-lg font-bold text-gray-700 mb-4">
                2. Pilih Event yang Ingin Diikuti
            </h2>

            <!-- Membuat grid daftar Event -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Mengulang seluruh data event -->
                @foreach($Events as $Event)

                    <!-- Membuat kartu event -->
                    <div
                        class="event-card bg-white rounded-xl shadow-sm border overflow-hidden flex flex-col justify-between"
                        data-category="{{ $Event->category ?? 'Event' }}"
                    >

                        <!-- Menampilkan informasi event -->
                        <div>

                            <!-- Mengecek apakah event memiliki gambar -->
                            @if($Event->image)

                                <!-- Menampilkan gambar event -->
                                <img
                                    src="{{ asset('images/' . $Event->image) }}"
                                    alt="{{ $Event->name }}"
                                    class="w-full h-40 object-cover"
                                >

                            <!-- Menampilkan placeholder jika tidak ada gambar -->
                            @else

                                <div class="bg-gray-200 h-40 flex items-center justify-center text-gray-400 font-medium">
                                    Tanpa Gambar
                                </div>

                            @endif

                            <!-- Menampilkan detail event -->
                            <div class="p-4">

                                <!-- Menampilkan kategori dan harga -->
                                <div class="flex justify-between items-center mb-2">

                                    <!-- Menampilkan kategori -->
                                    <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2.5 py-0.5 rounded">
                                        {{ $Event->category ?? 'Event' }}
                                    </span>

                                    <!-- Menampilkan harga -->
                                    <span class="font-bold text-green-600">
                                        Rp {{ number_format($Event->ticket_price) }}
                                    </span>
                                </div>

                                <!-- Menampilkan nama event -->
                                <h3 class="font-bold text-gray-800 text-lg item-name">
                                    {{ $Event->concert_name }}
                                </h3>

                                <!-- Menampilkan deskripsi event -->
                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                    {{ $Event->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Membuat input jumlah pesanan -->
                        <div class="p-4 bg-gray-50 border-t">

                            <!-- Menampilkan label jumlah -->
                            <label class="block text-xs font-semibold text-gray-500 mb-1">
                                Jumlah Ticket
                            </label>

                            <!-- Input jumlah event yang dipesan -->
                            <input
                                type="number"
                                name="items[{{ $Event->id }}]"
                                min="0"
                                value="0"
                                data-name="{{ $Event->concert_name }}"
                                data-price="{{ $Event->ticket_price }}"
                                class="item-qty w-full border rounded-lg px-3 py-1.5 text-center font-bold text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none"
                            >
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Membuat tombol untuk membuka konfirmasi pesanan -->
            <div class="mt-8 text-right">

                <!-- Membuka modal konfirmasi -->
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-xl shadow-md transition"
                >
                    Pesan Sekarang
                </button>
            </div>

            <!-- Membuat modal konfirmasi pesanan -->
            <div
                id="confirmModal"
                class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4"
            >

                <!-- Membuat kotak modal -->
                <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all">

                    <!-- Menampilkan judul konfirmasi -->
                    <h3 class="text-xl font-bold text-gray-800 border-b pb-3 mb-4">
                        Konfirmasi Pesanan
                    </h3>

                    <!-- Menampilkan informasi pesanan -->
                    <div class="space-y-2 text-sm text-gray-600 mb-4">

                        <!-- Menampilkan nama pelanggan -->
                        <div class="flex justify-between">
                            <span class="font-semibold">Nama:</span>
                            <span id="modalName" class="text-gray-900 font-bold"></span>
                        </div>

                        <!-- Menampilkan email pelanggan -->
                        <div class="flex justify-between">
                            <span class="font-semibold">Email:</span>
                            <span id="modalEmail" class="text-gray-900 font-bold"></span>
                        </div>
                    </div>

                    <!-- Menampilkan rincian event yang dipilih -->
                    <div class="border-t border-b py-3 mb-4 max-h-48 overflow-y-auto">

                        <!-- Judul rincian item -->
                        <p class="font-semibold text-xs text-gray-400 uppercase mb-2">
                            Rincian Item
                        </p>

                        <!-- Tempat menampilkan daftar item -->
                        <ul id="modalItemList" class="space-y-2 text-sm"></ul>
                    </div>

                    <!-- Menampilkan total pembayaran -->
                    <div class="flex justify-between items-center text-lg font-bold text-gray-800 mb-6">

                        <!-- Label total -->
                        <span>Total Pembayaran:</span>

                        <!-- Nilai total -->
                        <span id="modalTotalPrice" class="text-green-600 text-xl">
                            Rp 0
                        </span>
                    </div>

                    <!-- Membuat tombol pada modal -->
                    <div class="flex gap-3">

                        <!-- Tombol untuk menutup modal -->
                        <button
                            type="button"
                            onclick="closeConfirmationModal()"
                            class="w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2.5 rounded-xl transition"
                        >
                            Batal
                        </button>

                        <!-- Tombol untuk mengirim pesanan -->
                        <button
                            type="submit"
                            class="w-1/2 bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-xl shadow transition"
                        >
                            Ya, Kirim Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Menjalankan JavaScript untuk fitur halaman -->
    <script>
    function filterCategory(category, element) {
    document.querySelectorAll('.btn-category').forEach(btn => {
        btn.className =
            "btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-white text-gray-600 hover:bg-gray-200 border";
    });

    element.className =
        "btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-blue-600 text-white shadow-md";

    document.querySelectorAll('.event-card').forEach(card => {
        const cardCategory = (
            card.getAttribute('data-category') || ''
        ).trim().toLowerCase();

        const selectedCategory = category.trim().toLowerCase();

        if (
            selectedCategory === 'all' ||
            cardCategory === selectedCategory
        ) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

    function showConfirmationModal() {
        const name = document.getElementById('customer_name').value.trim();
        const email = document.getElementById('customer_email').value.trim();

        if (!name || !email) {
            alert('Please input name and email.');
            return;
        }

        const items = document.querySelectorAll('.item-qty');
        const itemList = document.getElementById('modalItemList');

        itemList.replaceChildren();

        let grandTotal = 0;
        let hasOrder = false;

        items.forEach(input => {
            const qty = Number(input.value);

            if (qty > 0) {
                hasOrder = true;

                const itemName = input.dataset.name;
                const price = Number(input.dataset.price);
                const subtotal = qty * price;

                grandTotal += subtotal;

                const li = document.createElement('li');
                li.className = 'flex justify-between items-center gap-3';

                const detail = document.createElement('div');

                const title = document.createElement('span');
                title.className = 'font-bold text-gray-800';
                title.textContent = itemName;

                const quantity = document.createElement('span');
                quantity.className = 'text-xs text-gray-500 block';
                quantity.textContent =
                    `x${qty} @ Rp ${price.toLocaleString('id-ID')}`;

                detail.append(title, quantity);

                const total = document.createElement('span');
                total.className = 'font-semibold text-gray-700';
                total.textContent =
                    `Rp ${subtotal.toLocaleString('id-ID')}`;

                li.append(detail, total);
                itemList.appendChild(li);
            }
        });

        if (!hasOrder) {
            alert('Please select at least one event ticket!');
            return;
        }

        document.getElementById('modalName').textContent = name;
        document.getElementById('modalEmail').textContent = email;

        document.getElementById('modalTotalPrice').textContent =
            'Rp ' + grandTotal.toLocaleString('id-ID');

        const modal = document.getElementById('confirmModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeConfirmationModal() {
        const modal = document.getElementById('confirmModal');

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
</body>
</html>