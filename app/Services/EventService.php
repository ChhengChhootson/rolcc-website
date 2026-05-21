<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Mail\EventRegistrationConfirmation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class EventService
{
    public function getUpcomingEvents(int $perPage = 9): LengthAwarePaginator
    {
        return Event::published()
            ->upcoming()
            ->with(['organizer'])
            ->paginate($perPage);
    }

    public function getFeaturedEvents(int $limit = 3): Collection
    {
        return Cache::remember('featured_events', 1800, function () use ($limit) {
            return Event::published()->featured()->upcoming()
                ->limit($limit)
                ->get();
        });
    }

    public function getEventsByMonth(int $year, int $month): Collection
    {
        return Event::published()
            ->whereYear('start_date', $year)
            ->whereMonth('start_date', $month)
            ->orderBy('start_date')
            ->get();
    }

    public function registerForEvent(Event $event, array $data): EventRegistration
    {
        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'attendees_count' => $data['attendees_count'] ?? 1,
            'notes' => $data['notes'] ?? null,
            'status' => $event->isFree() ? 'confirmed' : 'pending',
            'payment_status' => $event->isFree() ? 'free' : 'pending',
        ]);

        if ($registration->status === 'confirmed') {
            $registration->confirmed_at = now();
            $registration->save();

            Mail::to($registration->email)
                ->queue(new EventRegistrationConfirmation($registration));
        }

        Cache::forget('featured_events');

        return $registration;
    }

    public function checkIn(EventRegistration $registration): void
    {
        $registration->checkIn();
    }

    public function getEventStats(Event $event): array
    {
        return [
            'total_registered' => $event->registrations()->count(),
            'confirmed' => $event->registrations()->where('status', 'confirmed')->count(),
            'attended' => $event->registrations()->where('status', 'attended')->count(),
            'pending' => $event->registrations()->where('status', 'pending')->count(),
            'cancelled' => $event->registrations()->where('status', 'cancelled')->count(),
            'total_attendees' => $event->registrations()->where('status', 'attended')->sum('attendees_count'),
            'available_spots' => $event->available_spots,
        ];
    }
}
