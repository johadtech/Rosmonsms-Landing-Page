<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomScriptHeader extends Model
{
    use HasFactory;

    protected $fillable = ['script'];
    
    public function updateScript($script) {
	    $this->update(['script' => $script]);
	}
}
