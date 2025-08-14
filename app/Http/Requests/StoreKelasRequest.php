<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Otorisasi sudah ditangani oleh middleware di route
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'tingkat' => 'required|integer|between:10,12',
            'nama_walikelas' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nama_kelas.required' => 'Nama kelas harus diisi.',
            'nama_kelas.unique' => 'Nama kelas sudah ada.',
            'tingkat.required' => 'Tingkat kelas harus diisi.',
            'tingkat.between' => 'Tingkat kelas harus antara 10-12.',
            'nama_walikelas.required' => 'Nama wali kelas harus diisi.',
        ];
    }
}
