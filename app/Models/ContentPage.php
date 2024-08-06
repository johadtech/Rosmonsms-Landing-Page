<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContentPage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content'];
    
    public function getFormattedCreatedAtAttribute() {
        return Carbon::parse($this->created_at)->format('jS M, Y');
    }
}