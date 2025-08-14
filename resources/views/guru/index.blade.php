<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Guru') }}
            </h2>
            <a href="{{ route('guru.create') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Guru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Flash Messages --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Search and Filter Form --}}
                    <div class="mb-4">
                        <form method="GET" action="{{ route('guru.index') }}">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="Cari nama, NIP, atau mata pelajaran..." 
                                       class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                
                                <select name="status" 
                                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Semua Status</option>
                                    <option value="PNS" {{ request('status') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="GTT" {{ request('status') == 'GTT' ? 'selected' : '' }}>GTT</option>
                                    <option value="GTY" {{ request('status') == 'GTY' ? 'selected' : '' }}>GTY</option>
                                    <option value="Honorer" {{ request('status') == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                </select>

                                <div class="flex gap-2">
                                    <button type="submit" 
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Cari
                                    </button>
                                    @if(request('search') || request('status'))
                                        <a href="{{ route('guru.index') }}" 
                                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Foto
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NIP
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mata Pelajaran
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kontak
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($guru as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($item->foto)
                                                <img src="{{ Storage::url($item->foto) }}" 
                                                     alt="Foto {{ $item->nama }}" 
                                                     class="h-12 w-12 rounded-full object-cover">
                                            @else
                                                <div class="h-12 w-12 bg-gray-200 rounded-full flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs">No Photo</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->nip }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                            <div class="text-sm text-gray-500">
                                                {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($item->status_kepegawaian == 'PNS') bg-green-100 text-green-800
                                                @elseif($item->status_kepegawaian == 'GTT') bg-blue-100 text-blue-800
                                                @elseif($item->status_kepegawaian == 'GTY') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $item->status_kepegawaian_label }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if($item->mataPelajarans->count() > 0)
                                                @foreach($item->mataPelajarans->take(2) as $mapel)
                                                    <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                                                        {{ $mapel->nama_mata_pelajaran }}
                                                    </span>
                                                @endforeach
                                                @if($item->mataPelajarans->count() > 2)
                                                    <span class="text-xs text-gray-500">+{{ $item->mataPelajarans->count() - 2 }} lagi</span>
                                                @endif
                                            @else
                                                <span class="text-gray-400 text-xs">Belum ada mata pelajaran</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div>{{ $item->telepon ?: '-' }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->email ?: '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('guru.show', $item) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('guru.edit', $item) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900">
                                                    Edit
                                                </a>
                                                <form action="{{ route('guru.destroy', $item) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus guru {{ $item->nama }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            @if(request('search') || request('status'))
                                                Tidak ada guru yang ditemukan dengan kriteria pencarian.
                                            @else
                                                Belum ada data guru.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $guru->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
