<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandlordProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    //belongs to landlord
    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id', 'id');
    }
}
