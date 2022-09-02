<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property int|null $week_day_id
 * @property int|null $lesson_order_id
 * @property int|null $department_id
 * @property string $start_time
 * @property string $end_time
 * @property int|null $break
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereBreak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereLessonOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereWeekDayId($value)
 * @mixin \Eloquent
 */
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
        'created_at',
        'updated_at'
    ];

    protected $table = 'schedules';

}
