<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Faq;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimony;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\CustomScriptFooter;
use App\Models\CustomScriptHeader;
use App\Models\Support;
use App\Models\Category;
use App\Models\UserLogin;
use App\Models\FrontEndSetting;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\ContentPage;
use App\Mail\BookingMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\SystemNotification;

class AdminController extends Controller
{
	
	public function __construct() {
        //$this->middleware('admin');
    }
    
    public function dashboard() {
	    $nonAdminCount = User::where('is_admin', 0)->count();
	    $adminCount = User::where('is_admin', 1)->count();
	    $postCount = Post::count();
	    $supportCount = Support::count();
	    $totalBookings = Booking::count();
	    $pendingBookings = Booking::where('status', 0)->count();
	    $recentLogs = UserLogin::orderBy('created_at', 'desc')->get();
	    $bookings = Booking::latest()->take(10)->get();
	    $notifications = SystemNotification::where('readstatus', 0)->orderBy('created_at', 'desc')->get();
	    $notificationCount = SystemNotification::where('readstatus', 0)->count();
	
	    // Group notifications by date
        $groupedNotifications = $notifications->groupBy(function($date) {
            if (Carbon::parse($date->created_at)->isToday()) {
                return 'Today';
            } elseif (Carbon::parse($date->created_at)->isYesterday()) {
                return 'Yesterday';
            } else {
                return Carbon::parse($date->created_at)->format('F j, Y');
            }
        });
        
        $today = Carbon::today();
	    $weekStart = Carbon::now()->startOfWeek();
	    $monthStart = Carbon::now()->startOfMonth();
	    $yearStart = Carbon::now()->startOfYear();
	
		$viewsToday = Post::whereDate('created_at', $today)->sum('views');
	    $viewsWeekly = Post::whereBetween('created_at', [$weekStart, Carbon::now()])->sum('views');
	    $viewsMonthly = Post::whereBetween('created_at', [$monthStart, Carbon::now()])->sum('views');
	    $viewsYearly = Post::whereBetween('created_at', [$yearStart, Carbon::now()])->sum('views');
	
	    $salesToday = Booking::whereDate('created_at', $today)->count();
	    $salesWeekly = Booking::whereBetween('created_at', [$weekStart, Carbon::now()])->count();
	    $salesMonthly = Booking::whereBetween('created_at', [$monthStart, Carbon::now()])->count();
	    $salesYearly = Booking::whereBetween('created_at', [$yearStart, Carbon::now()])->count();
	    
	    return view('admin.dashboard', compact('nonAdminCount', 'adminCount', 'postCount', 'supportCount', 'totalBookings', 'pendingBookings', 'recentLogs', 'bookings', 'notifications', 'notificationCount', 'groupedNotifications', 'viewsToday', 'viewsWeekly', 'viewsMonthly', 'viewsYearly', 'salesToday', 'salesWeekly', 'salesMonthly', 'salesYearly'));
	}
	
	public function markAllRead() {
		SystemNotification::where('readstatus', 0)->update(['readstatus' => 1]);
		return redirect()->back()->with('success', 'All notifications marked as read.');
	}
	
	public function clearAllNotification() {
		SystemNotification::truncate();
		return redirect()->back()->with('success', 'All notifications cleared.');
	}
	
