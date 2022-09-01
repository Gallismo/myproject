<?php

namespace App\Providers;

use App\Actions\ErrorResponseAction;
use App\Actions\FindByCode;
use App\Actions\ResponseAction;
use App\Contracts\ErrorResponseContract;
use App\Contracts\FindByCodeContract;
use App\Contracts\ResponeContract;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FindByCodeContract::class, FindByCode::class);
        $this->app->bind(ErrorResponseContract::class, ErrorResponseAction::class);
        $this->app->bind(ResponeContract::class, ResponseAction::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
