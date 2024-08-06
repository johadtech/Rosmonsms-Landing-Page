<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     
     protected $fillable = ['first_name', 'last_name', 'mobile', 'avater', 'ref_id', 'ref_code', 'email', 'password', 'is_admin', 'email_verified_at', 'status', 'remember_token'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
     
     protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
     
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public static function boot() {
        parent::boot();

        static::creating(function ($user) {
        	$user->avater = generate_avater(self::fullname());
            $user->ref_code = self::generateReferralCode();
            $user->password = Hash::make("12345678");
        });
    }

    private static function generateReferralCode() {
        do {
            $code = 'ref' . self::generateRandomString(10);
        } while (self::where('ref_code', $code)->exists());

        return $code;
    }

    private static function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Relationship to the post
    public function posts() {
	    return $this->hasMany(Post::class, 'user_id');
	}
    
    // Relationship to the invitee
    public function invitee() {
        return $this->belongsTo(User::class, 'ref_id');
    }
    
    // Relationship to the users referred by this user
    public function myreferrals() {
        return $this->hasMany(User::class, 'ref_code');
    }
    
    public function fullname() {
    	return $this->first_name.' '.$this->last_name;
    }
    
}
