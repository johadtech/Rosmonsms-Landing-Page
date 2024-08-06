<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminAuthController;

// General Public Route
Route::middleware('custom.tracker')->group(function () {
    Route::get('/', [PageController::class, 'homepage'])->name('home');
    Route::get('/blog', [PageController::class, 'blog_post'])->name('blog');
    Route::get('/about-us', [PageController::class, 'about_us'])->name('about');
    Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact');
    Route::get('/book-a-demo', [PageController::class, 'book_demo'])->name('bookdemo');
    Route::get('/privacy-and-policy', [PageController::class, 'privacy_and_policy'])->name('privacypolicy');
    Route::get('/terms-and-conditions', [PageController::class, 'terms_and_conditions'])->name('termcondition');
    Route::get('/{post:slug}', [PageController::class, 'show_post'])->name('showblogpost');
    Route::post('/booking-a-demo', [PageController::class, 'store_booking'])->name('storebooking');
});

Route::fallback(function () {
    return view('errors.404');
});

// Guest Route
Route::middleware(['guest'])->group(function () {
    Route::get('/ggg', [UserController::class, 'ggg'])->name('ggg');
    Route::post('/tap', [UserController::class, 'tap'])->name('tap')->middleware('auth', 'check.custom.headers');
    // Other routes that need the custom header check
});

//Auth::routes();

// Admin Auth
Route::prefix('admin')->middleware('guest')->group(function () {
    Route::get(gs()->admin_auth_url, [AdminAuthController::class, 'admin_login'])->name('adminloginform');
    Route::post(gs()->admin_auth_url, [AdminAuthController::class, 'submit_admin_login'])->name('adminlogin');
    Route::get(gs()->admin_auth_url.'/forgot-password', [AdminAuthController::class, 'showForgotPasswordForm'])->name('admin.forgot-password');
    Route::post(gs()->admin_auth_url.'/forgot-password', [AdminAuthController::class, 'sendResetLinkEmail'])->name('admin.forgot-password.post');
    Route::get(gs()->admin_auth_url.'/reset-password/{token}', [AdminAuthController::class, 'showResetForm'])->name('admin.reset-password');
    Route::post(gs()->admin_auth_url.'/reset-password', [AdminAuthController::class, 'resetPassword'])->name('admin.reset-password.post');
});

