<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'description', 'user_id', 'category_id', 'thumbnail', 'tags', 'slug', 'views', 'status'];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function scopeActive($query) {
        return $this->where('status', 1);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function views() {
        return $this->hasMany(PostView::class);
    }
    
    public function incrementViews() {
	    $this->views++;
	    $this->save();
	}
	
	public function nextPost() {
		return $this->where('category_id', $this->category_id)->where('id', '>', $this->id)->where('status', 1)->orderBy('created_at', 'asc')->first();
	}
	
	public function previousPost() {
		return $this->where('category_id', $this->category_id)->where('id', '<', $this->id)->where('status', 1)->orderBy('created_at', 'desc')->first();
	}
	
	public function relatedPosts() {
	    return $this->where('category_id', $this->category_id)->where('id', '!=', $this->id)->where('status', 1)->orderBy('created_at', 'desc')->take(5)->get();
	}
	
	public function tags() {
		return collect(explode(',', $this->tags))->map(function ($tag) {
		    return trim($tag);
		});
	}
	
	public function getRouteKeyName() {
        return 'slug';
    }
	
	protected static function boot() {
		parent::boot();
		static::creating(function ($post) {
			$post->slug = generateUniqueSlug($post->title, Post::class);
		});
		
		static::updating(function ($post) {
			if ($post->isDirty('title')) {
				$post->slug = generateUniqueSlug($post->title, Post::class);
			}
		});
	}
	
}