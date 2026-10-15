
{{-- Menggunakan layout utama aplikasi --}}
<x-app-layout>

    {{-- Header halaman --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Pesanan Masuk') }}
            </h2>

            <div class="flex items-center gap-3">

                {{-- Tombol Kelola Event --}}
                <a
                    href="{{ route('events.index') }}"
                    style="background: blue; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;"
                >
                    Kelola Event
                </a>

                {{-- Tombol Event Customer --}}
                <a
                    href="{{ route('customer.index') }}"
                    style="background: black; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;"
                >
                    Event Customer
                </a>

            </div>
        </div>
    </x-slot>


    {{-- Area utama --}}
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan berhasil --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Tabel pesanan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">

                <div class="p-6 text-gray-900 overflow-x-auto">

                    <table class="w-full text-left border-collapse">

                        {{-- Header tabel --}}
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>

                                <th class="p-4 border-b">
                                    # ID
                                </th>

                                <th class="p-4 border-b">
                                    Pelanggan
                                </th>

                                <th class="p-4 border-b">
                                    Rincian Pesanan
                                </th>

                                <th class="p-4 border-b">
                                    Total Harga
                                </th>

                                <th class="p-4 border-b">
                                    Status
                                </th>

                                <th class="p-4 border-b text-center">
                                    Aksi Status
                                </th>

                            </tr>
                        </thead>


                        {{-- Isi tabel --}}
                        <tbody class="divide-y text-sm">

                            @forelse($orders as $order)

                                <tr class="hover:bg-gray-50">

                                    {{-- ID --}}
                                    <td class="p-4 font-bold text-gray-700">
                                        #{{ $order->id }}
                                    </td>


                                    {{-- Nama pelanggan --}}
                                    <td class="p-4 font-medium">
                                        {{ $order->customer_name }}
                                    </td>



                                    {{-- Rincian pesanan --}}
                                    <td class="p-4">

                                        <ul class="list-disc list-inside space-y-1 text-gray-600">

                                            @foreach($order->orderDetails as $detail)
                                                <li>

                                                    <strong>
                                                        {{ $detail->event->concert_name ?? 'Nama event tidak ditemukan' }}
                                                    </strong>

                                                    x{{ $detail->quantity }}

                                                    <span class="text-xs text-gray-400">
                                                        (Rp {{ number_format($detail->subtotal) }})
                                                    </span>

                                                </li>

                                            @endforeach

                                        </ul>

                                    </td>


                                    {{-- Total harga --}}
                                    <td class="p-4 font-bold text-green-600">
                                        Rp {{ number_format($order->total_price) }}
                                    </td>


                                    {{-- STATUS PESANAN --}}
<td class="p-4">
    @if (strtolower($order->status) === 'pending')
        <span style="background-color: #fef3c7; color: #92400e;"
              class="inline-block text-xs font-bold px-3 py-1 rounded-full">
            PENDING
        </span>
    @elseif (strtolower($order->status) === 'confirmed')
        <span style="background-color: #dcfce7; color: #166534;"
              class="inline-block text-xs font-bold px-3 py-1 rounded-full">
            CONFIRMED
        </span>
    @elseif (strtolower($order->status) === 'cancelled')
        <span style="background-color: #fee2e2; color: #991b1b;"
              class="inline-block text-xs font-bold px-3 py-1 rounded-full">
            CANCELLED
        </span>
    @else
        <span class="inline-block bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1 rounded-full">
            {{ strtoupper($order->status) }}
        </span>
    @endif
</td>



  {{-- AKSI STATUS --}}
                              
<td class="p-4 text-center">
    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
        @csrf  <!-- untuk melindungi dari serangan CSRF (Cross-Site Request Forgery) -->
        @method('PATCH')

    <select
        name="status"
        onchange="this.form.submit()"
        class="text-xs border border-gray-300 rounded p-1.5 bg-white shadow-sm font-semibold"
    >
        <option value="pending" {{ strtolower($order->status) === 'pending' ? 'selected' : '' }}>
            Pending
        </option>
        <option value="confirmed" {{ strtolower($order->status) === 'confirmed' ? 'selected' : '' }}>
            Confirmed
        </option>
        <option value="cancelled" {{ strtolower($order->status) === 'cancelled' ? 'selected' : '' }}>
            Cancelled
        </option>
    </select>
</form>

                            </td>


                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="p-6 text-center text-gray-500"
                                    >
                                        Belum ada pesanan masuk.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>