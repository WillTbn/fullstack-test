<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirm' =>'required|same:password',
            'role_id' => 'required|string|exists:roles,id',

        ];
    }
    public function messages():array
    {
        return [
            'required' => 'O :attribute é obrigatório!',
            'string' => 'Campo :attribute só aceitar texto.',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'email' => 'O campo de e-mail deve ser um endereço de e-mail válido.',
            'unique' => 'O campo :attribute já esta cadastrado em nosso sistema.',
            'password_confirm.same' => "O campo de confirmação de senha deve corresponder à senha.",
            'exists'=>'O :attribute não reconhecido em nosso sistema!'
        ];
    }
}
