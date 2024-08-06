<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = ['description', 'keyword', 'site_name', 'social', 'socialIcon', 'logo', 'footer_logo', 'favicon', 'admin_auth_url', 'site_email', 'site_mobile', 'site_address', 'social_facebook', 'social_instagram', 'social_twitter', 'email_port', 'email_host', 'email_password', 'email_username'];
    
}
