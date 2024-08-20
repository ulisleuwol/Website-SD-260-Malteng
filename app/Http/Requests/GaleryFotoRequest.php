<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GaleryFotoRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|array';
            $rules['image.*'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } elseif ($this->isMethod('put')) {
            $rules['image'] = 'nullable|array';
            $rules['image.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        return $rules;
    }
}
