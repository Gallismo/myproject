<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\subjectHourCount
 *
 * @property int $id
 * @property int|null $group_id
 * @property int|null $subject_id
 * @property int $hours
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereHoursAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereHoursLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $group_part_id
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereGroupPartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|subjectHourCount whereHours($value)
 */
class subjectHourCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'subject_id',
        'hours',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $table = 'subject_hour_counts';

}
