<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Audience
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Audience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Audience extends Model
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

    protected $table = 'audiences';
}
