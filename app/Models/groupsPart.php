<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\groupsPart
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart query()
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|groupsPart whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class groupsPart extends Model
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

    protected $table = 'groups_parts';

}
