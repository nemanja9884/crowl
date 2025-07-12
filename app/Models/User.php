<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'last_name',
        'email',
        'password',
        'status',
        'showed_intro',
        'age',
        'working_on_university',
        'language_teacher',
        'dominant_language',
        'language'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function setPasswordAttribute($value)
//    {
//        $this->attributes['password'] = Hash::make($value);
//    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public static function generateUniqueUsername($length = 8): string
    {
        $adjectives = config('nicknames.adjectives');
        $nouns = config('nicknames.nouns');

        do {
            $adjective = $adjectives[array_rand($adjectives)];
            $noun = $nouns[array_rand($nouns)];
            $number = rand(1000, 9999);

            $username = $adjective . $noun . $number;
        } while (User::where('username', $username)->exists());

        return $username;
    }
}
