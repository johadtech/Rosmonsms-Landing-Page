<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\ContentPage;
use App\Mail\BookingApproved;
use App\Mail\BookingNotification;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Validator;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class PageController extends Controller
{
	
	public function __construct() {
		//$this->middleware('admin');
	}
	
    public function homepage() {
    	$this->setSeoTags('Home');
        return view('pages.index');
    }
    
    public function about_us() {
    	$page = ContentPage::where('slug', 'about-us')->firstOrFail();
    	$this->setSeoTags('About Us');
        return view('pages.about', compact('page'));
    }
    
    public function contact_us() {
    	$this->setSeoTags('Contact Us');
        $page = ContentPage::where('slug', 'contact-us')->firstOrFail();
        return view('pages.contact', compact('page'));
    }
    
    public function book_demo() {
    	$page = ContentPage::where('slug', 'book-a-demo')->firstOrFail();
    	$this->setSeoTags('Book a Demo');
        return view('pages.book-demo', compact('page'));
    }
    
    public function privacy_and_policy() {
    	$this->setSeoTags('Privacy & Policy');
	    $page = ContentPage::where('slug', 'privacy-policy')->firstOrFail();
        return view('pages.privacy-and-policy', compact('page'));
    }
    
    public function terms_and_conditions() {
    	$this->setSeoTags('Terms and Conditions');
        $page = ContentPage::where('slug', 'terms-and-conditions')->firstOrFail();
        return view('pages.terms-and-conditions', compact('page'));
    }
    
    public function blog_post() {
    	$this->setSeoTags('Blog Posts');
    	$posts = Post::active()->orderBy('created_at', 'desc')->get();
	    return view('pages.blog', compact('posts'));
    }
    
    public function show_post($slug) {
        $post = Post::where('slug', $slug)->with('author', 'category', 'comments')->firstOrFail();
        $post->incrementViews();
        if($post) {
	    	$this->setSeoTags($post->title, $post->id);
	    	return view('pages.show', compact('post'));
	    } else {
			abort(404);
		}
    }
    
    public function store_booking(Request $request) {
    	// Custom validation rule for full name
	    Validator::extend('full_name', function($attribute, $value, $parameters, $validator) {
	        return preg_match('/\s/', trim($value)); // Check if there's at least one space
	    }, 'The :attribute must contain at least a first name and a last name.');
    	
    	$request->validate([
            'fullname' => 'required|string|full_name|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:bookings,mobile|numeric|digits_between:10,12',
            'reason' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);
        
        // Check if email or mobile already exists with status 1
	    $existingUser = Booking::where('status', 1)->where('email', $request->email)->orWhere('mobile', $request->mobile)->first();
	
	    if ($existingUser) {
		    return redirect()->back()->with('error', 'Please log in with the booking details you where provided with on your mailbox.')->withInput();
	    }
	
	    // Check if email or mobile already exists with status 0
	    $pendingUser = Booking::where('status', 0)->where('email', $request->email)->orWhere('mobile', $request->mobile)->first();
	
	    if ($pendingUser) {
		    return redirect()->back()->with('error', 'Email or mobile number already has a pending booking request. Hold on while it is been reviewed.')->withInput();
	    }
	
	    $requestedDate = $request->appointment_date;
	    $requestedTime = Carbon::createFromFormat('H:i', $request->appointment_time);
	
	    // Check for exact time match
	    $existingBooking = Booking::where('appointment_date', $requestedDate)->where('appointment_time', $request->appointment_time)->first();
	    if ($existingBooking) {
		    return redirect()->back()->with('error', 'This time and day are already booked. Please choose a different one.')->withInput();
		}
		
		// Check for conflicts within 30 minutes before or after the requested time
		$timeRangeStart = $requestedTime->copy()->subMinutes(60);
		$timeRangeEnd = $requestedTime->copy()->addMinutes(60);
		
		$conflictingBooking = Booking::where('appointment_date', $requestedDate)->where(function($query) use ($timeRangeStart, $timeRangeEnd) {
			$query->whereBetween('appointment_time', [$timeRangeStart->format('H:i:s'), $timeRangeEnd->format('H:i:s')]);
		})->first();
		
		if ($conflictingBooking) {
		    return redirect()->back()->with('error', 'There is already a booking within 60 minutes of the requested time. Please choose a different time.')->withInput();
        }
        
        $ip_address = $this->getUserIpAddress($request);
        $status = 0;
        
        $booking = Booking::create([
	        'fullname' => $request->fullname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'reason' => $request->reason,
            'ip_address' => $ip_address,
            'status' => $status,
            'appointment_time' => $request->appointment_time,
            'appointment_date' => $request->appointment_date,
        ]);
        
        // Send email to admin
        $subject = "New Booking Request";
        $content = ucfirst($booking->fullname)." Just requested for a demo session on ".Carbon::parse($booking->appointment_date)->format('jS \of F, Y')." at ".Carbon::parse($booking->appointment_time)->format('g:ia');
        
        //Mail::raw("New booking request from {$booking->fullname} ({$booking->email})", function ($message) use ($booking, $subject) {
            //$message->to(gs()->site_email)->subject($subject);
        //});
        
        try {
	        Mail::to(gs()->site_email)->send(new BookingNotification($booking, $content));
	        notify_admin($subject, $content);
		} catch (\Exception $ex){
        	\Illuminate\Support\Facades\Log::error('Error sending reset password email: ' . $ex->getMessage());
        }
        
        return redirect()->back()->with('success', 'Booking request submitted successfully, you will be notified through the provided mail for further details.');
    }
    
    private function setSeoTags($title, $id = null) {
    	if(!empty($id) || $id != null) {
	        $post = Post::find($id);

	        SEOMeta::setTitle($post->title. ' - ' . gs()->site_name);
	        SEOMeta::setDescription($post->description ?: '');
	        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
	        SEOMeta::addMeta('article:section', $post->category->name, 'property');
	        SEOMeta::addKeyword(['key1', 'key2', 'key3']);
	
	        OpenGraph::setDescription($post->description ?: '');
	        OpenGraph::setTitle($post->title. ' - ' . gs()->site_name);
	        OpenGraph::setUrl(url('/')."/".$post->slug);
	        OpenGraph::addProperty('type', 'article');
	        OpenGraph::addProperty('locale', 'en-us');
	        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
	        
	        OpenGraph::addImage(catch_that_image($post), ['height' => 300, 'width' => 300]);
	
	        JsonLd::setTitle($post->title. ' - ' . gs()->site_name);
	        JsonLd::setDescription($post->description ?: '');
	        JsonLd::setType('Article');
	        JsonLd::addImage(catch_that_image($post));
	        
	        OpenGraph::setTitle($post->title. ' - ' . gs()->site_name)->setDescription($post->description ?: '')->setType('article')->setArticle(['published_time' => $post->created_at, 'modified_time' => $post->updated_at, 'author' => $post->author->fullname(), 'section' => 'string', 'tag' => $post->tags]);
    	} else {
	    	SEOMeta::setTitle($title . ' - ' . gs()->site_name);
	        SEOMeta::setDescription(gs()->description ?: '');
	        SEOMeta::setCanonical(url()->current());
	        SEOMeta::addKeyword(gs()->keyword ?: '');
	        OpenGraph::setDescription(gs()->description ?: '');
	        OpenGraph::setTitle($title . ' - ' . gs()->site_name);
	        OpenGraph::setUrl(url()->current());
	        OpenGraph::addProperty('type', 'webpage');
	        TwitterCard::setTitle($title . ' - ' . gs()->site_name);
	
	        JsonLd::setTitle($title . ' - ' . gs()->site_name);
	        JsonLd::setDescription(gs()->description ?: '');
    	}
    }
    
    private function saveLogDetails($user) {
        $ip = $this->getUserIpAddress(Request::capture()) ?? request()->ip();
        $timezone = request()->header('HTTP_TIMEZONE', 'Africa/Lagos');
        save_log_details($user, $ip, $timezone);
    }
    
    public function getUserIpAddress(Request $request) {
    	$ip = $request->ip();
        // Check if the user is using a proxy
        if ($request->server('HTTP_X_FORWARDED_FOR')) {
            $proxies = explode(',', $request->server('HTTP_X_FORWARDED_FOR'));
            if (strpos($request->server('HTTP_X_FORWARDED_FOR'), ',') !== false) {
				$uip = rand(0, 1) ? trim(end($proxies)) : trim($proxies[0]);
				if (filter_var($uip, FILTER_VALIDATE_IP)) {
					$ip = $uip;
				}
            }
        }
        
        // Check if the user is using a VPN
        if ($request->server('HTTP_X_REAL_IP')) {
        	if (filter_var($request->server('HTTP_X_REAL_IP'), FILTER_VALIDATE_IP)) {
	            $ip = $request->server('HTTP_X_REAL_IP');
            }
        }
        
        // Check if the user is using a VPN
        if ($request->server('HTTP_CLIENT_IP')) {
        	if (filter_var($request->server('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP)) {
	            $ip = $request->server('HTTP_CLIENT_IP');
			}
        }

        return $ip;
    }
    
}