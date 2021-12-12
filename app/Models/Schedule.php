<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_day_id',
        'lesson_order_id',
        'department_id',
        'start_time',
        'end_time',
        'break',
        'code'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
