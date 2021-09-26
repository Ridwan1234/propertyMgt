<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;


    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'description',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //User,case of tenant,has one profile

    public function tenantProfile()
    {
        return $this->hasOne(TenantProfile::class, 'user_id', 'id');
    }

    //user,case of tenant has many leases

    public function leases()
    {
        return $this->hasMany(Lease::class, 'tenant_id', 'id');
    }

    //User,incase of landlord,has one landlord profile

    public function landlordProfile()
    {
        return $this->hasOne(LandlordProfile::class, 'landlord_id', 'id');
    }

    //landlord has many properties
    public function properties()
    {
        return $this->hasMany(Property::class, 'landlord_id', 'id');
    }

    //landlord has many property units
    public function propertyUnits()
    {
        return $this->hasMany(PropertyUnit::class, 'landlord_id', 'id');
    }

    public function latestReply()
    {
        return $this->hasOne(Chat::class, 'sender_id', 'id')
            ->latest()
            ->where('receiver_id', auth()->id());
    }

    public function unreadReplies()
    {
        return $this->hasMany(Chat::class, 'sender_id', 'id')
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at');

    }

}
