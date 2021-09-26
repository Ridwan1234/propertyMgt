<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomStatus extends Model
{
   const OCCUPIED='occupied';
   const VACANT='vacant';
   const UNAVAILABLE='unavailable';
}
