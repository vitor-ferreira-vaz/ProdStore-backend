<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
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
            'password' => ['required', 'confirmed:password_confirmation', Password::min(8)],
            'password_confirmation' => 'required',
            'token' => 'required|exists:password_resets',

        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Senha não informada!',
            'password.confirmed' => 'As senhas não coincidem!',
            'token.required' => 'Token de autenticação do processo não encontrado redefinição de senha não autorizada!',
            'token.exists' => 'Token de autenticação incorreto!',
        ];
    }
}
//name, category, with_image (bool) e id
