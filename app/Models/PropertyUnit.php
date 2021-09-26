<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends Model
{
    use HasFactory;

    protected $guarded = [];


    //belongs to a property

    public function property()
    {
        return $this->belongsTo(Property::class,'property_id','id');
    }

    // A property unit has a gallery of many pictures

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'gallerable');
    }

    //A property unit has many inventories
    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'inventorable');
    }


    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id', 'id');
    }

    /**
     * Get all of the property unit's leases.
     */
    public function leases()
    {
        return $this->morphMany(Lease::class, 'leasable');
    }

    public function invoices()
    {
        return $this->morphMany(Invoice::class, 'invoicable');
    }

    /**
     * Scope a query to show only available property units.
     */
    public function scopeVacant($query)
    {
        return $query->where('status', 'vacant');
    }

    /**
     * Scope a query to show only available property units.
     */
    public function scopeOccupied($query)
    {
        return $query->where('status', 'occupied');
    }

    /**
     * Mark unit as occupied
     * Means its no longer available to lease
     */

    public function markAsOccupied()
    {
        $this->timestamps=false;
        $this->status='occupied';
        $this->save();

        $this->property()->update(['status'=>'unavailable']);
    }

    /**
     * Mark unit as vacant
     * this is after the active lease is terminated,a unit becoming available to lease again
     */

    public function markAsVacant()
    {
        $this->timestamps=false;
        $this->status='vacant';
        $this->save();

        $occupiedSiblings=PropertyUnit::occupied()->where('property_id',$this->property_id)->count();

        if ($occupiedSiblings==0){
            $this->property()->update(['status'=>'vacant']);
        }

    }

    /**
     * Mark unit as unavailable
     * This is after its parent property is leased,meaning all sub units are not available
     *
     */

    public function markAsUnavailable()
    {
        $this->timestamps=false;
        $this->status='unavailable';
        $this->save();
    }

}
