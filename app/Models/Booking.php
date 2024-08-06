<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'email', 'mobile', 'ip_address', 'reason', 'status', 'appointment_date', 'appointment_time'];
    
    public function scopeActive($query) {
        return $this->where('status', 1);
    }
    
    public function approve() {
        $this->update(['status' => 1]);
    }

    public function deleteBooking() {
        $this->delete();
    }
}