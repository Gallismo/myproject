<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupsBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'group_id',
        'group_part_id'
    ];
}
