<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @method array only(string[] $keys)
 * @property string $email
 * @property string $password
 */
class LoginUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'exists:users,email'],
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
            'email.required' => "L'email est obligatoire",
            'email.email' => "L'email doit être valide",
            'email.exists' => "Cet email n'existe pas",
            'password.required' => "Le mot de passe est obligatoire",
            'password.min' => "Le mot de passe doit contenir au moins 5 caractères",
        ];
    }
}
