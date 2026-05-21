<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'event_type' => 'required|in:general,conference,youth,worship,outreach,prayer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'is_online' => 'boolean',
            'online_link' => 'nullable|url|required_if:is_online,true',
            'requires_registration' => 'boolean',
            'max_attendees' => 'nullable|integer|min:1',
            'ticket_price' => 'nullable|numeric|min:0',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published,cancelled',
            'is_featured' => 'boolean',
            'tags' => 'nullable|array',
            'published_at' => 'nullable|date',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_online' => $this->boolean('is_online'),
            'requires_registration' => $this->boolean('requires_registration'),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }
}
