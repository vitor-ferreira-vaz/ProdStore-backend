<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'category' => 'required|integer',
            'with_image' => 'required',
            'id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do produto não informado!',
            'name.string' => 'O nome pode conter somente texto!',
            'category.required' => 'Catergoria não informada!',
        ];
    }
}
//name, category, with_image (bool) e id
