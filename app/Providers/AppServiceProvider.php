<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Cache\RateLimiting\Limit;
use App\Models\SystemNotification;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Carbon\Carbon;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (env('APP_SSL') === 'true') {
        	$this->app['url']->forceScheme('https');
            \URL::forceScheme('https');
        }
        
        $this->removePublicPHPFromURL();
        
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
        
        View::composer('*', function ($view) use ($notifications, $notificationCount, $groupedNotifications) {
	        $sharedData = [
	            'notifications' => $notifications,
	            'notificationCount' => $notificationCount,
	            'groupedNotifications' => $groupedNotifications,
	        ];
	        $view->with($sharedData);
	    });
    }
    
    protected function removePublicPHPFromURL() {
        if (Str::contains(request()->getRequestUri(), '/public/')) {
            $url = str_replace('public/', '', request()->getRequestUri());
   
            if (strlen($url) > 0) {
                header("Location: $url", true, 301);
                exit;
            }
        }
    }
    
}
