<?

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $content;

    public function __construct(Booking $booking, $content) {
        $this->booking = $booking;
        $this->content = $content;
    }

    public function build() {
        return $this->subject(gs()->site_name.' - New Demo Request')->from(gs()->site_email, gs()->site_name.'.com')->view('emails.booking_notification')->with(['data' => $this->booking, 'content' => $this->content]);
    }
}