	public function listUsers(Request $request) {
        $status = $request->input('status');
        if ($status !== null) {
            $users = User::where('is_admin', 0)->where('status', $status)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $users = User::where('is_admin', 0)->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('admin.users.index', compact('users'));
    }
    
    public function showUser($id) {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    
    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    
    public function updateUser(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    
    public function loginAsUser($id) {
        $user = User::findOrFail($id);
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Logged in as user successfully.');
    }
    
    // Method to list posts with optional status filter
    public function listPosts(Request $request)
    {
        $status = $request->input('status');
        if ($status !== null) {
            $posts = Post::where('status', $status)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('admin.posts.index', compact('posts'));
    }
    
    public function createPost() {
    	$categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }
    
    public function storePost(Request $request) {
	    $request->validate([
	        'title' => 'required|string|max:255',
	        'content' => 'required|string',
	        'description' => 'required|string',
	        'category_id' => 'required|integer',
	        'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:5120',
	        'tags' => 'nullable|string',
	        'status' => 'required|boolean',
	    ]);
	
	    $data = $request->except(['thumbnail']); // Initialize data array excluding the thumbnail
	
	    if ($request->hasFile('thumbnail')) {
	        $image = $request->file('thumbnail');
	        $imageName = Str::slug($request->input('title')) . '_' . time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/post'), $imageName);
	        $data['thumbnail'] = $imageName;
	    }
	
	    $data['user_id'] = auth()->id();
	
	    Post::create($data); // Create post with merged data
	
	    return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
	}
    
    public function editPost($id) {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }
    
    public function updatePost(Request $request, $id) {
	    $post = Post::findOrFail($id);
	    
	    $request->validate([
	        'title' => 'required|string|max:255',
	        'content' => 'required|string',
	        'description' => 'required|string',
	        'category_id' => 'required|integer',
	        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
	        'tags' => 'nullable|string',
	        'status' => 'required|boolean',
	    ]);
	
	    $data = $request->except(['thumbnail']); // Initialize data array excluding the thumbnail
	    
	    if ($request->hasFile('thumbnail')) {
	        // Delete the old thumbnail if it exists
	        if ($post->thumbnail && file_exists(public_path('storage/post/' . $post->thumbnail))) {
	            unlink(public_path('storage/post/' . $post->thumbnail));
	        }
	
	        $image = $request->file('thumbnail');
	        $imageName = Str::slug($request->input('title')) . '_' . time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/post'), $imageName);
	        $data['thumbnail'] = $imageName;
	    }
	
	    $post->update($data); // Update post with merged data
	
	    return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
	}
    
    public function deletePost($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
    
    public function listCategories() {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }
    
    public function createCategory() {
        return view('admin.categories.create');
    }
    
    public function storeCategory(Request $request) {
        $category = Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    
    public function editCategory($id) {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    
    public function updateCategory(Request $request, $id) {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
    
    public function deleteCategory($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
    
    public function editSettings() {
        $settings = Setting::first();
        return view('admin.settings.edit', compact('settings'));
    }
    
    public function updateSettings(Request $request) {
    	$request->validate([
	        'site_name' => 'required|string|max:255',
	        'site_email' => 'required|email|max:255',
	        'site_mobile' => 'required|string|max:255',
	        'site_address' => 'required|string|max:255',
	        'admin_auth_url' => 'required|string|max:255',
	        'description' => 'required|string',
	        'keyword' => 'nullable|string|max:255',
	        'social_facebook' => 'required|url|max:255',
	        'social_instagram' => 'required|url|max:255',
	        'social_twitter' => 'required|url|max:255',
	        'socialIcon' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
	        'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
	        'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
	        'favicon' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
	        'email_host' => 'nullable|string|max:255',
	        'email_port' => 'nullable|string|max:255',
	        'email_username' => 'nullable|string|max:255',
	        'email_password' => 'nullable|string|max:255',
	    ]);
	
	    $settings = Setting::first();
	    $data = $request->except(['socialIcon', 'logo', 'footer_logo', 'favicon']);
	
	    if ($request->hasFile('socialIcon')) {
	        $image = $request->file('socialIcon');
	        $imageName = 'socialIcon_' . time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/general'), $imageName);
	        $data['socialIcon'] = $imageName;
	    }
	
	    if ($request->hasFile('logo')) {
	        $image = $request->file('logo');
	        $imageName = 'logo_' . time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/general'), $imageName);
	        $data['logo'] = $imageName;
	    }
	
	    if ($request->hasFile('footer_logo')) {
	        $image = $request->file('footer_logo');
	        $imageName = 'footer_logo_' . time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/general'), $imageName);
	        $data['footer_logo'] = $imageName;
	    }
	
	    if ($request->hasFile('favicon')) {
	        $image = $request->file('favicon');
	        $imageName = 'favicon_' . time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/general'), $imageName);
	        $data['favicon'] = $imageName;
	    }
	
	    $settings->update($data);
	
	    return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
        //$settings = Setting::first();
        //$settings->update($request->all());
        //return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
    
    public function listBookings(Request $request) {
	    $status = $request->input('status');
	    if ($status !== null) {
	        $bookings = Booking::where('status', $status)->orderBy('created_at', 'desc')->paginate(10);
	    } else {
	        $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);
	    }
	    return view('admin.bookings.index', compact('bookings'));
	}
    
    public function approveBooking($id) {
	    $booking = Booking::findOrFail($id);
	    $booking->update(['status' => 1]);
	
	    $fullname = $booking->fullname;
		$parts = explode(' ', $fullname);
		
		$first_name = ucfirst(strtolower($parts[0]));
		$last_name = ucfirst(strtolower(isset($parts[2]) ? $parts[2] : $parts[1]));
	
		// Create user account
        $password = Str::random(8);
        //$user = User::create([
            //'first_name' => $first_name,
            //'last_name' => $last_name,
            //'mobile' => $booking->mobile,
            //'email' => $booking->email,
            //'password' => Hash::make($password),
            //'is_admin' => 0,
        //]);
        
        // Send email to user
        //Mail::raw("Your demo access has been granted. Login with email: {$user->email} and password: 12345678", function ($message) use ($user) {
            //$message->to($user->email)->subject('Demo Access Granted');
        //});
	
	    return redirect()->route('admin.bookings.index')->with('success', 'Booking approved successfully.');
	}
	
	public function deleteBooking($id) {
	    $booking = Booking::findOrFail($id);
	    $booking->delete();
	    return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
	}
	
	public function updateBooking(Request $request, $id) {
	    $booking = Booking::findOrFail($id);
	    $booking->update($request->only(['status']));
	    return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
	}
	
	public function editBooking($id) {
	    $booking = Booking::findOrFail($id);
	    return view('admin.bookings.edit', compact('booking'));
	}
	
	public function showBookingMsgForm($id) {
		$booking = Booking::findOrFail($id);
		return view('admin.bookings.send', compact('booking'));
	}
	
	public function sendBookingMsg(Request $request, $id) {
		$request->validate([
			'email' => 'required|email',
			'message' => 'required|string',
		]);
		
        $message = $request->message;
        $user = $request->email;
        try {
	        $booking = Booking::findOrFail($id);
		    $booking->update(['status' => 1]);
		
	        Mail::to($user)->send(new BookingMessage($user, $message, $booking));
	    } catch (\Exception $ex){
			\Illuminate\Support\Facades\Log::error('Error sending reset password email: ' . $ex->getMessage());
			return redirect()->route('admin.bookings.index')->with('error', $ex->getMessage());
		}
		return redirect()->route('admin.bookings.index')->with('success', 'Booking approved successfully.');
	}
	
	public function listCustomScripts() {
		$headscript = CustomScriptHeader::first();
        $footscript = CustomScriptFooter::first();
        return view('admin.scripts.index', compact('headscript', 'footscript'));
    }
	
	public function updateCustomScriptFooter(Request $request, $id) {
	    $script = CustomScriptFooter::findOrFail($id);
	    $script->update($request->only(['script']));
	    return redirect()->route('admin.scripts.index')->with('success', 'Script updated successfully.');
	}
	
	public function updateCustomScriptHeader(Request $request, $id) {
	    $script = CustomScriptHeader::findOrFail($id);
	    $script->update($request->only(['script']));
	    return redirect()->route('admin.scripts.index')->with('success', 'Script updated successfully.');
	}
	
	public function listPartners() {
	    $partners = Partner::orderBy('created_at', 'desc')->paginate(10);
	    return view('admin.partners.index', compact('partners'));
	}
	
	public function createPartner() {
	    return view('admin.partners.create');
	}
	
	public function storePartner(Request $request) {
	    $data = $request->except(['brand_image']);
	    
	    if ($request->hasFile('brand_image')) {
	        $image = $request->file('brand_image');
	        $imageName = $request->brand_name.''.time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/partner'), $imageName);
	        $data['brand_image'] = $imageName;
	    }
	
	    Partner::create($data);
	
	    return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully.');
	}
	
	public function editPartner($id) {
	    $partner = Partner::findOrFail($id);
	    return view('admin.partners.edit', compact('partner'));
	}
	
	public function updatePartner(Request $request, $id) {
		$partner = Partner::findOrFail($id);
	    $data = $request->except(['brand_image']);
	
	    if ($request->hasFile('brand_image')) {
	        $image = $request->file('brand_image');
	        $imageName = $request->brand_name.''.time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/partner'), $imageName);
	        $data['brand_image'] = $imageName;
	    }
	
	    $partner->update($data);
	    
	    return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
	}
	
	public function deletePartner($id) {
	    $partner = Partner::findOrFail($id);
	    $partner->delete();
	    return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
	}
	
	public function listTeamMembers() {
	    $teamMembers = TeamMember::orderBy('created_at', 'desc')->paginate(10);
	    return view('admin.team-members.index', compact('teamMembers'));
	}
	
	public function createTeamMember() {
	    return view('admin.team-members.create');
	}
	
	public function storeTeamMember(Request $request) {
	    $data = $request->except(['team_image']);
	    
	    if ($request->hasFile('team_image')) {
	        $image = $request->file('team_image');
	        $imageName = $request->team_fullname.''.time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/team'), $imageName);
	        $data['team_image'] = $imageName;
	    }
	
	    TeamMember::create($data);
	
	    return redirect()->route('admin.team-members.index')->with('success', 'Team Member created successfully.');
	}
	
	public function editTeamMember($id) {
	    $teamMember = TeamMember::findOrFail($id);
	    return view('admin.team-members.edit', compact('teamMember'));
	}
	
	public function updateTeamMember(Request $request, $id) {
	    $teamMember = TeamMember::findOrFail($id);
	    $data = $request->except(['team_image']);
	
	    if ($request->hasFile('team_image')) {
	        $image = $request->file('team_image');
	        $imageName = $request->team_fullname.''.time() . '.' . $image->getClientOriginalExtension();
	        $image->move(public_path('storage/team'), $imageName);
	        $data['team_image'] = $imageName;
	    }
	
	    $teamMember->update($data);
	    
	    return redirect()->route('admin.team-members.index')->with('success', 'Team Member updated successfully.');
	}
	
	public function deleteTeamMember($id) {
	    $teamMember = TeamMember::findOrFail($id);
	    $teamMember->delete();
	    return redirect()->route('admin.team-members.index')->with('success', 'Team Member deleted successfully.');
	}
	
	public function listTestimonies(Request $request) {
	    $status = $request->input('status');
	    if ($status !== null) {
	        $testimonies = Testimony::where('status', $status)->orderBy('created_at', 'desc')->paginate(10);
	    } else {
	        $testimonies = Testimony::orderBy('created_at', 'desc')->paginate(10);
	    }
	    return view('admin.testimonies.index', compact('testimonies'));
	}
	
	public function createTestimony() {
	    return view('admin.testimonies.create');
	}
	
	public function storeTestimony(Request $request) {
	    $testimony = Testimony::create($request->all());
	    return redirect()->route('admin.testimonies.index')->with('success', 'Testimony created successfully.');
	}
	
	public function editTestimony($id) {
	    $testimony = Testimony::findOrFail($id);
	    return view('admin.testimonies.edit', compact('testimony'));
	}
	
	public function updateTestimony(Request $request, $id) {
	    $testimony = Testimony::findOrFail($id);
	    $testimony->update($request->all());
	    return redirect()->route('admin.testimonies.index')->with('success', 'Testimony updated successfully.');
	}
	
	public function deleteTestimony($id) {
	    $testimony = Testimony::findOrFail($id);
	    $testimony->delete();
	    return redirect()->route('admin.testimonies.index')->with('success', 'Testimony deleted successfully.');
	}
	
	public function listFaqs(Request $request) {
        $status = $request->input('status');
        if ($status !== null) {
            $faqs = Faq::where('status', $status)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $faqs = Faq::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('admin.faqs.index', compact('faqs'));
    }

    public function createFaq() {
        return view('admin.faqs.create');
    }

    public function storeFaq(Request $request) {
        $faq = Faq::create($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function editFaq($id) {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function updateFaq(Request $request, $id) {
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function deleteFaq($id) {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
    
    public function highlightNotification($id) {
    	$notification = SystemNotification::findOrFail($id);
	    $notification->readstatus = 1; // Mark as read
        $notification->save();
        return view('admin.notifications.show', compact('notification'));
    }
    
    public function updateProfile(Request $request) {
    	$validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|numeric|max:255',
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'We can\'t find a user with this record.');
        }
        
        $user->update($request->only(['first_name', 'last_name', 'mobile', 'avater']));
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
    public function updatePass() {
    	return view('admin.users.pass');
    }
    
    public function updatePassword(Request $request) {
    	// Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'We can\'t find a user with this record.');
        }
        
        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', 'Password updated successfully!');
    }
    
    public function listPages() {
    	return view('admin.pages.index');
    }
    
    public function editPages(Request $request) {
	    $request->validate([
	        'page' => 'required|string|max:255',
	    ]);
	
	    $page = $request->page;
	    $keys = [];
	
	    switch ($page) {
	        case 'home':
	            $keys = ['hero_tagline', 'hero_description', 'hero_button_one', 'hero_button_two', 'hero_image', 'below_hero_heading', 'below_hero_description', 'below_hero_video', 'home_about_heading', 'home_about_description_one', 'home_about_description_two', 'home_about_button', 'home_about_image', 'home_faq_heading', 'home_faq_description', 'home_testimony_heading', 'home_testimony_description', 'home_contact_text'];
	            break;
	        case 'about-us':
	            $keys = ['about_us_image', 'about_us_team_text'];
	            break;
	        case 'privacy-policy':
	            $keys = ['privacy_and_policy_image'];
	            break;
	        case 'terms-and-conditions':
	            $keys = ['terms_and_conditions_image'];
	            break;
	        case 'contact-us':
	            $keys = ['contact_us_text'];
	            break;
	        case 'book-a-demo':
	            $keys = ['book_a_demo_image'];
	            break;
	    }
	
	    $settings = FrontEndSetting::whereIn('key', $keys)->get()->pluck('value', 'key')->toArray();
	    $pageContent = \App\Models\ContentPage::where('slug', $page)->first();
	
	    return view('admin.pages.edit', compact('settings', 'page', 'pageContent'));
	}
    
    public function updatePages(Request $request) {
	    $page = $request->input('page');
	    $data = $request->except(['_token', '_method', 'page']);
		//\Illuminate\Support\Facades\Log::info('Received request data:', $data);
	
	    $heroImageKeys = [
	        'hero_image_one',
	        'hero_image_two',
	        'hero_image'
	    ];
	
	    $generalImageKeys = [
	        'home_about_image',
	        'about_us_image',
	        'privacy_and_policy_image',
	        'terms_and_conditions_image'
	    ];
	
	    $videoKey = 'below_hero_video';
	
	    foreach ($data as $key => $value) {
	        if (in_array($key, array_merge($heroImageKeys, $generalImageKeys)) && $request->hasFile($key)) {
	            $file = $request->file($key);
	            $fileName = time() . '_' . $file->getClientOriginalName();
	            //\Illuminate\Support\Facades\Log::info('Processing file upload:', ['key' => $key, 'file' => $file]);
	
	            if (in_array($key, $heroImageKeys)) {
	                $file->move(public_path('storage/hero'), $fileName);
	            } else {
	                $file->move(public_path('storage/general'), $fileName);
	            }
	
	            $value = $fileName;
	        } elseif ($key === $videoKey && $request->hasFile($key)) {
	            $file = $request->file($key);
	            //\Illuminate\Support\Facades\Log::info('Processing file upload:', ['key' => $key, 'file' => $file]);
	            $fileName = time() . '_' . $file->getClientOriginalName();
	            $file->move(public_path('storage/general'), $fileName);
	            $value = $fileName;
	        } elseif ($request->has($key)) {
				$value = $request->input($key);
			} elseif (in_array($key, array_merge($heroImageKeys, $generalImageKeys, [$videoKey])) && !$request->hasFile($key)) {
				//\Illuminate\Support\Facades\Log::info('File not uploaded:', ['key' => $key, 'hasFile' => $request->hasFile($key)]);
				$currentSetting = FrontEndSetting::where('key', $key)->first();
	            if ($currentSetting) {
	                $value = $currentSetting->value;
	            }
	        } else {
		        //\Illuminate\Support\Facades\Log::info('File not uploaded:', ['key' => $key, 'hasFile' => $request->hasFile($key)]);
				$currentSetting = FrontEndSetting::where('key', $key)->first();
				if ($currentSetting) {
					$value = $currentSetting->value;
				}
		    }
	        
	        if (!is_null($value)) {
	            FrontEndSetting::updateOrCreate(['key' => $key], ['value' => $value]);
	        } else {
				//\Illuminate\Support\Facades\Log::error('Value is null for key:', ['key' => $key]);
		    }
	    }
	
	    return redirect()->route('admin.pages.index')->with('success', ucfirst($page) . ' page settings updated successfully.');
	}
	
	public function updatePagesContent(Request $request, $slug) {
        $request->validate(['content' => 'required']);
        
        $contentPage = ContentPage::where('slug', $slug)->firstOrFail();
        //\Log::info('Updating page content', ['slug' => $slug, 'content' => $request->input('content')]);
        
        if ($contentPage->isDirty('content') || $contentPage->content !== $request->input('content')) {
	        $contentPage->content = $request->input('content');
	        $contentPage->updated_at = now();
	        $contentPage->save();
	    }
        
        //$contentPage->update($request->only('content'));
        //\Log::info('Updated page content', ['contentPage' => $contentPage]);

        return redirect()->route('admin.pages.index')->with('success', 'Page content updated successfully.');
    }
    
    public function updateEnv(Request $request) {
    	$request->validate([
		    'APP_NAME' => 'required|string|max:255',
		    'APP_ENV' => 'required|string|max:255',
		    'APP_DEBUG' => 'required',
		    'APP_URL' => 'required|url|max:255',
		    'MAIL_HOST' => 'required|string|max:255',
		    'MAIL_PORT' => 'required|integer|min:1|max:65535',
		    'MAIL_USERNAME' => 'required|email|max:255',
		    'MAIL_PASSWORD' => 'required|string|max:255',
		    'MAIL_ENCRYPTION' => 'required|string|max:10',
		    'MAIL_FROM_ADDRESS' => 'required|email|max:255',
		    // Add other validations as needed
		]);
        
        $data = $request->only(['APP_NAME', 'APP_ENV', 'APP_DEBUG', 'APP_URL', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION', 'MAIL_FROM_ADDRESS']);
        update_env_value($data);
        
        return redirect()->back()->with('success', 'Environment settings updated successfully.');
    }
	
	public function applicationInfo() {
        $applicationInfo = [
            'PHP Version' => PHP_VERSION,
            'Laravel Version' => \Illuminate\Foundation\Application::VERSION,
            'Site Name' => gs()->site_name,
            'Debug Mode' => config('app.debug') ? 'Enabled' : 'Disabled',
            'Site Mode' => config('app.env') == 'local' ? 'Testing' : 'Production',
            'Database Port' => config('database.connections.mysql.port'),
        ];

        return view('admin.system.about', compact('applicationInfo'));
    }
	
}
