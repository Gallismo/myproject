<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lessonsBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_date',
        'lesson_order_id',
        'audience_id',
        'subject_id',
        'teacher_id',
        'is_remote',
        'conference_url',
        'lesson_topic',
        'lesson_homework'
    ];

    protected $casts = [
        'is_remote' => 'boolean'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function prunable()
    {
        return static::where('updated_at', '<=', now()->subYear(2));
    }
}
