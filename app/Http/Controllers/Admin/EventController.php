<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Services\EventService;
use App\Services\MediaService;
use App\Http\Requests\Admin\EventRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    public function __construct(
        private EventService $eventService,
        private MediaService $mediaService,
    ) {}

    public function index(Request $request)
    {
        $events = Event::with('organizer')
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->type, fn($q) => $q->where('event_type', $request->type))
            ->orderByDesc('start_date')
            ->paginate(20);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $data['organizer_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $paths = $this->mediaService->uploadImage($request->file('featured_image'), 'events', true, ['thumb' => [400, 250]]);
            $data['featured_image'] = $paths['original'];
        }

        $event = Event::create($data);

        activity()->performedOn($event)->log('Created event: ' . $event->title);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $this->mediaService->deleteFile($event->featured_image);
            $paths = $this->mediaService->uploadImage($request->file('featured_image'), 'events', true, ['thumb' => [400, 250]]);
            $data['featured_image'] = $paths['original'];
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }

    public function registrations(Event $event, Request $request)
    {
        $registrations = $event->registrations()
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->search, fn($q) => $q->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            }))
            ->orderByDesc('created_at')
            ->paginate(20);

        $stats = $this->eventService->getEventStats($event);

        return view('admin.events.registrations', compact('event', 'registrations', 'stats'));
    }

    public function checkIn(Event $event, EventRegistration $registration)
    {
        $this->eventService->checkIn($registration);
        return back()->with('success', "{$registration->full_name} checked in successfully.");
    }

    public function exportRegistrations(Event $event)
    {
        $registrations = $event->registrations()->get();
        $pdf = Pdf::loadView('admin.events.registrations-pdf', compact('event', 'registrations'));
        return $pdf->download("{$event->slug}-registrations.pdf");
    }
}
