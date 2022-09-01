<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\lessonsOrder
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|lessonsOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class lessonsOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $table = 'lessons_orders';

}
