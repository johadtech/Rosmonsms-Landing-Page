<?php

//use DOMXPath;
//use DOMDocument;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Category;
use App\Models\UserLogin;
use Illuminate\Support\Str;
use App\Custom\EnvUpdater;
use App\Custom\SystemNotify;
use App\Custom\AvatarHelper;
use App\Custom\TocGenerator;
use App\Custom\SettingsHelper;
use Illuminate\Support\Collection;
use App\Models\CustomScriptHeader;
use App\Models\CustomScriptFooter;

if (!function_exists('formatDate')) {
    function formatDate($date) {
        return \Carbon\Carbon::parse($date)->format('jS M, Y');
    }
}

if (!function_exists('formatCreatedAt')) {
    function formatCreatedAt($createdAt) {
        $date = Carbon::parse($createdAt)->format('Y/m/d');
        $time = Carbon::parse($createdAt)->format('h:i A');
        return ['date' => $date, 'time' => $time];
    }
}

if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug($title, $modelClass) {
        // Generate initial slug
        $slug = Str::slug($title);
        // Check if the slug already exists in the database
        $originalSlug = $slug;
        $counter = 1;
        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }
}

if (!function_exists('getHeaderScript')) {
    function getHeaderScript() {
        $script = CustomScriptHeader::first();
        return $script ? $script->script : '';
    }
}

if (!function_exists('getFooterScript')) {
    function getFooterScript() {
        $script = CustomScriptFooter::first();
        return $script ? $script->script : '';
    }
}

if (! function_exists('set_env_value')) {
	function set_env_value($key, $value) {
		$path = base_path('.env');
		if(file_exists($path)) {
			file_put_contents($path, str_replace(
				$key . '=' . env($key),
				$key . '=' . $value,
				file_get_contents($path)
			));
		}
	}
}

if (! function_exists('notify_admin')) {
    function notify_admin($subject, $content, $userId = null) {
        return SystemNotify::createSystemNotification($subject, $content);
    }
}

if (! function_exists('toc')) {
    function toc($content) {
        return TocGenerator::generateToc($content);
    }
}

if (! function_exists('front_setting')) {
    function front_setting($key, $default = null) {
        return SettingsHelper::get($key, $default);
    }
}

if (! function_exists('generate_avater')) {
    function generate_avater($fullname) {
        return AvatarHelper::generateAvatar($fullname);
    }
}

if (! function_exists('update_env_value')) {
    function update_env_value(array $data) {
        return EnvUpdater::updateEnv($data);
    }
}

if (!function_exists('filter_phone')) {
	function filter_phone($phone) {
        $phone = str_replace([' ', '-'], '', $phone);
        return $phone;
    }
}

if (!function_exists('gs')) {
	function gs() {
        return Setting::first();
    }
}

if (!function_exists('digits_formatter')) {
	function digits_formatter($num) {
		if ($num >= 1000) {
			$units = ['K', 'M', 'B', 'T'];
			$num = floatval($num);
			$unitIndex = floor((strlen($num) - 1) / 3);
			$unit = $units[$unitIndex - 1];
			$num = $num / pow(1000, $unitIndex);
			return number_format($num, $num - floor($num) > 0 ? 1 : 0) . $unit;
		}
		return (string)$num;
	}
}

if (!function_exists('catch_that_image')) {
	function catch_that_image($post) {
		$dom = new \DOMDocument();
		// Suppress warnings with @ due to HTML5 tags or malformed HTML
		@$dom->loadHTML($post->content);
		$images = $dom->getElementsByTagName('img');
		if ($images->length > 0) {
			// Use the 1st image found in the post content
			$firstImgNode = $images->item(0);
			if ($firstImgNode instanceof \DOMElement) {
				$first_img = $firstImgNode->getAttribute('src');
			} else {
				$first_img = ''; // Fallback in case the node is not a DOMElement
			}
		} else {
			// Use the featured image or default social icon
			$first_img = $post->thumbnail ? asset('storage/post/'.$post->thumbnail) : asset('storage/general/'.gs()->socialIcon);
		}

		return $first_img;
	}
}


if (! function_exists('get_user_ip')) {
	function get_user_ip($ip) {
		$client = new Client();
		try {
			$url = "https://ipapi.co/".$ip."/json";
			$response = $client->get($url);

			return json_decode($response->getBody()->getContents(), true);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			\Illuminate\Support\Facades\Log::info('Error Getting User Ip: ' . json_encode(json_decode($e->getResponse()->getBody()->getContents(), true)));
		}
	}
}

if (! function_exists('save_log_details')) {
	function save_log_details($user, $ip, $timezone) {
		$userLogin = new UserLogin();
		$info = get_user_ip($ip);

	    $userLogin->longitude =  $info['longitude'];
	    $userLogin->latitude =  $info['latitude'];
	    $userLogin->city =  $info['city'];
	    $userLogin->country_code = $info['country_code'];
	    $userLogin->country =  $info['country_name'];

	    //$userAgent = osBrowser();
	    $userAgentInfo = osBrowser();
	    $userLogin->user_id = $user->id;
	    $userLogin->user_ip =  $info['ip'];

	    $userLogin->timezone = $timezone;

	    //$userLogin->browser = @$userAgent['browser'];
	    //$userLogin->os = @$userAgent['os_platform'];
	    $userLogin->browser = $userAgentInfo['browser'];
	    $userLogin->os = $userAgentInfo['os_platform'];
	    $userLogin->save();
	}
}

if (!function_exists('osBrowser')) {
    function osBrowser() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $osPlatform = "Unknown OS Platform";
        $browser = "Unknown Browser";

        // OS detection
        $osArray = [
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        ];

        foreach ($osArray as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                $osPlatform = $value;
                break;
            }
        }

        // Browser detection
        $browserArray = [
            '/msie/i' => 'Internet Explorer',
            '/trident/i' => 'Internet Explorer', // For IE 11+
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser'
        ];

        foreach ($browserArray as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                $browser = $value;
                break;
            }
        }

        return ['os_platform' => $osPlatform, 'browser' => $browser];
    }
}

if (!function_exists('generate_toc')) {
	function generate_toc($content) {
		preg_match_all('/<h([1-6])[^>]*>(.*?)<\/h[1-6]>/si', $content, $matches);

		if (empty($matches[0])) {
			return '';
		}

		$toc = "<ul class='list-group'>";
		$previous = 0;

		foreach ($matches[0] as $i => $match) {
            $current_heading = (int)$matches[1][$i];
            $text = strip_tags($matches[2][$i]);
            $slug = strtolower(str_replace("--", "-", preg_replace('/[^\da-z]/i', '-', $text)));
            $heading_anchor = str_replace($text, '<a class="text-reset text-decoration-none" name="' . $slug . '">' . $text . '</a>', $match);
            $content = str_replace($match, $heading_anchor, $content);

            if ($previous > 0 && $previous < $current_heading) {
                $toc .= '<ul class="list-group">';
            } elseif ($previous > $current_heading) {
                $toc .= str_repeat('</ul>', $previous - $current_heading);
            }

            $toc .= '<li class="list-group-item text-truncate"><a class="text-decoration-none fw-bold" href="#' . $slug . '">' . $text . '</a></li>';

            $previous = $current_heading;
        }

        $toc .= str_repeat('</ul>', $previous);
        return $toc;
	}
}

?>
