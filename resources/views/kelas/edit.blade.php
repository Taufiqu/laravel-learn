<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('kelas.update', $kelas) }}">
                        @csrf
                        @method('PUT')

                        {{-- Nama Kelas --}}
                        <div class="mb-4">
                            <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kelas
                            </label>
                            <input type="text" 
                                   id="nama_kelas" 
                                   name="nama_kelas" 
                                   value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                                   placeholder="Contoh: X IPA 1, XI IPS 2, XII Bahasa 1"
                                   class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('nama_kelas') border-red-500 @else border-gray-300 @enderror">
                            @error('nama_kelas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tingkat --}}
                        <div class="mb-4">
                            <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-2">
                                Tingkat Kelas
                            </label>
                            <select id="tingkat" 
                                    name="tingkat" 
                                    class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tingkat') border-red-500 @else border-gray-300 @enderror">
                                <option value="">Pilih Tingkat</option>
                                <option value="10" {{ old('tingkat', $kelas->tingkat) == '10' ? 'selected' : '' }}>Kelas 10</option>
                                <option value="11" {{ old('tingkat', $kelas->tingkat) == '11' ? 'selected' : '' }}>Kelas 11</option>
                                <option value="12" {{ old('tingkat', $kelas->tingkat) == '12' ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                            @error('tingkat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama Wali Kelas --}}
                        <div class="mb-6">
                            <label for="nama_walikelas" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Wali Kelas
                            </label>
                            <input type="text" 
                                   id="nama_walikelas" 
                                   name="nama_walikelas" 
                                   value="{{ old('nama_walikelas', $kelas->nama_walikelas) }}"
                                   placeholder="Masukkan nama lengkap wali kelas"
                                   class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('nama_walikelas') border-red-500 @else border-gray-300 @enderror">
                            @error('nama_walikelas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('kelas.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Kelas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
