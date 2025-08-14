<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Mata Pelajaran') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('mata-pelajaran.edit', $mataPelajaran) }}" 
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('mata-pelajaran.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Header Card --}}
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-6 text-white mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold mb-2">{{ $mataPelajaran->nama_mata_pelajaran }}</h1>
                                <div class="flex items-center space-x-4">
                                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $mataPelajaran->kode_mata_pelajaran }}
                                    </span>
                                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ ucfirst($mataPelajaran->status) }}
                                    </span>
                                    @if($mataPelajaran->jenis)
                                        <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ ucfirst($mataPelajaran->jenis) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                @if($mataPelajaran->sks)
                                    <div class="text-4xl font-bold">{{ $mataPelajaran->sks }}</div>
                                    <div class="text-sm opacity-80">SKS</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        {{-- Detail Information --}}
                        <div class="lg:col-span-2 space-y-6">
                            {{-- Basic Info --}}
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Mata Pelajaran</label>
                                        <p class="text-gray-900">{{ $mataPelajaran->nama_mata_pelajaran }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Kode</label>
                                        <p class="text-gray-900 font-mono">{{ $mataPelajaran->kode_mata_pelajaran }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">SKS</label>
                                        <p class="text-gray-900">{{ $mataPelajaran->sks ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Semester</label>
                                        <p class="text-gray-900">{{ $mataPelajaran->semester ? 'Semester ' . $mataPelajaran->semester : '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Jenis</label>
                                        <p class="text-gray-900">{{ $mataPelajaran->jenis ? ucfirst($mataPelajaran->jenis) : '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Kelompok</label>
                                        <p class="text-gray-900">{{ $mataPelajaran->kelompok ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            @if($mataPelajaran->deskripsi)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Deskripsi</h3>
                                    <div class="prose prose-sm text-gray-700">
                                        {{ $mataPelajaran->deskripsi }}
                                    </div>
                                </div>
                            @endif

                            {{-- Guru yang Mengajar --}}
                            @if($mataPelajaran->gurus->isNotEmpty())
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Guru yang Mengajar</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($mataPelajaran->gurus as $guru)
                                            <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                                                <div class="flex items-center space-x-3">
                                                    @if($guru->foto)
                                                        <img src="{{ Storage::url($guru->foto) }}" 
                                                             alt="{{ $guru->nama }}" 
                                                             class="h-12 w-12 rounded-full object-cover">
                                                    @else
                                                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                                            <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h4 class="font-medium text-gray-900">{{ $guru->nama }}</h4>
                                                        <p class="text-sm text-gray-600">{{ $guru->nip ?? 'Belum ada NIP' }}</p>
                                                        <p class="text-xs text-gray-500">{{ $guru->status_kepegawaian ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Sidebar Stats --}}
                        <div class="lg:col-span-1 space-y-6">
                            {{-- Status Card --}}
                            <div class="bg-white border rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Status</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-500">Status Aktif</span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $mataPelajaran->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($mataPelajaran->status) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-500">Jumlah Guru</span>
                                        <span class="text-2xl font-bold text-blue-600">{{ $mataPelajaran->gurus->count() }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Quick Actions --}}
                            <div class="bg-white border rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                                <div class="space-y-2">
                                    <a href="{{ route('mata-pelajaran.edit', $mataPelajaran) }}" 
                                       class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-md text-center block">
                                        Edit Data
                                    </a>
                                    
                                    <form method="POST" action="{{ route('mata-pelajaran.toggle-status', $mataPelajaran) }}" class="w-full">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="w-full {{ $mataPelajaran->status === 'aktif' ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white font-medium py-2 px-4 rounded-md"
                                                onclick="return confirm('Apakah Anda yakin ingin mengubah status mata pelajaran ini?')">
                                            {{ $mataPelajaran->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('mata-pelajaran.destroy', $mataPelajaran) }}" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran {{ $mataPelajaran->nama_mata_pelajaran }}? Data ini tidak dapat dikembalikan!')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Meta Info --}}
                            <div class="bg-white border rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Meta</h3>
                                <div class="space-y-3 text-sm">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Dibuat</label>
                                        <p class="text-gray-900">{{ $mataPelajaran->created_at->format('d F Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $mataPelajaran->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Terakhir Diubah</label>
                                        <p class="text-gray-900">{{ $mataPelajaran->updated_at->format('d F Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $mataPelajaran->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
