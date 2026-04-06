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
    <title>Enquiry Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
        }
        .content {
            padding: 30px 20px;
        }
        .greeting {
            font-size: 18px;
            color: #667eea;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .info-row {
            margin-bottom: 10px;
            padding: 8px 0;
        }
        .label {
            font-weight: bold;
            color: #667eea;
            display: inline-block;
            width: 100px;
        }
        .icon {
            font-size: 24px;
            margin: 0 5px;
        }
        .contact-section {
            background: #fff8dc;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .contact-item {
            margin: 10px 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }
        .checkmark {
            text-align: center;
            margin: 20px 0;
        }
        .checkmark-circle {
            width: 80px;
            height: 80px;
            background: #28a745;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Enquiry Received!</h1>
            <p style="margin: 0; font-size: 16px;">Thank you for contacting us</p>
        </div>

        <div class="content">
            <div class="checkmark">
                <div class="checkmark-circle">✓</div>
            </div>

            <p class="greeting">Dear {{ $enquiry->name }},</p>

            <p>Thank you for showing interest in <strong>gurgaoncab Tour & Travel</strong>! We have successfully received your enquiry and our team will review it shortly.</p>

            <p>We appreciate you taking the time to reach out to us and we're excited to help you plan your perfect journey across India!</p>

            <div class="info-box">
                <h3 style="margin-top: 0; color: #667eea;">📋 Your Enquiry Details:</h3>
                <div class="info-row">
                    <span class="label">Name:</span>
                    <span>{{ $enquiry->name }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Email:</span>
                    <span>{{ $enquiry->email }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Phone:</span>
                    <span>{{ $enquiry->phone }}</span>
                </div>
                @if($enquiry->message)
                    <div class="info-row">
                        <span class="label">Message:</span>
                        <div style="margin-top: 10px; padding: 10px; background: white; border-radius: 6px;">
                            {{ $enquiry->message }}
                        </div>
                    </div>
                @endif
                <div class="info-row">
                    <span class="label">Submitted:</span>
                    <span>{{ $enquiry->created_at->format('d M Y, h:i A') }}</span>
                </div>
            </div>

            <p><strong>What happens next?</strong></p>
            <ul style="line-height: 1.8;">
                <li>Our travel expert will review your enquiry within 24 hours</li>
                <li>You will receive a detailed response via email or phone</li>
                <li>We'll help you create the perfect travel plan for your needs</li>
            </ul>

            <div class="contact-section">
                <h3 style="margin-top: 0; color: #667eea;">📞 Need Immediate Assistance?</h3>
                <p>Feel free to reach out to us directly:</p>
                <div class="contact-item">
                    <strong>Phone:</strong> {{ $settings['contact_whatsapp'] ?? '+91 345 533 865' }} | {{ $settings['contact_phone'] ?? '+91 456 453 345' }}
                </div>
                <div class="contact-item">
                    <strong>WhatsApp:</strong> {{ $settings['contact_whatsapp'] ?? '+91 345 533 865' }}
                </div>
                <div class="contact-item">
                    <strong>Email:</strong> {{ $settings['contact_email'] ?? 'info@example.com' }}
                </div>
                <div class="contact-item" style="margin-top: 15px;">
                    <strong>Office Hours:</strong> Monday - Saturday, 9:00 AM - 7:00 PM
                </div>
            </div>

            <p style="text-align: center; margin-top: 30px; color: #667eea; font-size: 18px;">
                <strong>We look forward to serving you!</strong>
            </p>
        </div>

        <div class="footer">
            <p><strong>gurgaoncab Tour & Travel</strong></p>
            <p style="margin: 5px 0;">
                {!! nl2br(e($settings['contact_address'] ?? '2nd Floor, MG Road, Near Metro Station, Connaught Place, New Delhi 110001, India')) !!}
            </p>
            <p style="margin-top: 15px; font-size: 12px; color: #999;">
                This is an automated confirmation email. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
