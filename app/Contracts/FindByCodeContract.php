<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface FindByCodeContract
{
    public function __invoke (string $code, Model $model): Model;
}
