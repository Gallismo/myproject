<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'middle_name',
        'user_id',
        'code'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
