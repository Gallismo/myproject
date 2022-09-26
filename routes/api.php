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







//Route::middleware(['bearer', 'isAdmin'])->group(function () {
//    Route::post('/User/register', [\App\Http\Controllers\UserController::class, 'register']);
//    Route::post('/User/changePassword', [\App\Http\Controllers\UserController::class, 'changePassword']);
//    Route::delete('/User', [\App\Http\Controllers\UserController::class, 'deleteUser']);
//    Route::patch('/User', [\App\Http\Controllers\UserController::class, 'editUser']);
//    Route::get('/User', [\App\Http\Controllers\MainReadController::class, 'getUsers']);
//    Route::get('/Roles', [\App\Http\Controllers\MainReadController::class, 'getRoles']);
//
//    Route::post('/Audience', [\App\Http\Controllers\AudienceController::class, 'createAudience']);
//    Route::delete('/Audience', [\App\Http\Controllers\AudienceController::class, 'deleteAudience']);
//    Route::patch('/Audience', [\App\Http\Controllers\AudienceController::class, 'editAudience']);
//
//    Route::post('/Department', [\App\Http\Controllers\DepartmentController::class, 'createDepartment']);
//    Route::delete('/Department', [\App\Http\Controllers\DepartmentController::class, 'deleteDepartment']);
//    Route::patch('/Department', [\App\Http\Controllers\DepartmentController::class, 'editDepartment']);
//
//    Route::post('/groupsPart', [\App\Http\Controllers\GroupsPartsController::class, 'createGroupsPart']);
//    Route::delete('/groupsPart', [\App\Http\Controllers\GroupsPartsController::class, 'deleteGroupsPart']);
//    Route::patch('/groupsPart', [\App\Http\Controllers\GroupsPartsController::class, 'editGroupsPart']);
//
//    Route::post('/lessonsOrder', [\App\Http\Controllers\LessonsOrdersController::class, 'createLessonsOrder']);
//    Route::delete('/lessonsOrder', [\App\Http\Controllers\LessonsOrdersController::class, 'deleteLessonsOrder']);
//    Route::patch('/lessonsOrder', [\App\Http\Controllers\LessonsOrdersController::class, 'editLessonsOrder']);
//
//    Route::post('/Subject', [\App\Http\Controllers\SubjectController::class, 'createSubject']);
//    Route::delete('/Subject', [\App\Http\Controllers\SubjectController::class, 'deleteSubject']);
//    Route::patch('/Subject', [\App\Http\Controllers\SubjectController::class, 'editSubject']);
//
//    Route::post('/Week', [\App\Http\Controllers\WeekDaysController::class, 'createWeekDay']);
//    Route::delete('/Week', [\App\Http\Controllers\WeekDaysController::class, 'deleteWeekDay']);
//    Route::patch('/Week', [\App\Http\Controllers\WeekDaysController::class, 'editWeekDay']);
//
//    Route::post('/Prepod', [\App\Http\Controllers\TeacherController::class, 'createTeacher']);
//    Route::delete('/Prepod', [\App\Http\Controllers\TeacherController::class, 'deleteTeacher']);
//    Route::patch('/Prepod', [\App\Http\Controllers\TeacherController::class, 'editTeacher']);
//
//    Route::post('/Group', [\App\Http\Controllers\GroupController::class, 'createGroup']);
//    Route::delete('/Group', [\App\Http\Controllers\GroupController::class, 'deleteGroup']);
//    Route::patch('/Group', [\App\Http\Controllers\GroupController::class, 'editGroup']);
//
//    Route::post('/Schedule', [\App\Http\Controllers\ScheduleController::class, 'createSchedule'])->middleware('timeConvert');
//    Route::patch('/Schedule', [\App\Http\Controllers\ScheduleController::class, 'editSchedule'])->middleware('timeConvert');
//    Route::delete('/Schedule', [\App\Http\Controllers\ScheduleController::class, 'deleteSchedule']);
//
//    Route::post('/lessonBooking', [\App\Http\Controllers\LessonsBookingsController::class, 'createLessonBooking']);
//    Route::delete('/lessonBooking', [\App\Http\Controllers\LessonsBookingsController::class, 'deleteLessonBooking']);
//    Route::patch('/lessonBooking', [\App\Http\Controllers\LessonsBookingsController::class, 'editLessonBooking']);
//
//    Route::post('/groupBooking', [\App\Http\Controllers\GroupsBookingsController::class, 'createGroupBooking']);
//    Route::delete('/groupBooking', [\App\Http\Controllers\GroupsBookingsController::class, 'deleteGroupBooking']);
//    Route::patch('/groupBooking', [\App\Http\Controllers\GroupsBookingsController::class, 'editGroupBooking']);
//
//    Route::post('/hours', [\App\Http\Controllers\SubjectHourCountController::class, 'createHourCount']);
//    Route::delete('/hours', [\App\Http\Controllers\SubjectHourCountController::class, 'deleteHourCount']);
//    Route::patch('/hours', [\App\Http\Controllers\SubjectHourCountController::class, 'editHourCount']);
//});

