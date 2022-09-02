<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\weekDay
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|weekDay whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class weekDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $table = 'week_days';

}
