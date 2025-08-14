<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMataPelajaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_mata_pelajaran' => [
                'required',
                'string',
                'max:100',
                'unique:mata_pelajarans,nama_mata_pelajaran'
            ],
            'kode_mata_pelajaran' => [
                'required',
                'string',
                'max:10',
                'unique:mata_pelajarans,kode_mata_pelajaran'
            ],
            'deskripsi' => 'nullable|string|max:1000',
            'sks' => 'nullable|integer|min:1|max:6',
            'semester' => [
                'nullable',
                'integer',
                'min:1',
                'max:8'
            ],
            'jenis' => [
                'nullable',
                'string',
                Rule::in(['wajib', 'pilihan', 'lokal'])
            ],
            'kelompok' => [
                'nullable',
                'string',
                Rule::in(['A', 'B', 'C'])
            ],
            'status' => [
                'nullable',
                'string',
                Rule::in(['aktif', 'nonaktif'])
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama_mata_pelajaran.required' => 'Nama mata pelajaran wajib diisi.',
            'nama_mata_pelajaran.max' => 'Nama mata pelajaran maksimal 100 karakter.',
            'nama_mata_pelajaran.unique' => 'Nama mata pelajaran sudah digunakan.',
            
            'kode_mata_pelajaran.required' => 'Kode mata pelajaran wajib diisi.',
            'kode_mata_pelajaran.max' => 'Kode mata pelajaran maksimal 10 karakter.',
            'kode_mata_pelajaran.unique' => 'Kode mata pelajaran sudah digunakan.',
            
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
            
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS minimal 1.',
            'sks.max' => 'SKS maksimal 6.',
            
            'semester.integer' => 'Semester harus berupa angka.',
            'semester.min' => 'Semester minimal 1.',
            'semester.max' => 'Semester maksimal 8.',
            
            'jenis.in' => 'Jenis mata pelajaran harus wajib, pilihan, atau lokal.',
            'kelompok.in' => 'Kelompok mata pelajaran harus A, B, atau C.',
            'status.in' => 'Status harus aktif atau nonaktif.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama_mata_pelajaran' => 'nama mata pelajaran',
            'kode_mata_pelajaran' => 'kode mata pelajaran',
            'deskripsi' => 'deskripsi',
            'sks' => 'SKS',
            'semester' => 'semester',
            'jenis' => 'jenis',
            'kelompok' => 'kelompok',
            'status' => 'status'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Set default values
        if (!$this->has('status')) {
            $this->merge(['status' => 'aktif']);
        }
        
        // Convert kode to uppercase
        if ($this->has('kode_mata_pelajaran')) {
            $this->merge(['kode_mata_pelajaran' => strtoupper($this->kode_mata_pelajaran)]);
        }
    }
}
