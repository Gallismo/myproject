<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjectHourCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'subject_id',
        'hours_all',
        'hours_left',
        'code'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $table = 'subject_hour_counts';

}
