<?php

declare(strict_types=1);

namespace App\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/** Validates email and password for the shared login form. */
class LoginRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /** Dutch validation messages shown in the form. */
    public function messages(): array
    {
        return [
            'email.required' => 'E-mailadres is verplicht',
            'email.email' => 'E-mailadres is ongeldig',
            'password.required' => 'Wachtwoord is verplicht',
        ];
    }
}
