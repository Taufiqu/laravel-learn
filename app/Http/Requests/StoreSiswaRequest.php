<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Ubah menjadi true karena otorisasi sudah ditangani oleh middleware di route
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Pindahkan aturan validasi dari SiswaController@store ke sini
        return [
            'nis' => 'required|integer|unique:siswas,nis',
            'nama' => 'required|string|max:255',
            'alamat' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get the custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        // Pindahkan juga pesan kustomnya ke sini
        return [
            'foto.max' => 'Ukuran file tidak boleh lebih dari 2MB!',
        ];
    }
}