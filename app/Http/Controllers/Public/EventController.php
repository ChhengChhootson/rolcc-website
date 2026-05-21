<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use App\Http\Requests\Public\EventRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function __construct(private EventService $eventService) {}

    public function index(Request $request)
    {
        $events = $this->eventService->getUpcomingEvents(9);
        $featuredEvents = $this->eventService->getFeaturedEvents(3);

        return view('public.events.index', compact('events', 'featuredEvents'));
    }

    public function show(string $slug)
    {
        $event = Event::published()
            ->with(['organizer'])
            ->where('slug', $slug)
            ->firstOrFail();

        $event->increment('views');

        $relatedEvents = Event::published()
            ->where('id', '!=', $event->id)
            ->upcoming()
            ->where('event_type', $event->event_type)
            ->limit(3)
            ->get();

        return view('public.events.show', compact('event', 'relatedEvents'));
    }

    public function register(EventRegistrationRequest $request, string $slug)
    {
        $event = Event::published()->where('slug', $slug)->firstOrFail();

        if ($event->isFull()) {
            return back()->with('error', 'Sorry, this event is fully booked.');
        }

        $registration = $this->eventService->registerForEvent($event, $request->validated());

        return redirect()->route('events.registration.success', $registration->ticket_number)
            ->with('success', 'Registration successful! Check your email for confirmation.');
    }

    public function registrationSuccess(string $ticketNumber)
    {
        $registration = \App\Models\EventRegistration::with('event')
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        return view('public.events.registration-success', compact('registration'));
    }

    public function calendar(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        $events = $this->eventService->getEventsByMonth($year, $month);

        return view('public.events.calendar', compact('events', 'year', 'month'));
    }

    public function calendarFeed(Request $request): JsonResponse
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $events = Event::published()
            ->whereBetween('start_date', [$start, $end])
            ->get()
            ->map(fn($e) => [
                'id' => $e->id,
                'title' => $e->title,
                'start' => $e->start_date->toIso8601String(),
                'end' => $e->end_date->toIso8601String(),
                'url' => route('events.show', $e->slug),
                'color' => '#145DA0',
                'backgroundColor' => '#145DA0',
            ]);

        return response()->json($events);
    }
}
