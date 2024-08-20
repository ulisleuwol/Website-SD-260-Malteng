<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
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
        $rules = [
            'nama' => 'required|min:3|max:255|string',
            'deskripsi' => 'nullable|required',
            'keterangan' => 'nullable|min:3',
        ];

        if ($this->isMethod('put')) {
            $rules['image'] = 'nullable|image|file|max:2048';
        } elseif ($this->isMethod('post')) {
            $rules['image'] = 'required|image|file|max:2048';
        }

        return $rules;
    }
}
