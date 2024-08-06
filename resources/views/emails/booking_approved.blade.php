<!-- resources/views/emails/booking_approved.blade.php -->
<h1>Demo Access Granted</h1>
<p>Dear {{ $user->name }},</p>
<p>Your demo request has been approved. You can now log in using the following credentials:</p>
<p>Email: {{ $user->email }}</p>
<p>Password: 12345678</p>