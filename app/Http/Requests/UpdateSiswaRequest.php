<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Ambil ID siswa dari parameter route
        $siswaId = $this->route('siswa')->id;

        return [
            'nis' => 'required|integer|unique:siswas,nis,' . $siswaId,
            'nama' => 'required|string|max:255',
            'alamat' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.max' => 'Ukuran file tidak boleh lebih dari 2MB!',
        ];
    }
}