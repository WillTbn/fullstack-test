<?php

namespace App\Http\Requests\Local;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLocalRequest extends FormRequest
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
            'id'    => 'required|integer|exists:locals,id',
            'name' => [
                'required','string',
                Rule::unique('locals')->ignore($this->id, 'id')
            ],
            'zip_code' => [
                'required','max:10','string',
                // 'unique:locals,zip_code',
                Rule::unique('locals')->ignore($this->id, 'id')
            ],
            'street' => 'required|min:3|string',
            'city' => 'required|min:3|string',
            'number'=> 'required|min:1|integer'
        ];
    }
    public function messages():array
    {
        return [
            'required' => 'O :attribute é obrigatório!',
            'string' => 'Campo :attribute só aceitar texto.',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'unique' => 'O campo :attribute já esta cadastrado em nosso sistema.',
            'exists'=>'O :attribute não reconhecido em nosso sistema!'
        ];
    }
}
