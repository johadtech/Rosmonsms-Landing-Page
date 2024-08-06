<?

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $message;
    public $user;

    public function __construct(Booking $booking, $message, $user) {
        $this->booking = $booking;
        $this->message = $message;
        $this->user = $user;
    }

    public function build() {
        return $this->subject(gs()->site_name.' - Meeting Session Granted')->from(gs()->site_email, gs()->site_name.'.com')->view('emails.booking_message')->with(['data' => $this->booking, 'message' => $this->message, 'user' => $this->user]);
    }
}