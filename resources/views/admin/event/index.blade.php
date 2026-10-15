<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Master Data Event
            </h2>

            <div class="flex items-center gap-3">
                <a
                    href="{{ route('events.create') }}"
                    style="background: black; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;"
                >
                    + Tambah Event 
                </a>
                <a
                    href="{{ route('customer.index') }}"
                    target="_blank"
                    style="background: black; color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;"
                >
                    Lihat Menu Customer
                </a>

            </div>
        </div>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>

        @endif

        <table class="w-full bg-white border mt-4 shadow-sm rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-600 text-sm">
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Aksi</th>

                </tr>
            </thead>

            <tbody>

                @foreach($Events as $event)

                    <tr class="border-b text-center text-sm">

                        <td class="p-3">

                            @if($event->image)
                                <img
                                    src="{{ asset('images/' . $event->image) }}"
                                    class="w-16 h-16 object-cover mx-auto rounded"
                                >
                            @else

                                <span class="text-gray-400 text-xs">
                                    No Image
                                </span>
                            @endif

                        </td>

                       
                        <td class="p-3 font-semibold">
                            {{ $event->concert_name }}
                        </td>

                        
                        <td class="p-3">
                            {{ $event->category }}
                        </td>

                       
                        <td class="p-3 font-bold text-green-600">
                            Rp {{ number_format($event->ticket_price) }}
                        </td>

                        
                        <td class="p-3">

                            
                            <a
                                href="{{ route('events.edit', $event->id) }}"
                                class="text-blue-600 hover:underline mr-3 font-semibold"
                            >
                                Edit
                            </a>

                            
                            <form
                                action="{{ route('events.destroy', $event->id) }}"
                                method="POST"
                                class="inline"
                            >

                                
                                @csrf

                                
                                @method('DELETE')

                               
                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="text-red-600 hover:underline font-semibold"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="mt-4">
            {{ $Events->links() }}

        </div>

    </div>
</x-app-layout>
```