<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $casts=[
        'amenities'=>'array'
    ];


    // A property has a gallery of many pictures

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'gallerable');
    }


    public function landlord()
    {
        return $this->belongsTo(User::class,'landlord_id','id');
    }

    public function propertyUnits()
    {
        return $this->hasMany(PropertyUnit::class);
    }

    /**
     * Get all of the property's leases.
     */
    public function leases()
    {
        return $this->morphMany(Lease::class, 'leasable');
    }


    public function invoices()
    {
        return $this->morphMany(Invoice::class, 'invoicable');
    }
    //A property has many inventories
    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'inventorable');
    }

    /**
     * Scope a query to show only available properties.
     */
    public function scopeVacant($query)
    {
        return $query->where('status', 'vacant');
    }

    /**
     * Mark property as occupied
     * Means its no longer available to lease
     */

    public function markAsOccupied()
    {
        $this->timestamps=false;
        $this->status='occupied';
        $this->save();

        $this->propertyUnits()->update(['status'=>'unavailable']);
    }

    /**
     * Mark property as occupied
     * Means its no longer available to lease
     */

    public function markAsVacant()
    {
        $this->timestamps=false;
        $this->status='vacant';
        $this->save();

        $this->propertyUnits()->update(['status'=>'vacant']);
    }

    /**
     * Mark property as unavailable
     * Means its no longer available for lease as a whole unit
     */

    public function markAsUnavailable()
    {
        $this->timestamps=false;
        $this->status='unavailable';
        $this->save();

    }

}
