<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantProfile extends Model
{
    use HasFactory;

    protected $guarded=[];


    //tenant profile belongs to tenant

    public function tenant()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
