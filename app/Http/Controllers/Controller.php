<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function codeGenerate ($model) {
        $symbols = "QWERTYUIOPASDFGHJKLZXCVBNM123456789";
        $code = "";

        for ($i=0;$i<5;$i++) {
            $code .= substr($symbols, rand(1, 35) - 1, 1);
        }

        $record = $model::where('code', $code)->first();

        if ($record || !$code) {
            $this->codeGenerate($model);
        } elseif (!$record && $code) {
            return $code;
        }
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
