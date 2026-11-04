<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Hasil route model binding: {course} sudah berupa objek Course.
        $course = $this->route('course');

        return [
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('courses', 'code')->ignore($course),
            ],
            'name'        => ['required', 'string', 'min:3', 'max:120'],
            'description' => ['nullable', 'string', 'max:2000'],
            'fee'         => ['required', 'integer', 'min:0'],
            'quota'       => ['required', 'integer', 'between:1,500'],
            'start_date'  => ['required', 'date'],
            'status'      => ['required', 'in:draft,open,closed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'code'        => 'kode kursus',
            'name'        => 'nama kursus',
            'description' => 'deskripsi',
            'fee'         => 'biaya',
            'quota'       => 'kuota',
            'start_date'  => 'tanggal mulai',
            'status'      => 'status',
        ];
    }

    public function messages(): array
    {
        return [
            'required'         => ':Attribute wajib diisi.',
            'string'           => ':Attribute harus berupa teks.',
            'integer'          => ':Attribute harus berupa angka bulat.',
            'code.unique'      => 'Kode kursus sudah dipakai kursus lain.',
            'code.max'         => 'Kode kursus maksimal :max karakter.',
            'name.min'         => 'Nama kursus minimal :min karakter.',
            'name.max'         => 'Nama kursus maksimal :max karakter.',
            'description.max'  => 'Deskripsi maksimal :max karakter.',
            'fee.min'          => 'Biaya tidak boleh negatif.',
            'quota.between'    => 'Kuota harus antara :min sampai :max peserta.',
            'start_date.date'  => 'Tanggal mulai bukan tanggal yang valid.',
            'status.in'        => 'Status hanya boleh draft, open, atau closed.',
        ];
    }
}