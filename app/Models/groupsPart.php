<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupsPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'groups_part',
        'code'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
