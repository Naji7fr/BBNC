<?php

declare(strict_types=1);

namespace App\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/** Validates required fields when creating a new lesson. */
class StoreLessonRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'lesson_type_id' => ['required', 'exists:lesson_types,id'],
            'instructor_id' => ['required', 'exists:instructors,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'max_participants' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /** Dutch validation messages shown in the form. */
    public function messages(): array
    {
        return [
            'date.required' => 'Datum is verplicht',
            'date.date' => 'Datum is ongeldig',
            'time.required' => 'Tijd is verplicht',
            'time.date_format' => 'Tijd is ongeldig',
            'lesson_type_id.required' => 'Les type is verplicht',
            'lesson_type_id.exists' => 'Les type is ongeldig',
            'instructor_id.required' => 'Instructeur is verplicht',
            'instructor_id.exists' => 'Instructeur is ongeldig',
            'location_id.required' => 'Locatie is verplicht',
            'location_id.exists' => 'Locatie is ongeldig',
            'max_participants.required' => 'Max. deelnemers is verplicht',
            'max_participants.min' => 'Max. deelnemers moet groter zijn dan 0',
        ];
    }
}
