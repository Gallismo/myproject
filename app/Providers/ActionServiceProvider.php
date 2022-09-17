<?php

namespace App\Providers;

use App\Actions\AudienceCheckAction;
use App\Actions\ErrorResponseAction;
use App\Actions\FindByCode;
use App\Actions\LessonEditAction;
use App\Actions\ResponseAction;
use App\Actions\ScheduleCheckAction;
use App\Actions\ScheduleEditAction;
use App\Actions\TeacherCheckAction;
use App\Contracts\AudienceCheckContract;
use App\Contracts\ErrorResponseContract;
use App\Contracts\FindByCodeContract;
use App\Contracts\LessonEditContract;
use App\Contracts\ResponseContract;
use App\Contracts\ScheduleCheckContract;
use App\Contracts\ScheduleEditContract;
use App\Contracts\TeacherCheckContract;
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
        $this->app->bind(ResponseContract::class, ResponseAction::class);
        $this->app->bind(AudienceCheckContract::class, AudienceCheckAction::class);
        $this->app->bind(TeacherCheckContract::class, TeacherCheckAction::class);
        $this->app->bind(LessonEditContract::class, LessonEditAction::class);
        $this->app->bind(ScheduleCheckContract::class, ScheduleCheckAction::class);
        $this->app->bind(ScheduleEditContract::class, ScheduleEditAction::class);
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
