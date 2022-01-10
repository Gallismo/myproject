<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'start_year',
        'end_year',
        'code'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];





    public function prunable()
    {
        return static::where('created_at', '<=', now()->subYear(6));
    }
}
