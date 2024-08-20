<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SejarahRequest extends FormRequest
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
            'title' => 'required|min:3',
            'deskripsi' => 'required|min:3',
        ];

        if ($this->isMethod('put')) {
            $rules['image'] = 'nullable|image|file|max:2048';
        } elseif ($this->isMethod('post')) {
            $rules['image'] = 'required|image|file|max:2048';
        }
        return $rules;
    }
}
