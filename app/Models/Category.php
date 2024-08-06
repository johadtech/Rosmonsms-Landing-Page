<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug'];

    public function posts() {
        return $this->hasMany(Post::class);
    }
    
    protected static function boot() {
        parent::boot();
        static::creating(function ($category) {
            $category->slug = generateUniqueSlug($category->name, Category::class);
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = generateUniqueSlug($category->name, Category::class);
            }
        });
    }
    
}