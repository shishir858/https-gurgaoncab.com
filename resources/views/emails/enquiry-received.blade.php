@php
    use App\Models\Setting;
    $settings = Cache::remember('site_settings', 3600, function() {
        return Setting::pluck('value', 'key')->toArray();
    });
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enquiry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .info-row {
            margin-bottom: 15px;
            padding: 12px;
            background: white;
            border-radius: 6px;
            border-left: 4px solid #667eea;
        }
        .label {
            font-weight: bold;
            color: #667eea;
            display: block;
            margin-bottom: 5px;
        }
        .value {
            color: #333;
        }
        .message-box {
            background: white;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            color: #6c757d;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">🎯 New Enquiry Received</h1>
        <p style="margin: 5px 0 0 0;">gurgaoncab Tour & Travel</p>
    </div>

    <div class="content">
        <p style="font-size: 16px; margin-bottom: 20px;">You have received a new enquiry from your website:</p>

        <div class="info-row">
            <span class="label">👤 Name:</span>
            <span class="value">{{ $enquiry->name }}</span>
        </div>
        <div class="info-row">
        </div>
        <div class="info-row">
            <span class="label">📧 Email:</span>
            <span class="value">{{ $enquiry->email }}</span>
        </div>
        <div class="info-row">
            <span class="label">📞 Phone:</span>
            <span class="value">{{ $enquiry->phone }}</span>
        </div>
        <div class="info-row">
            <span class="label">📍 Pickup Location:</span>
            <span class="value">{{ $enquiry->pickup_location }}</span>
        </div>
        <div class="info-row">
            <span class="label">🏁 Drop Location:</span>
            <span class="value">{{ $enquiry->drop_location }}</span>
        </div>
        <div class="info-row">
            <span class="label">🚗 Vehicle Type:</span>
            <span class="value">{{ $enquiry->vehicle_type }}</span>
        </div>
        <div class="info-row">
            <span class="label">📅 Pickup Date:</span>
            <span class="value">{{ $enquiry->date }}</span>
        </div>
        <div class="info-row">
            <span class="label">⏰ Pickup Time:</span>
            <span class="value">{{ $enquiry->pickup_time }}</span>
        </div>
        @if($enquiry->message)
            <div class="info-row">
                <span class="label">💬 Message:</span>
                <div class="message-box">
                    {{ $enquiry->message }}
                </div>
            </div>
        @endif
        <div class="info-row">
            <span class="label">🕐 Submitted At:</span>
            <span class="value">{{ $enquiry->created_at->format('d M Y, h:i A') }}</span>
        </div>
        <div style="text-align: center;">
            <a href="{{ url('/admin/enquiries/' . $enquiry->id) }}" class="button">
                View in Admin Panel
            </a>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated notification from gurgaoncab Tour & Travel website.</p>
        <p style="margin-top: 10px;">
            <strong>gurgaoncab Tour & Travel</strong><br>
            {!! nl2br(e($settings['contact_address'] ?? '2nd Floor, MG Road, Near Metro Station, Connaught Place, New Delhi 110001, India')) !!}<br>
            Phone: {{ $settings['contact_phone'] ?? '+91 456 453 345' }} | Email: {{ $settings['contact_email'] ?? 'info@example.com' }}
        </p>
    </div>
</body>
</html>
