<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryGallery extends Model
{

    protected $guarded=[];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
