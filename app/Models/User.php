<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_country_id',
        'phone',
        'password',
        'permissions',
        'user_type',
        'firebase_auth_id',
        'lang',
        'currency_code',
        'images',
        'role_id',
        'address',
        'postal_code',
        'country_id',
        'state_id',
        'city_id',
        'gender',
        'date_of_birth',
        'about',
        'is_newsletter_enabled',
        'is_notification_enabled',
        'balance',
        'email_verified_at',
        'is_user_banned',
        'otp',
    ];

    protected $hidden   = [
        'password',
        'remember_token',
    ];

    protected $casts    = [
        'permissions' => 'array',
        'images'      => 'array',
    ];

    public function getNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getProfilePicAttribute(): string
    {
        return arrayCheck('image_40x40', $this->images) && is_file_exists($this->images['image_40x40'], $this->images['storage']) ?
            get_media($this->images['image_40x40'], $this->images['storage']) : static_asset('images/default/user32x32.jpg');
    }

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function lastActivity(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ActivityLog::class)->latest();
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function phoneCountry(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'phone_country_id');
    }

    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function checkout(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Checkout::class);
    }

    public function instructor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Instructor::class);
    }

    public function following(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Follow::class);
    }

    public function followers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Book::class, 'instructor_id');
    }

    public function courses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    public function chatRoom(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ChatRoom::class, 'receiver_id')->latest();
    }

    public function socialAccounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeNotBanned($query)
    {
        return $query->where('is_user_banned', 0);
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', 0);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'user_id', 'id');
    }

    public function organizationStaff()
    {
        return $this->hasOne(OrganizationStaff::class, 'user_id', 'id');
    }
}
