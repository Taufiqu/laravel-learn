<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mata Pelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('mata-pelajaran.update', $mataPelajaran) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div class="space-y-4">
                                {{-- Nama Mata Pelajaran --}}
                                <div>
                                    <label for="nama_mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Mata Pelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="nama_mata_pelajaran" 
                                           name="nama_mata_pelajaran" 
                                           value="{{ old('nama_mata_pelajaran', $mataPelajaran->nama_mata_pelajaran) }}"
                                           placeholder="Contoh: Matematika"
                                           class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('nama_mata_pelajaran')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Kode Mata Pelajaran --}}
                                <div>
                                    <label for="kode_mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kode Mata Pelajaran <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="kode_mata_pelajaran" 
                                           name="kode_mata_pelajaran" 
                                           value="{{ old('kode_mata_pelajaran', $mataPelajaran->kode_mata_pelajaran) }}"
                                           placeholder="Contoh: MAT101"
                                           maxlength="10"
                                           style="text-transform: uppercase;"
                                           class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('kode_mata_pelajaran')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500 mt-1">Maksimal 10 karakter, otomatis diubah ke huruf besar</p>
                                </div>

                                {{-- SKS --}}
                                <div>
                                    <label for="sks" class="block text-sm font-medium text-gray-700 mb-2">
                                        SKS (Satuan Kredit Semester)
                                    </label>
                                    <select id="sks" 
                                            name="sks" 
                                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Pilih SKS</option>
                                        @for($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}" {{ old('sks', $mataPelajaran->sks) == $i ? 'selected' : '' }}>{{ $i }} SKS</option>
                                        @endfor
                                    </select>
                                    @error('sks')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Semester --}}
                                <div>
                                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                                        Semester
                                    </label>
                                    <select id="semester" 
                                            name="semester" 
                                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Pilih Semester</option>
                                        @for($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}" {{ old('semester', $mataPelajaran->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('semester')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="space-y-4">
                                {{-- Jenis --}}
                                <div>
                                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Mata Pelajaran
                                    </label>
                                    <select id="jenis" 
                                            name="jenis" 
                                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Pilih Jenis</option>
                                        <option value="wajib" {{ old('jenis', $mataPelajaran->jenis) == 'wajib' ? 'selected' : '' }}>Wajib</option>
                                        <option value="pilihan" {{ old('jenis', $mataPelajaran->jenis) == 'pilihan' ? 'selected' : '' }}>Pilihan</option>
                                        <option value="lokal" {{ old('jenis', $mataPelajaran->jenis) == 'lokal' ? 'selected' : '' }}>Lokal</option>
                                    </select>
                                    @error('jenis')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Kelompok --}}
                                <div>
                                    <label for="kelompok" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kelompok
                                    </label>
                                    <select id="kelompok" 
                                            name="kelompok" 
                                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Pilih Kelompok</option>
                                        <option value="A" {{ old('kelompok', $mataPelajaran->kelompok) == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('kelompok', $mataPelajaran->kelompok) == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ old('kelompok', $mataPelajaran->kelompok) == 'C' ? 'selected' : '' }}>C</option>
                                    </select>
                                    @error('kelompok')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status
                                    </label>
                                    <select id="status" 
                                            name="status" 
                                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="aktif" {{ old('status', $mataPelajaran->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $mataPelajaran->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Info Card --}}
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-blue-900 mb-2">Informasi</h4>
                                    <div class="text-sm text-blue-700 space-y-1">
                                        <p><span class="font-medium">Dibuat:</span> {{ $mataPelajaran->created_at->format('d F Y H:i') }}</p>
                                        <p><span class="font-medium">Diubah:</span> {{ $mataPelajaran->updated_at->format('d F Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi (Full width) --}}
                        <div class="mt-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4"
                                      placeholder="Deskripsi mata pelajaran (opsional)"
                                      class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('deskripsi', $mataPelajaran->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Maksimal 1000 karakter</p>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end space-x-4 mt-6">
                            <a href="{{ route('mata-pelajaran.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for uppercase kode --}}
    <script>
        document.getElementById('kode_mata_pelajaran').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>
</x-app-layout>
