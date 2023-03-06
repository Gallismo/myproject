<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('index');
//});
//
//Route::get('/admin', function () {
//    return view('admin');
//})->middleware('bearer')->middleware('isAdmin');
//Route::get('/admin/{any}', function () {
//    return view('admin');
//})->where('any', '.*')->middleware('bearer')->middleware('isAdmin');
//Route::get('/{any}', function () {
//    return view('index');
//})->where('any', '.*');

//Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('/admin', function () {
    return view('layouts.admin');
})->middleware(['isAuth', 'isAdmin']);
Route::get('/', function () {
    return view('layouts.index');
});
Route::get('/login', function () {
    return view('layouts.login');
});
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->middleware(['isAuth', 'isAdmin']);
Route::get('/search', [\App\Http\Controllers\MainReadController::class, 'search']);
Route::prefix('api')->group(function () {

    Route::get('/lessons', [\App\Http\Controllers\MainReadController::class, 'getLessons']);
    Route::get('/Group', [\App\Http\Controllers\MainReadController::class, 'getAllGroups']);
    Route::get('/Department', [\App\Http\Controllers\MainReadController::class, 'getAllDepartments']);
    Route::get('/Audience', [\App\Http\Controllers\MainReadController::class, 'getAllAudiences']);
    Route::get('/Week', [\App\Http\Controllers\MainReadController::class, 'getAllWeeks']);
    Route::get('/lessonsOrder', [\App\Http\Controllers\MainReadController::class, 'getAllLessonOrders']);
    Route::get('/groupsPart', [\App\Http\Controllers\MainReadController::class, 'getAllGroupParts']);
    Route::get('/Subject', [\App\Http\Controllers\MainReadController::class, 'getAllSubject']);
    Route::get('/Prepod', [\App\Http\Controllers\MainReadController::class, 'getAllPrepods']);
    Route::get('/Captain', [\App\Http\Controllers\MainReadController::class, 'getCaptains']);
    Route::get('/Schedule', [\App\Http\Controllers\MainReadController::class, 'getSchedules']);


    Route::get('/lessonBooking', [\App\Http\Controllers\MainReadController::class, 'getBookings']);
    Route::get('/lessonBooking/group', [\App\Http\Controllers\MainReadController::class, 'getGroupBooking']);
    Route::get('/lessonBooking/teacher', [\App\Http\Controllers\MainReadController::class, 'getTeacherBooking']);
    Route::get('/lessonBooking/audience', [\App\Http\Controllers\MainReadController::class, 'getAudienceBooking']);


    Route::post('/User/register', [\App\Http\Controllers\UserController::class, 'register']);
    Route::post('/User/changePassword', [\App\Http\Controllers\UserController::class, 'changePassword']);
    Route::delete('/User', [\App\Http\Controllers\UserController::class, 'deleteUser']);
    Route::patch('/User', [\App\Http\Controllers\UserController::class, 'editUser']);
    Route::get('/User', [\App\Http\Controllers\MainReadController::class, 'getUsers']);
    Route::get('/Roles', [\App\Http\Controllers\MainReadController::class, 'getRoles']);

    Route::post('/Audience', [\App\Http\Controllers\AudienceController::class, 'createAudience']);
    Route::delete('/Audience', [\App\Http\Controllers\AudienceController::class, 'deleteAudience']);
    Route::patch('/Audience', [\App\Http\Controllers\AudienceController::class, 'editAudience']);

    Route::post('/Department', [\App\Http\Controllers\DepartmentController::class, 'createDepartment']);
    Route::delete('/Department', [\App\Http\Controllers\DepartmentController::class, 'deleteDepartment']);
    Route::patch('/Department', [\App\Http\Controllers\DepartmentController::class, 'editDepartment']);

    Route::post('/groupsPart', [\App\Http\Controllers\GroupsPartsController::class, 'createGroupsPart']);
    Route::delete('/groupsPart', [\App\Http\Controllers\GroupsPartsController::class, 'deleteGroupsPart']);
    Route::patch('/groupsPart', [\App\Http\Controllers\GroupsPartsController::class, 'editGroupsPart']);

    Route::post('/lessonsOrder', [\App\Http\Controllers\LessonsOrdersController::class, 'createLessonsOrder']);
    Route::delete('/lessonsOrder', [\App\Http\Controllers\LessonsOrdersController::class, 'deleteLessonsOrder']);
    Route::patch('/lessonsOrder', [\App\Http\Controllers\LessonsOrdersController::class, 'editLessonsOrder']);

    Route::post('/Subject', [\App\Http\Controllers\SubjectController::class, 'createSubject']);
    Route::delete('/Subject', [\App\Http\Controllers\SubjectController::class, 'deleteSubject']);
    Route::patch('/Subject', [\App\Http\Controllers\SubjectController::class, 'editSubject']);

    Route::post('/Week', [\App\Http\Controllers\WeekDaysController::class, 'createWeekDay']);
    Route::delete('/Week', [\App\Http\Controllers\WeekDaysController::class, 'deleteWeekDay']);
    Route::patch('/Week', [\App\Http\Controllers\WeekDaysController::class, 'editWeekDay']);

    Route::post('/Group', [\App\Http\Controllers\GroupController::class, 'createGroup']);
    Route::delete('/Group', [\App\Http\Controllers\GroupController::class, 'deleteGroup']);
    Route::patch('/Group', [\App\Http\Controllers\GroupController::class, 'editGroup']);

    Route::post('/Schedule', [\App\Http\Controllers\ScheduleController::class, 'createSchedule'])->middleware('timeConvert');
    Route::patch('/Schedule', [\App\Http\Controllers\ScheduleController::class, 'editSchedule'])->middleware('timeConvert');
    Route::delete('/Schedule', [\App\Http\Controllers\ScheduleController::class, 'deleteSchedule']);

    Route::post('/lessonBooking', [\App\Http\Controllers\LessonsBookingsController::class, 'createLessonBooking']);
    Route::delete('/lessonBooking', [\App\Http\Controllers\LessonsBookingsController::class, 'deleteLessonBooking']);
    Route::patch('/lessonBooking', [\App\Http\Controllers\LessonsBookingsController::class, 'editLessonBooking']);

    Route::post('/groupBooking', [\App\Http\Controllers\GroupsBookingsController::class, 'createGroupBooking']);
    Route::delete('/groupBooking', [\App\Http\Controllers\GroupsBookingsController::class, 'deleteGroupBooking']);
    Route::patch('/groupBooking', [\App\Http\Controllers\GroupsBookingsController::class, 'editGroupBooking']);

    Route::post('/hours', [\App\Http\Controllers\SubjectHourCountController::class, 'createHourCount']);
    Route::delete('/hours', [\App\Http\Controllers\SubjectHourCountController::class, 'deleteHourCount']);
    Route::patch('/hours', [\App\Http\Controllers\SubjectHourCountController::class, 'editHourCount']);
});
