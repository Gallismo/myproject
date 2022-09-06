<?php

namespace App\Actions;

use App\Contracts\FindByCodeContract;
use Illuminate\Database\Eloquent\Model;

class FindByCode implements FindByCodeContract
{
    public function __invoke(string $code, Model $model): Model {
        return $model->where('code', $code)->first();
    }
}
