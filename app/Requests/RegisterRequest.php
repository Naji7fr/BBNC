<?php

declare(strict_types=1);

namespace App\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/** Validates student self-registration (role is always student). */
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    /** Dutch validation messages shown in the form. */
    public function messages(): array
    {
        return [
            'name.required' => 'Naam is verplicht',
            'email.required' => 'E-mailadres is verplicht',
            'email.email' => 'E-mailadres is ongeldig',
            'email.unique' => 'Dit e-mailadres is al geregistreerd',
            'password.required' => 'Wachtwoord is verplicht',
            'password.confirmed' => 'Wachtwoorden komen niet overeen',
        ];
    }
}
