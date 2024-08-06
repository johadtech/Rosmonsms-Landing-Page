<?php

namespace App\Custom;

use App\Models\SystemNotification;

class SystemNotify
{
    public static function createSystemNotification($subject, $content, $userId = null)
    {
        return SystemNotification::create([
	        'subject' => $subject,
	        'content' => $content,
	        'readstatus' => 0,
	        'user_id' => $userId ?? null,
	    ]);
    }
}