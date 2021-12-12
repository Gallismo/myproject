<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lessonsOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'lessons_order',
        'code'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
