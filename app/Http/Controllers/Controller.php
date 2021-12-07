<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function codeGenerate ($model) {
        $symbols = "QWERTYUIOPASDFGHJKLZXCVBNM123456789qwertyuiopasdfghjklzxcvbnm";
        $code = "";

        for ($i=0;$i<30;$i++) {
            if ($i % 10 == 0 && $i>1) {
                $code .= '-';
            }
            $code .= substr($symbols, rand(1, 61) - 1, 1);
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
