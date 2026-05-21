<?php

namespace App\Jobs;

use App\Models\Newsletter;
use App\Models\NewsletterCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 300;

    public function __construct(public NewsletterCampaign $campaign) {}

    public function handle(): void
    {
        $subscribers = Newsletter::where('is_subscribed', true)->get();

        $this->campaign->update(['status' => 'sending']);

        $count = 0;
        foreach ($subscribers as $subscriber) {
            Mail::send([], [], function ($message) use ($subscriber) {
                $message->to($subscriber->email, $subscriber->name)
                    ->subject($this->campaign->subject)
                    ->html($this->buildEmail($subscriber));
            });
            $count++;
        }

        $this->campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
            'recipients_count' => $count,
        ]);
    }

    private function buildEmail(Newsletter $subscriber): string
    {
        $unsubscribeUrl = url('/newsletter/unsubscribe/' . $subscriber->token);
        $content = nl2br(e($this->campaign->content));

        return <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #0B4F8C; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: #D4A017; margin: 0;">ROLCC Cambodia</h1>
        <p style="color: #ffffff; margin: 5px 0;">River of Life Christian Church</p>
    </div>
    <div style="padding: 30px; background: #f9f9f9; border: 1px solid #e5e7eb;">
        {$content}
    </div>
    <div style="padding: 15px; text-align: center; font-size: 12px; color: #6b7280;">
        <p>You're receiving this because you subscribed to ROLCC Cambodia updates.</p>
        <p><a href="{$unsubscribeUrl}" style="color: #6b7280;">Unsubscribe</a></p>
    </div>
</body>
</html>
HTML;
    }
}
