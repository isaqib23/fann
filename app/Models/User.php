<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'type',
        'stripe_customer_id',
        'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Generate random password
     *
     * @param int $length
     * @return string
     */
    public static function generatePassword($length = 32)
    {
        return bcrypt(str_random($length));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    /**
     * @return HasOne
     */
    public function CompanyUser()
    {
        return $this->hasOne(CompanyUser::class);
    }

    /**
     * @return HasOne
     */
    public function UserCard()
    {
        return $this->hasOne(UserCreditCard::class);
    }

    /**
     * @return HasOne
     */
    public function UserDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * @return HasMany
     */
    public function userPlatforms()
    {
        return $this->hasMany(UserPlatform::class);
    }

    /**
     * @return HasMany
     */
    public function UserPlatformMeta()
    {
        return $this->hasMany(UserPlatformMeta::class);
    }



}
