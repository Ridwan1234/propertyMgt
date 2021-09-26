<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lease extends Model
{
    use SoftDeletes;


    protected $guarded = [];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id', 'id');
    }

    /**
     * Get the parent leasable model (property or property unit).
     */
    public function leasable()
    {
        return $this->morphTo();
    }

    public function leaseDocuments()
    {
        return $this->hasMany(LeaseDocument::class,'lease_id','id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function getTypeAttribute()
    {
        $type = '';

        if ($this->leasable instanceof Property) {
            $type='PROPERTY';
        } elseif ($this->leasable instanceof PropertyUnit) {
            $type='UNIT';
        }
        return $type;

    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
