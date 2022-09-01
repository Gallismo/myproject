<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\lessonsBooking
 *
 * @property int $id
 * @property string $lesson_date
 * @property int|null $lesson_order_id
 * @property int|null $audience_id
 * @property int|null $subject_id
 * @property int|null $teacher_id
 * @property bool $is_remote
 * @property string|null $conference_url
 * @property string|null $lesson_topic
 * @property string|null $lesson_homework
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking query()
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereAudienceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereConferenceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereIsRemote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereLessonDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereLessonHomework($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereLessonOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereLessonTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsBooking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'lesson_homework',
        'code'
    ];

    protected $casts = [
        'is_remote' => 'boolean'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $table = 'lessons_bookings';

    public function prunable()
    {
        return static::where('updated_at', '<=', now()->subYear(5));
    }
}
