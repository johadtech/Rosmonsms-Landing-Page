<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'full_name', 'occupation', 'status'];
    
    public function scopeActive($query) {
        return $this->where('status', 1);
    }
    
}
