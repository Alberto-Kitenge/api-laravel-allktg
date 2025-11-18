<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'min:5'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => "Erreur de validation",
            'errors_list' => $validator->errors(),
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => "Le nom est obligatoire",
            'email.required' => "L'email est obligatoire",
            'password.required' => "Le mot de passe est obligatoire",
            'password.min' => "Le mot de passe doit contenir au moins 5 caractères",
            'email.email' => "L'email doit être valide",
            'email.unique' => "L'email est déjà utilisé",
        ];
    }
}
