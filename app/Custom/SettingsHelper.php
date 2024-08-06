<?php

namespace App\Custom;

use App\Models\FrontEndSetting;

class SettingsHelper
{
    public static function get($key, $default = null)
    {
        $setting = FrontEndSetting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}