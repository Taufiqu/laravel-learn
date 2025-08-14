<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
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
            'nip' => 'required|string|unique:gurus,nip|size:18', // NIP 18 digit
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:gurus,email',
            'status_kepegawaian' => 'required|in:PNS,GTT,GTY,Honorer',
            'mata_pelajaran' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date|before:today',
            'tempat_lahir' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mata_pelajaran_ids' => 'nullable|array',
            'mata_pelajaran_ids.*' => 'exists:mata_pelajarans,id',
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
            'nip.required' => 'NIP harus diisi.',
            'nip.unique' => 'NIP sudah digunakan oleh guru lain.',
            'nip.size' => 'NIP harus 18 digit.',
            'nama.required' => 'Nama guru harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'alamat.required' => 'Alamat harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh guru lain.',
            'status_kepegawaian.required' => 'Status kepegawaian harus dipilih.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
