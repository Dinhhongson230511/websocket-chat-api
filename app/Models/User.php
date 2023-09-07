<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
        'avatar',
        'first_name',
        'last_name',
        'furigana_first_name',
        'furigana_last_name',
        'tel',
        'fax',
        'agree_description',
        'role_id',
        'status',
        'updated_by_id',
        'travel_agency_id',
        'company_id',
        'store_id',
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

    protected $appends = [];

    public function travelAgency(): BelongsTo
    {
        return $this->belongsTo(TravelAgency::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => bcrypt($value),
        );
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all like stores
     *
     * @return BelongsToMany
     */
    public function likeStores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'likes', 'user_id', 'store_id');
    }

    //--------- UTILITIES ---------//
    public function isAdmin(): bool
    {
        return $this->role_id === Role::ADMIN->value;
    }

    public function isAgency(): bool
    {
        return $this->role_id === Role::AGENCY->value;
    }

    public function isCompany(): bool
    {
        return $this->role_id === Role::COMPANY->value;
    }

    public function isStore(): bool
    {
        return $this->role_id === Role::STORE->value;
    }

    /**
     * Add constraints to get admin by email
     *
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeGetUserByEmail($query, $email)
    {
        return $query->where('email', $email)->where('role_id', Role::AGENCY->value);
    }

    /**
     * Get the user's full name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['last_name'] . ' ' . $attributes['first_name'],
        );
    }

    /**
     * get avatar image for user
     *
     * @return Attribute
     */
    public function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => getImageUrl($this->avatar ?? '') ?: asset('assets/images/icon/avatar.svg'),
        );
    }

    public function getCompanyId()
    {
        return $this->getAttribute('company_id');
    }

    /**
     * get travel_agency_id
     *
     * @return Attribute
     */
    public function travelAgencyId(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['travel_agency_id'],
        );
    }
}
