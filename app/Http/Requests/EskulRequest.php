<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EskulRequest extends FormRequest
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
            'eskul' => 'required|min:3',
            'deskripsi' => 'nullable|min:3',
            'pendamping' => 'required|min:3',
            'hari' => 'required|min:3',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } elseif ($this->isMethod('put')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        return $rules;
    }
}
