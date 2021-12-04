<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/user/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/user/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::middleware(['bearer', 'isAdmin'])->group(function () {
    Route::post('/user/changePassword', [\App\Http\Controllers\UserController::class, 'changePassword']);
    Route::post('/user/delete', [\App\Http\Controllers\UserController::class, 'deleteUser']);

    Route::post('/Audience/create', [\App\Http\Controllers\AudienceController::class, 'createAudience']);
    Route::post('/Audience/delete', [\App\Http\Controllers\AudienceController::class, 'deleteAudience']);
    Route::patch('/Audience/edit', [\App\Http\Controllers\AudienceController::class, 'editAudience']);

    Route::post('/Department/create', [\App\Http\Controllers\DepartmentController::class, 'createDepartment']);
    Route::post('/Department/delete', [\App\Http\Controllers\DepartmentController::class, 'deleteDepartment']);
    Route::patch('/Department/edit', [\App\Http\Controllers\DepartmentController::class, 'editDepartment']);

    Route::post('/groupsPart/create', [\App\Http\Controllers\GroupsPartsController::class, 'createGroupsPart']);
    Route::post('/groupsPart/delete', [\App\Http\Controllers\GroupsPartsController::class, 'deleteGroupsPart']);
    Route::patch('/groupsPart/edit', [\App\Http\Controllers\GroupsPartsController::class, 'editGroupsPart']);

    Route::post('/lessonsOrder/create', [\App\Http\Controllers\LessonsOrdersController::class, 'createLessonsOrder']);
    Route::post('/lessonsOrder/delete', [\App\Http\Controllers\LessonsOrdersController::class, 'deleteLessonsOrder']);
    Route::patch('/lessonsOrder/edit', [\App\Http\Controllers\LessonsOrdersController::class, 'editLessonsOrder']);

    Route::post('/Subject/create', [\App\Http\Controllers\SubjectController::class, 'createSubject']);
    Route::post('/Subject/delete', [\App\Http\Controllers\SubjectController::class, 'deleteSubject']);
    Route::patch('/Subject/edit', [\App\Http\Controllers\SubjectController::class, 'editSubject']);

    Route::post('/weekDay/create', [\App\Http\Controllers\WeekDaysController::class, 'createWeekDay']);
    Route::post('/weekDay/delete', [\App\Http\Controllers\WeekDaysController::class, 'deleteWeekDay']);
    Route::patch('/weekDay/edit', [\App\Http\Controllers\WeekDaysController::class, 'editWeekDay']);

    Route::post('/Teacher/create', [\App\Http\Controllers\TeacherController::class, 'createTeacher']);
    Route::post('/Teacher/{code}/delete', [\App\Http\Controllers\TeacherController::class, 'deleteTeacher']);
    Route::patch('/Teacher/{code}/edit', [\App\Http\Controllers\TeacherController::class, 'editTeacher']);

    Route::post('/Group/create', [\App\Http\Controllers\GroupController::class, 'createGroup']);
    Route::post('/Group/delete', [\App\Http\Controllers\GroupController::class, 'deleteGroup']);
    Route::patch('/Group/edit', [\App\Http\Controllers\GroupController::class, 'editGroup']);

    Route::post('/Schedule/create', [\App\Http\Controllers\ScheduleController::class, 'createSchedule']);
    Route::post('/Schedule/massCreate', [\App\Http\Controllers\ScheduleController::class, 'massCreateSchedule']);
    Route::patch('/Schedule/{id}/edit', [\App\Http\Controllers\ScheduleController::class, 'editSchedule']);
    Route::post('/Schedule/{id}/delete', [\App\Http\Controllers\ScheduleController::class, 'deleteSchedule']);

    Route::post('/lessonBooking/create', [\App\Http\Controllers\LessonsBookingsController::class, 'createLessonBooking']);
    Route::post('/lessonBooking/delete', [\App\Http\Controllers\LessonsBookingsController::class, 'deleteLessonBooking']);
    Route::patch('/lessonBooking/edit', [\App\Http\Controllers\LessonsBookingsController::class, 'editLessonBooking']);
});

