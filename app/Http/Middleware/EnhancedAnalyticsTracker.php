<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnhancedAnalyticsTracker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) {
    	/**
    	$start = microtime(true);
    
	    $ip = $this->getUserIpAddress(Request::capture()) ?? request()->ip();
	    $info = get_user_ip($ip);
	    **/
	    //Log::info('User IP Information:', ['info' => $info]);
	    /**
	    $route = $request->path();
	    
	    $trafficType = $this->getTrafficType($request);
	    $userAgent = $request->header('User-Agent');
	    $isBot = $this->isBot($userAgent);
	    **/
	    //$longitude =  $info['longitude'];
	    //$latitude =  $info['latitude'];
	    //$city =  $info['city'];
	    //$country_code = $info['country_code'];
	    //$country =  $info['country_name'];
	    /**
	    $userAgentInfo = osBrowser();
	    **/
		//$original_ip =  $info['ip'] ?? null;
		//$browser = $userAgentInfo['browser'];
		//$os = $userAgentInfo['os_platform'];
		/**
		$end = microtime(true);
		$timeSpent = $end - $start;
		
		DB::table('analytics')->insert([
            'traffic_type' => $trafficType,
            'user_agent' => $userAgent,
            'ip' => $ip,
            'os' => $userAgentInfo['os_platform'] ?? null,
            'browser' => $userAgentInfo['browser'] ?? null,
            'original_ip_address' => $info['ip'] ?? null,
            'route' => $route,
            'time_spent' => $timeSpent,
            'is_bot' => $isBot,
            'network' => $info['network'] ?? null,
            'ip_version' => $info['version'] ?? null,
            'city' => $info['city'] ?? null,
            'region' => $info['region'] ?? null,
            'region_code' => $info['region_code'] ?? null,
            'country' => $info['country'] ?? null,
            'country_name' => $info['country_name'] ?? null,
            'country_code' => $info['country_code'] ?? null,
            'country_code_iso3' => $info['country_code_iso3'] ?? null,
            'country_capital' => $info['country_capital'] ?? null,
            'country_tld' => $info['country_tld'] ?? null,
            'continent_code' => $info['continent_code'] ?? null,
            'latitude' => $info['latitude'] ?? null,
            'longitude' => $info['longitude'] ?? null,
            'timezone' => $info['timezone'] ?? null,
            'utc_offset' => $info['utc_offset'] ?? null,
            'country_calling_code' => $info['country_calling_code'] ?? null,
            'currency_name' => $info['currency_name'] ?? null,
            'country_population' => $info['country_population'] ?? null,
            'asn' => $info['asn'] ?? null,
            'longitude' => $info['longitude'] ?? null,
            'region' => $info['region'] ?? null,
            'continent' => $info['continent'] ?? null,
            'created_at' => now(),
        ]);
        **/
	    return $next($request);
    }
    
    private function getTrafficType($request) {
        $referer = $request->header('referer');
        if ($referer) {
            $socialMediaDomains = [
                'facebook.com', 'twitter.com', 'instagram.com',
                'linkedin.com', 'pinterest.com', 'youtube.com',
                'reddit.com', 'tiktok.com', 'snapchat.com'
            ];

            foreach ($socialMediaDomains as $domain) {
                if (strpos($referer, $domain) !== false) {
                    return 'social';
                }
            }
            return 'other';
        }
        return 'direct';
    }
    
    private function isBot($userAgent) {
        $botPatterns = [
            'bot', 'crawl', 'slurp', 'spider', 'mediapartners', 'adsbot',
            'google', 'yahoo', 'bing', 'baidu', 'duckduckgo'
        ];

        foreach ($botPatterns as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                return true;
            }
        }
        return false;
    }
    
    private function getUserIpAddress(Request $request) {
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
