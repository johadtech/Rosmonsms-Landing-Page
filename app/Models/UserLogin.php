<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    protected $fillable = ['longitude', 'latitude', 'city', 'country_code', 'country', 'user_id', 'user_ip', 'browser', 'os'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
