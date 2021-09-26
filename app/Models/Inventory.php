<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{


    protected $guarded=[];

    public function inventorable()
    {
        return $this->morphTo();
    }

    public function images()
    {
        return $this->hasMany(InventoryGallery::class);
    }

    public function getTypeAttribute()
    {
        $type = '';

        if ($this->inventorable instanceof Property) {
            $type='PROPERTY';
        } elseif ($this->inventorable instanceof PropertyUnit) {
            $type='UNIT';
        }
        return $type;

    }
}
