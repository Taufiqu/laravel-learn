<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('guru.update', $guru) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div class="space-y-4">
                                {{-- NIP --}}
                                <div>
                                    <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                                        NIP <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="nip" 
                                           name="nip" 
                                           value="{{ old('nip', $guru->nip) }}"
                                           placeholder="18 digit NIP"
                                           maxlength="18"
                                           class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('nip') border-red-500 @else border-gray-300 @enderror">
                                    @error('nip')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Nama --}}
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="nama" 
                                           name="nama" 
                                           value="{{ old('nama', $guru->nama) }}"
                                           placeholder="Nama lengkap guru"
                                           class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('nama') border-red-500 @else border-gray-300 @enderror">
                                    @error('nama')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Jenis Kelamin --}}
                                <div>
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <select id="jenis_kelamin" 
                                            name="jenis_kelamin" 
                                            class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('jenis_kelamin') border-red-500 @else border-gray-300 @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Tempat Lahir --}}
                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tempat Lahir
                                    </label>
                                    <input type="text" 
                                           id="tempat_lahir" 
                                           name="tempat_lahir" 
                                           value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
                                           placeholder="Tempat lahir"
                                           class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tempat_lahir') border-red-500 @else border-gray-300 @enderror">
                                    @error('tempat_lahir')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Tanggal Lahir --}}
                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Lahir
                                    </label>
                                    <input type="date" 
                                           id="tanggal_lahir" 
                                           name="tanggal_lahir" 
                                           value="{{ old('tanggal_lahir', $guru->tanggal_lahir?->format('Y-m-d')) }}"
                                           class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tanggal_lahir') border-red-500 @else border-gray-300 @enderror">
                                    @error('tanggal_lahir')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Alamat --}}
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                                        Alamat <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="alamat" 
                                              name="alamat" 
                                              rows="3"
                                              placeholder="Alamat lengkap"
                                              class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('alamat') border-red-500 @else border-gray-300 @enderror">{{ old('alamat', $guru->alamat) }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="space-y-4">
                                {{-- Foto Preview --}}
                                @if($guru->foto)
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                                        <img src="{{ Storage::url($guru->foto) }}" 
                                             alt="Foto {{ $guru->nama }}" 
                                             class="h-32 w-32 rounded-lg object-cover border">
                                    </div>
                                @endif

                                {{-- Telepon --}}
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                        Telepon
                                    </label>
                                    <input type="text" 
                                           id="telepon" 
                                           name="telepon" 
                                           value="{{ old('telepon', $guru->telepon) }}"
                                           placeholder="Nomor telepon"
                                           class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('telepon') border-red-500 @else border-gray-300 @enderror">
                                    @error('telepon')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $guru->email) }}"
                                           placeholder="alamat@email.com"
                                           class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('email') border-red-500 @else border-gray-300 @enderror">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status Kepegawaian --}}
                                <div>
                                    <label for="status_kepegawaian" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status Kepegawaian <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status_kepegawaian" 
                                            name="status_kepegawaian" 
                                            class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('status_kepegawaian') border-red-500 @else border-gray-300 @enderror">
                                        <option value="">Pilih Status</option>
                                        <option value="PNS" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                        <option value="GTT" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'GTT' ? 'selected' : '' }}>GTT</option>
                                        <option value="GTY" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'GTY' ? 'selected' : '' }}>GTY</option>
                                        <option value="Honorer" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                    </select>
                                    @error('status_kepegawaian')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Pendidikan Terakhir --}}
                                <div>
                                    <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pendidikan Terakhir
                                    </label>
                                    <select id="pendidikan_terakhir" 
                                            name="pendidikan_terakhir" 
                                            class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('pendidikan_terakhir') border-red-500 @else border-gray-300 @enderror">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="S1" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
                                        <option value="D3" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="D4" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D4' ? 'selected' : '' }}>D4</option>
                                    </select>
                                    @error('pendidikan_terakhir')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Mata Pelajaran --}}
                                <div>
                                    <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mata Pelajaran Utama
                                    </label>
                                    <input type="text" 
                                           id="mata_pelajaran" 
                                           name="mata_pelajaran" 
                                           value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}"
                                           placeholder="Contoh: Matematika"
                                           class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('mata_pelajaran') border-red-500 @else border-gray-300 @enderror">
                                    @error('mata_pelajaran')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Mata Pelajaran yang Diajar --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Mata Pelajaran yang Diajar
                                    </label>
                                    <div class="max-h-32 overflow-y-auto border rounded-md p-2">
                                        @foreach($mataPelajarans as $mapel)
                                            <label class="flex items-center mb-2">
                                                <input type="checkbox" 
                                                       name="mata_pelajaran_ids[]" 
                                                       value="{{ $mapel->id }}"
                                                       {{ in_array($mapel->id, old('mata_pelajaran_ids', $guru->mataPelajarans->pluck('id')->toArray())) ? 'checked' : '' }}
                                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                <span class="ml-2 text-sm">{{ $mapel->nama_mata_pelajaran }} ({{ $mapel->kode_mata_pelajaran }})</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('mata_pelajaran_ids')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Foto --}}
                                <div>
                                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                                        Foto {{ $guru->foto ? '(Ganti Foto)' : '' }}
                                    </label>
                                    <input type="file" 
                                           id="foto" 
                                           name="foto" 
                                           accept="image/*"
                                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    @error('foto')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500 mt-1">Maksimal 2MB, format: JPG, PNG, GIF</p>
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end space-x-4 mt-6">
                            <a href="{{ route('guru.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Guru
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
