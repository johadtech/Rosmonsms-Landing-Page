<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'first_name', 'last_name', 'email', 'content', 'status'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
    
    public function scopeActive($query) {
        return $this->where('status', 1);
    }
    
    # One-to-Many relation with Reply model.
    public function replies() {
    	return $this->hasMany(Reply::class, 'comment_id');
    }
    
}