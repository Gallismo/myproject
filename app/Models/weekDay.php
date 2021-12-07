<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weekDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_day'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
