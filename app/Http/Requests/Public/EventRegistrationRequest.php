<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class EventRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'guests' => 'nullable|integer|min:0|max:10',
            'notes' => 'nullable|string|max:500',
        ];
    }
}
