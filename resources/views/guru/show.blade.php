<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Guru') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('guru.edit', $guru) }}" 
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('guru.index') }}" 
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
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        {{-- Kolom Foto --}}
                        <div class="lg:col-span-1">
                            <div class="text-center">
                                @if($guru->foto)
                                    <img src="{{ Storage::url($guru->foto) }}" 
                                         alt="Foto {{ $guru->nama }}" 
                                         class="mx-auto h-48 w-48 rounded-full object-cover border-4 border-gray-200 shadow-lg">
                                @else
                                    <div class="mx-auto h-48 w-48 rounded-full bg-gray-200 border-4 border-gray-300 flex items-center justify-center">
                                        <svg class="h-20 w-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="mt-4">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $guru->nama }}</h3>
                                    <p class="text-sm text-gray-600">{{ $guru->mata_pelajaran ?? 'Guru' }}</p>
                                    <div class="mt-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($guru->status === 'aktif') bg-green-100 text-green-800 
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($guru->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Data --}}
                        <div class="lg:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Data Pribadi --}}
                                <div class="space-y-4">
                                    <h4 class="font-semibold text-lg text-gray-800 border-b pb-2">Data Pribadi</h4>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">NIP</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->nip ?? '-' }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->nama }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $guru->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $guru->tempat_lahir ?? '-' }}@if($guru->tempat_lahir && $guru->tanggal_lahir), @endif
                                            {{ $guru->tanggal_lahir ? $guru->tanggal_lahir->format('d F Y') : '' }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Umur</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $guru->tanggal_lahir ? $guru->tanggal_lahir->age . ' tahun' : '-' }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Alamat</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->alamat }}</p>
                                    </div>
                                </div>

                                {{-- Data Kontak & Kepegawaian --}}
                                <div class="space-y-4">
                                    <h4 class="font-semibold text-lg text-gray-800 border-b pb-2">Kontak & Kepegawaian</h4>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Telepon</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->telepon ?? '-' }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Email</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->email ?? '-' }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Status Kepegawaian</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->status_kepegawaian ?? '-' }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Pendidikan Terakhir</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->pendidikan_terakhir ?? '-' }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Mata Pelajaran Utama</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->mata_pelajaran ?? '-' }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Tanggal Bergabung</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $guru->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Mata Pelajaran yang Diajar --}}
                    @if($guru->mataPelajarans->isNotEmpty())
                        <div class="mt-8">
                            <h4 class="font-semibold text-lg text-gray-800 border-b pb-2 mb-4">Mata Pelajaran yang Diajar</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($guru->mataPelajarans as $mapel)
                                    <div class="bg-gray-50 rounded-lg p-4 border">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h5 class="font-medium text-gray-900">{{ $mapel->nama_mata_pelajaran }}</h5>
                                                <p class="text-sm text-gray-600">Kode: {{ $mapel->kode_mata_pelajaran }}</p>
                                                <p class="text-sm text-gray-600">SKS: {{ $mapel->sks ?? '-' }}</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    @if($mapel->status === 'aktif') bg-green-100 text-green-800 
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($mapel->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        @if($mapel->deskripsi)
                                            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($mapel->deskripsi, 80) }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-8">
                            <h4 class="font-semibold text-lg text-gray-800 border-b pb-2 mb-4">Mata Pelajaran yang Diajar</h4>
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">Belum ada mata pelajaran yang diajar</p>
                            </div>
                        </div>
                    @endif

                    {{-- Stats Cards --}}
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $guru->mataPelajarans->count() }}</div>
                            <div class="text-sm text-blue-600">Mata Pelajaran</div>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $guru->mataPelajarans->where('status', 'aktif')->count() }}</div>
                            <div class="text-sm text-green-600">Mapel Aktif</div>
                        </div>
                        
                        <div class="bg-purple-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-purple-600">{{ $guru->created_at->diffInYears() }}</div>
                            <div class="text-sm text-purple-600">Tahun Mengajar</div>
                        </div>
                        
                        <div class="bg-orange-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-orange-600">
                                {{ $guru->tanggal_lahir ? $guru->tanggal_lahir->age : '-' }}
                            </div>
                            <div class="text-sm text-orange-600">Usia (Tahun)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
