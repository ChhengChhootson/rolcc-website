<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class PrayerRequestFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'request' => 'required|string|min:10|max:2000',
            'category' => 'nullable|string|max:100',
            'is_anonymous' => 'boolean',
            'is_private' => 'boolean',
        ];
    }
}
