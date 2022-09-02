<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\groupsBooking
 *
 * @property int $id
 * @property int|null $booking_id
 * @property int|null $group_id
 * @property int|null $group_part_id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking query()
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking whereGroupPartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsBooking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class groupsBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'group_id',
        'group_part_id',
        'lesson_date',
        'code'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $table = 'groups_bookings';

}
