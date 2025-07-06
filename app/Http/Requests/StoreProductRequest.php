<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreProductRequest extends FormRequest
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
            'title' => 'required|string',
            'price' => 'required|decimal:2,4',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|string',
            'rate' => 'required|decimal:2,4',
            'count' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Titulo do produto não informado!',
            'title.string' => 'Titulo deve conter somente letras!',

            'description.required' => 'Descrição do produto não informado!',

            'category.required' => 'Categoria do produto não informado!',
            'category.string' => 'Categoria deve conter somente letras!',

            'image.required' => 'Imagem do produto não informado!',

            'rate.required' => 'Nome do produto não informado!',
            'rate.decimal' => 'Nome deve conter somente números!',

            'count.required' => 'Contagem do produto não informado!',
            'count.integer' => 'Contagem deve conter somente números!',
        ];
    }
}
//name, image, with_image (bool) e id
