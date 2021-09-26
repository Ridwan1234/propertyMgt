<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{


    protected $guarded = [];


    //invoice belongs to a tenant
    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id', 'id');
    }

    // An invoice may be for a property,or property unit
    public function invoicable()
    {
        return $this->morphTo();
    }

    // Invoice payments will be seen by landlord
    public function landlord()
    {
        return $this->belongsTo(User::class,'landlord_id','id');
    }

    public function lease()
    {
        return $this->belongsTo(Lease::class);
    }

    public function getTypeAttribute()
    {
        $type = '';

        if ($this->invoicable instanceof Property) {
            $type='PROPERTY';
        } elseif ($this->invoicable instanceof PropertyUnit) {
            $type='UNIT';
        }
        return $type;

    }

    /**
     * Scope a query to show published properties.
     */
    public function scopeUnpaid($query)
    {
        return $query->where('is_paid', false);
    }

}