// Admin Route
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
	Route::prefix(gs()->admin_auth_url)->group(function () {
		//logout 
		Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
	    //clear ceach
		Route::get('/clear', function() {
			Artisan::call('cache:clear');
			Artisan::call('config:clear');
			Artisan::call('route:clear');
			Artisan::call('view:clear');
			return "Cache is cleared";
		});
	
		//optimize ceach
		Route::get('/optimize', function() {
			Artisan::call('config:cache');
			Artisan::call('route:cache');
			Artisan::call('view:cache');
			Artisan::call('event:cache');
			return "Cache is optimized";
		});
		
		// dashboard & user
		Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
		Route::get('/reset', [AdminController::class, 'updatePass'])->name('admin.users.pass');
		Route::get('/bookings/{id}/review', [AdminController::class, 'showBookingMsgForm'])->name('admin.bookings.review');
		Route::post('/bookings/{id}/process', [AdminController::class, 'sendBookingMsg'])->name('admin.bookings.send');
		
		// user
		Route::prefix('users')->group(function () {
	        Route::get('/', [AdminController::class, 'listUsers'])->name('admin.users.index');
	        Route::get('/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
	        Route::get('/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
	        Route::put('/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
	        Route::post('/{id}/login', [AdminController::class, 'loginAsUser'])->name('admin.users.login');
	        //Route::get('/reset', [AdminController::class, 'updatePass'])->name('admin.users.pass');
	        Route::post('/update-password', [AdminController::class, 'updatePassword'])->name('admin.users.updatePass');
	    });
		
		// blog post
		Route::prefix('posts')->group(function () {
	        Route::get('/', [AdminController::class, 'listPosts'])->name('admin.posts.index');
	        Route::get('/create', [AdminController::class, 'createPost'])->name('admin.posts.create');
	        Route::post('/store', [AdminController::class, 'storePost'])->name('admin.posts.store');
	        Route::get('/{id}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
	        Route::put('/{id}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
	        Route::delete('/{id}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
	    });
	
	    // category 
	    Route::prefix('categories')->group(function () {
	        Route::get('/', [AdminController::class, 'listCategories'])->name('admin.categories.index');
	        Route::get('/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
	        Route::post('/store', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
	        Route::get('/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
	        Route::put('/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
	        Route::delete('/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
	    });
	
		// Booking Routes
		Route::prefix('bookings')->group(function () {
		    Route::get('/', [AdminController::class, 'listBookings'])->name('admin.bookings.index');
		    Route::get('/{id}/edit', [AdminController::class, 'editBooking'])->name('admin.bookings.edit');
		    Route::put('/{id}', [AdminController::class, 'updateBooking'])->name('admin.bookings.update');
		    Route::put('/{id}/approve', [AdminController::class, 'approveBooking'])->name('admin.bookings.approve');
		    Route::delete('/{id}', [AdminController::class, 'deleteBooking'])->name('admin.bookings.delete');
		});
		
		// Partner Routes
		Route::prefix('partners')->group(function () {
		    Route::get('/', [AdminController::class, 'listPartners'])->name('admin.partners.index');
		    Route::get('/create', [AdminController::class, 'createPartner'])->name('admin.partners.create');
		    Route::post('/store', [AdminController::class, 'storePartner'])->name('admin.partners.store');
		    Route::get('/{id}/edit', [AdminController::class, 'editPartner'])->name('admin.partners.edit');
		    Route::put('/{id}', [AdminController::class, 'updatePartner'])->name('admin.partners.update');
		    Route::delete('/{id}', [AdminController::class, 'deletePartner'])->name('admin.partners.delete');
		});
		
		// Team Routes
		Route::prefix('team-members')->group(function () {
		    Route::get('/', [AdminController::class, 'listTeamMembers'])->name('admin.team-members.index');
		    Route::get('/create', [AdminController::class, 'createTeamMember'])->name('admin.team-members.create');
		    Route::post('/store', [AdminController::class, 'storeTeamMember'])->name('admin.team-members.store');
		    Route::get('/{id}/edit', [AdminController::class, 'editTeamMember'])->name('admin.team-members.edit');
		    Route::put('/{id}', [AdminController::class, 'updateTeamMember'])->name('admin.team-members.update');
		    Route::delete('/{id}', [AdminController::class, 'deleteTeamMember'])->name('admin.team-members.delete');
		});
		
		// Testimony Routes
		Route::prefix('testimonies')->group(function () {
		    Route::get('/', [AdminController::class, 'listTestimonies'])->name('admin.testimonies.index');
		    Route::get('/create', [AdminController::class, 'createTestimony'])->name('admin.testimonies.create');
		    Route::post('/store', [AdminController::class, 'storeTestimony'])->name('admin.testimonies.store');
		    Route::get('/{id}/edit', [AdminController::class, 'editTestimony'])->name('admin.testimonies.edit');
		    Route::put('/{id}', [AdminController::class, 'updateTestimony'])->name('admin.testimonies.update');
		    Route::delete('/{id}', [AdminController::class, 'deleteTestimony'])->name('admin.testimonies.delete');
		});
		
		// FAQ Routes
		Route::prefix('faqs')->group(function () {
		    Route::get('/', [AdminController::class, 'listFaqs'])->name('admin.faqs.index');
		    Route::get('/create', [AdminController::class, 'createFaq'])->name('admin.faqs.create');
		    Route::post('/store', [AdminController::class, 'storeFaq'])->name('admin.faqs.store');
		    Route::get('/{id}/edit', [AdminController::class, 'editFaq'])->name('admin.faqs.edit');
		    Route::put('/{id}', [AdminController::class, 'updateFaq'])->name('admin.faqs.update');
		    Route::delete('/{id}', [AdminController::class, 'deleteFaq'])->name('admin.faqs.delete');
		});
		
		// Notification 
		Route::prefix('notifications')->group(function () {
			Route::get('/{id}', [AdminController::class, 'highlightNotification'])->name('admin.notifications.show');
			Route::post('/mark-all-read', [AdminController::class, 'markAllRead'])->name('admin.notifications.mark');
			Route::delete('/clear-all', [AdminController::class, 'clearAllNotification'])->name('admin.notifications.clear');
		});
		
		// Custom Script Routes
		Route::prefix('scripts')->group(function () {
			Route::get('/', [AdminController::class, 'listCustomScripts'])->name('admin.scripts.index');
		    Route::put('/footer/{id}', [AdminController::class, 'updateCustomScriptFooter'])->name('admin.scripts.footer.update');
		    Route::put('/header/{id}', [AdminController::class, 'updateCustomScriptHeader'])->name('admin.scripts.header.update');
		});
		
		// settings
	    Route::prefix('settings')->group(function () {
	        Route::get('/edit', [AdminController::class, 'editSettings'])->name('admin.settings.edit');
	        Route::post('/update', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
	        Route::post('/update-env', [AdminController::class, 'updateEnv'])->name('admin.settings.updateEnv');
	    });
	
	    // page settings
	    Route::prefix('pages')->group(function () {
		    Route::get('/', [AdminController::class, 'listPages'])->name('admin.pages.index');
	        Route::post('/edit', [AdminController::class, 'editPages'])->name('admin.pages.edit');
	        Route::post('/{slug}', [AdminController::class, 'updatePagesContent'])->name('admin.pages.modify');
	        Route::put('/update', [AdminController::class, 'updatePages'])->name('admin.pages.update');
	    });
	
		// Application Info Route
	    Route::get('/system/about', [AdminController::class, 'applicationInfo'])->name('admin.system.about');
    });
});


Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/loginn', [UserController::class, 'loginn'])->name('loginn');
Route::get('/ref', [UserController::class, 'ref'])->name('ref');
Route::get('/register/{referral_code?}', [UserController::class, 'updateUser'])->name('updateUser')->middleware('guest');
