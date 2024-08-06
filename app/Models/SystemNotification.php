<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'readstatus', 'subject', 'content'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
