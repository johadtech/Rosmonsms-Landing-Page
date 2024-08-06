<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['team_fullname', 'team_position', 'team_image', 'team_fb_url', 'team_tw_url', 'team_ig_url', 'team_lk_url', 'status'];
    
    public function scopeActive($query) {
        return $this->where('status', 1);
    }
}