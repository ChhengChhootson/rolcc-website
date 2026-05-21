<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #0B4F8C; padding: 20px; border-radius: 8px 8px 0 0; text-align: center;">
        <h2 style="color: #D4A017; margin: 0;">New Contact Message</h2>
        <p style="color: #fff; margin: 5px 0; font-size: 14px;">ROLCC Cambodia Website</p>
    </div>
    <div style="padding: 25px; background: #f9f9f9; border: 1px solid #e5e7eb; border-top: none;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr><td style="padding: 8px 0; font-weight: bold; color: #374151; width: 100px;">Name:</td><td style="padding: 8px 0; color: #6b7280;">{{ $message->name }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold; color: #374151;">Email:</td><td style="padding: 8px 0; color: #6b7280;">{{ $message->email }}</td></tr>
            @if($message->phone)
            <tr><td style="padding: 8px 0; font-weight: bold; color: #374151;">Phone:</td><td style="padding: 8px 0; color: #6b7280;">{{ $message->phone }}</td></tr>
            @endif
            <tr><td style="padding: 8px 0; font-weight: bold; color: #374151;">Subject:</td><td style="padding: 8px 0; color: #6b7280;">{{ $message->subject }}</td></tr>
        </table>
        <div style="margin-top: 15px; padding: 15px; background: white; border-radius: 6px; border: 1px solid #e5e7eb;">
            <p style="margin: 0; color: #374151; white-space: pre-wrap;">{{ $message->message }}</p>
        </div>
    </div>
    <div style="padding: 15px; text-align: center; font-size: 12px; color: #9ca3af;">
        Received on {{ now()->format('F j, Y \a\t g:i A') }}
    </div>
</body>
</html>
