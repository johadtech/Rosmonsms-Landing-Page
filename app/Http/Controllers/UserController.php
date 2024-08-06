<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	
	public function home() {
		//if (auth()->check()) {
			//return view('tapscreen');
		//} else {
			return view('miniapp');
		//}
	}
	
	public function game() {
		//if (auth()->check()) {
			return view('game');
		//} else {
			//return view('miniapp');
		//}
	}
	
	public function tapscreen() {
		if (auth()->guest()) {
			return view('miniapp');
		} else {
			return view('tapscreen');
		}
	}
	
	public function tap(Request $request) {
		$myAccount = User::where('tg_id', $request->tg_id)->first();
		if($myAccount) {
			$myAccount->tap_balance += 1;
			$myAccount->save();
			return response()->json(['success' => true, 'status' => 'success', 'message' => 'Balance updated successfully.', 'data' => $myAccount->tap_balance], 200);
		} else {
			return response()->json(['success' => false, 'status' => 'failed', 'message' => 'Failed to update account.'], 401);
		}
	}
	
	public function referrals(Request $request) {
		$myRef = User::where('ref_id', $request->tg_id)->where('tg_id', '!=', $request->tg_id)->get();
		if($myRef) {
			return response()->json(['success' => true, 'status' => 'success', 'message' => 'Referrals retrieved successfully', 'data' => $myRef], 200);
		} else {
			return response()->json(['success' => false, 'status' => 'failed', 'message' => 'Failed to create account.'], 401);
		}
	}
	
	public function webhook(Request $request) {
		if (strlen($request->header('User-Agent')) > 0) {
			return response('Forbidden', 403);
		}
		
		$content = $request->getContent();
		//$data = $request->all();
		$data = json_decode($content, true);
		
		$message = $data['message'];
		$chatId = $message['chat']['id'];
		$text = $message['text'];
		$username = $message['from']['username'] ?? null;
		
		if (isset($data['message']['text'])) {
			//if (strpos($data['message']['text'], '/start') === 0) {
			if (strpos($data['message']['text'], '/start ') !== false) {
				list($n, $referer) = explode('/start ', $data['message']['text']);
				
				if (!cache()->has("chat_id_{$chatId}")) {
					$getRef = User::where('ref_code', $referer)->first();
					$validatedData = [
					    'tg_id' => $data['message']['from']['id'],
					    'first_name' => $data['message']['from']['first_name'],
					    'last_name' => $data['message']['from']['last_name'] ?? null,
					    'username' => $username,
					    'language_code' => $data['message']['from']['language_code'],
					    'ref_id' => $getRef->id,
					];
					try {
						$this->createUsers($validatedData);
					} catch (\Exception $e) {
						\Log::error('Error In Creating User: ' . $e->getMessage());
					}
					
					$community = "https://t.me/+GDCvpHTR2aE2ZWZk";
					$channelUsername = "@YourChannelUsername";
					$refUsername = $referer ? "<a href='https://t.me/@$referer'>@$referer</a>" : 'No referral';
					$webAppUrl = "http://t.me/FinanceHackBot/FHB";
					
					if(!empty($referer)) {
						$msg = "Welcome to $channelUsername, dear @$username!. \n\nYou were invited by $refUsername. \n\nFHC is a revolutionary community based project that's poised to make history as the largest community backed crypto project. \n\nBuilt on the principles of collaboration, decentralization, and inclusivity, FHC is a groundbreaking initiative that empowers individuals to come together and shape the future of cryptocurrency. \n\nIt could be probably nothing as project but something as community";
					} else {
						$msg = "Welcome to $channelUsername, dear @$username!. \n\nFHC is a revolutionary community based project that's poised to make history as the largest community backed crypto project. \n\nBuilt on the principles of collaboration, decentralization, and inclusivity, FHC is a groundbreaking initiative that empowers individuals to come together and shape the future of cryptocurrency. \n\nIt could be probably nothing as project but something as community";
					}
					
					//cache()->put("chat_id_{$chatId}", true, now()->addMinute(60));
					cache()->put("chat_id_{$chatId}", true, now()->addMonths(1));
					
					$replyMarkup = [
		                'inline_keyboard' => [[['text' => 'Start Mining', 'url' => $webAppUrl, 'web_app' => ['url' => $webAppUrl]]], [['text' => 'Join Our Community', 'url' => $community, 'web_app' => ['url' => $community]]], [['text' => 'About Finance Hack Club', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => 'http://t.me/FinanceHackBot/FHB']]]],
		                'resize_keyboard' => true,
		                'one_time_keyboard' => true,
		            ];
		
		            $response = [
		                'chat_id' => $chatId,
		                'text' => $msg,
		                'reply_markup' => json_encode($replyMarkup),
		                'parse_mode' => 'HTML',
		            ];
		
		            $this->sendTelegramMessage($response);
					
				}
			}
		}
		return response()->json(['status' => 'ok'], 200);
	}
	
	public function createUsers($validatedData) {
		\Illuminate\Support\Facades\Log::info('User Data: ' . json_encode($validatedData));
		$fname = $validatedData['first_name'];
		try {
			$user = User::firstOrCreate(
			    ['tg_id' => $validatedData['tg_id']],
			    [
			        'first_name' => $fname,
			        'last_name' => $validatedData['last_name'] ?? null,
			        'username' => $validatedData['username'],
			        'language_code' => $validatedData['language_code'],
			        'ref_id' => $validatedData['ref_id'],
			        'ref_code' => $validatedData['username'],
			        'password' => '12345678',
			    ]
			);
			
	        if($user) {
	        	Auth::login($user, true);
	            if(!empty($validatedData['ref_id'])) {
					$this->handleReferral($user, $ref);
		        }
	        }
		} catch (\Exception $e) {
			\Log::error('Error In Creating User: ' . $e->getMessage());
		}
	}
	
	private function handleReferral($user, $referralCode) {
		$referrer = User::find($user);
		if ($referrer) {
            $referrer->tap_balance = 50;
            $referrer->save();
            $this->sendMessage($referrer->tg_id, 'You earned 50 coins for referring a new user!');
		}
	}
	
	private function sendMessage($chatId, $text) {
		$replyMarkup = [
            'inline_keyboard' => [[['text' => 'Dashboard', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => 'http://t.me/FinanceHackBot/FHB']]], [['text' => 'Join Our Community', 'url' => 'https://t.me/+GDCvpHTR2aE2ZWZk', 'web_app' => ['url' => 'https://t.me/+GDCvpHTR2aE2ZWZk', 'web_app']]]],
            'resize_keyboard' => true,
            'one_time_keyboard' => true,
        ];
        
        $response = [
            'chat_id' => $chatId,
            'text' => $text,
            'reply_markup' => json_encode($replyMarkup),
            'parse_mode' => 'HTML',
        ];

        $this->sendTelegramMessage($response);
	}
	
	private function handleTapCommand($chatId) {
		$user = User::where('tg_id', $chatId)->first();
		if($user) {
			$user->tap_balance = 1;
			$user->save();
			return response()->json(['success' => true, 'chatid' => $chatId, 'balance' => $user->tap_balance], 200); 
		} else {
			return response()->json(['success' => false], 401);
		}
        //$coin = Coin::firstOrCreate(['user_id' => $user->id]);
        //$coin->amount += 10;
        //$coin->save();

        //$this->sendMessage0($chatId, 'You earned 10 coins! Total: ' . $coin->amount);
	}
	
	public function storeOrUpdate(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'tg_id' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'language_code' => 'required|string|max:10',
            'is_premium' => 'nullable|boolean',
            'allows_write_to_pm' => 'nullable|boolean',
            //'ref_id' => 'required|string|max:255',
        ]);
        
        $getUser = User::where('tg_id', $request->tg_id)->first();
        if($getUser) {
        	$getUser->first_name = $validatedData['first_name'];
            $getUser->last_name = $validatedData['last_name'] ?? null;
            $getUser->email = $validatedData['email'];
            $getUser->username = $validatedData['username'];
            $getUser->language_code = $validatedData['language_code'];
            $getUser->is_premium = $validatedData['is_premium'] ?? false;
            $getUser->allows_write_to_pm = $validatedData['allows_write_to_pm'] ?? false;
            $getUser->save();
            
	        if($getUser) {
	        	Auth::login($getUser, true);
	            return response()->json(['success' => true, 'status' => 'success', 'message' => 'Account created successfully.', 'url' => url('/')], 200);
	        } else {
	        	return response()->json(['success' => false, 'status' => 'failed', 'message' => 'Failed to create account.'], 401);
	        }
        } else {
        	return response()->json(['success' => false, 'status' => 'failed', 'message' => 'Access Forbidden.'], 403);
        }
    }
    
    
    public function authenticate(Request $request) {
    	$credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }
    
    public function logout(Request $request) {
	    Auth::logout();
	    //Auth::logoutOtherDevices($currentPassword)
	 
	    $request->session()->invalidate();
	    $request->session()->regenerateToken();
	 
	    return redirect('/');
	}
	
	public function webbhhook(Request $request) {
		\Log::info($request->all());
		$data = $request->all();
		$chatId = $data['message']['chat']['id'];
		//$text = $data['message']['text'];
		$msgId = $data['message']['message_id'];
		$channelUsername = "@YourChannelUsername";
		$username = isset($data['message']['from']['username']) ? $data['message']['from']['username'] : 'User';
		$tgurl = "https://t.me/FinanceHackBot/FHB";
		$referralId = null;
		
		$msg = "Welcome to $channelUsername, dear @$username!. \n\nFHC is a revolutionary community based project that's poised to make history as the largest community backed crypto project. \n\nBuilt on the principles of collaboration, decentralization, and inclusivity, FHC is a groundbreaking initiative that empowers individuals to come together and shape the future of cryptocurrency. \n\nIt could be probably nothing as project but something as community";
		
		if (isset($data['message']['text'])) {
			$text = $data['message']['text'];
			if ($text === '/start' || strpos($text, '/start') === 0) {
				if (!cache()->has("chat_id_{$chatId}")) {
					
					if (strlen($text) > 6) {
						$referralId = substr($text, 7);
						session(['d_ref' => $referralId]);
					}
					
					$replyMarkup = [
						'inline_keyboard' => [[['text' => 'Start Mining', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => $tgurl]]], [['text' => 'Join Our Community', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => $tgurl]]], [['text' => 'About Finance Hack Club', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => $tgurl]]]],
						'resize_keyboard' => true,
						'one_time_keyboard' => true,
					];
					
					cache()->put("chat_id_{$chatId}", true, now()->addMinute(60));
					
					$response = [
		                'chat_id' => $chatId,
		                'text' => $msg,
		                'reply_markup' => json_encode($replyMarkup),
		                'parse_mode' => 'HTML',
		                //'parse_mode' => 'Markdown',  \n\n
		            ];
					$this->sendTelegramMessage($response);
					
				} else {
					
				}
			}
		}
		return response()->json(['status' => 'ok'], 200);
	}
	
	public function webhookvv(Request $request) {
		\Log::info($request->all());
        $data = $request->all();

        if (isset($data['message']['text'])/** && $data['message']['text'] === '/start'**/) {
        	$text = $data['message']['text'];
            if (strpos($text, '/start') === 0) {
	            $chatId = $data['message']['chat']['id'];
	            $channelUsername = "@YourChannelUsername";
	            $username = isset($data['message']['from']['username']) ? $data['message']['from']['username'] : 'User';
	            $tgurl = "https://t.me/FinanceHackBot/FHB";
	            $referralId = null;
	
	            if (strlen($text) > 6) {
		            //if (strpos($text, '=') !== false) {
				        //$referralId = substr($text, strpos($text, '=') + 1);
				        $referralId = substr($text, 7);
				        session(['d_ref' => $referralId]);
			        //}
		        }
	            
	            $msg = "Welcome to $channelUsername, dear @$username!. \n\nFHC is a revolutionary community based project that's poised to make history as the largest community backed crypto project. \n\nBuilt on the principles of collaboration, decentralization, and inclusivity, FHC is a groundbreaking initiative that empowers individuals to come together and shape the future of cryptocurrency. \n\nIt could be probably nothing as project but something as community";
	
	            $replyMarkup = [
	                //'keyboard' => [[['text' => 'Open Mini App', 'web_app' => ['url' => url('/miniapp')]]]],
	                //'keyboard' => [[['text' => 'Start Mining', 'web_app' => ['url' => $tgurl]]]],
	                'inline_keyboard' => [[['text' => 'Start Mining', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => $tgurl]]], [['text' => 'Join Our Community', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => $tgurl]]], [['text' => 'About Finance Hack Club', 'url' => 'http://t.me/FinanceHackBot/FHB', 'web_app' => ['url' => $tgurl]]]],
	                'resize_keyboard' => true,
	                'one_time_keyboard' => true,
	            ];
	
	            $response = [
	                'chat_id' => $chatId,
	                //'text' => 'Welcome! Click the button below to open the Mini App.',
	                'text' => $msg,
	                'reply_markup' => json_encode($replyMarkup),
	                'parse_mode' => 'HTML',
	                //'parse_mode' => 'Markdown',  \n\n
	            ];
	
	            $this->sendTelegramMessage($response);
	        }
		}
        return response()->json(['status' => 'ok']);
    }

    private function oldsendTelegramMessage($params) {
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
    
    private function sendTelegramMessage($params) {
	    $client = new Client();
	    $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage';
	    try {
		    $response = $client->post($url, ['form_params' => $params]);
		    $body = $response->getBody()->getContents();
			\Log::info('Telegram response: ' . $body);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			\Log::error('Error sending message to Telegram: ' . $e->getResponse()->getBody()->getContents());
	        return false;
		}
	    //return $response->getBody()->getContents();
	}
	
	public function refGetUser() {
		$ref = Input::get('id');
		if ($ref) {
			if (User::where('ref_code', $ref)->exists()) {
				session(['d_ref' => $referralId]);
			}
		}
		return redirect()->route('miniapp');
	}
}
