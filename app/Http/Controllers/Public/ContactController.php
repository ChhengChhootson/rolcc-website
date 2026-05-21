<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Http\Requests\Public\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request)
    {
        $message = ContactMessage::create(array_merge(
            $request->validated(),
            ['ip_address' => $request->ip()]
        ));

        Mail::to(config('church.email'))
            ->queue(new ContactFormMail($message));

        return back()->with('success', 'Your message has been sent. We\'ll get back to you soon!');
    }
}
