<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|min:8',
            'email' => 'required|unique:App\Models\User,email|email',
            'password' => ['required', 'confirmed:password_confirmation', Password::min(8)],
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome não informado!',
            'name.string' => 'Nome deve conter somente letras!',
            'name.min' => 'Nome deve conter no mínimo 8 caracteres!',

            'email.required' => 'E-mail não informado!',
            'email.unique' => 'E-mail já cadastrado!',

            'password.required' => 'Senha não informada!',
            'password.confirmed' => 'As senhas não coincidem!',
            'password_confirmation.confirmed' => 'Confirmação de senha não informada!',
        ];
    }
}
//name, category, with_image (bool) e id
