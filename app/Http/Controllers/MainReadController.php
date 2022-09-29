<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AudienceFormRequest;
use App\Http\Requests\Admin\GetRequests\GetBookingAudienceRequest;
use App\Http\Requests\Admin\GetRequests\GetBookingGroupRequest;
use App\Http\Requests\Admin\GetRequests\GetBookingTeacherRequest;
use App\Models\Audience;
use App\Models\Department;
use App\Models\groupCaptain;
use App\Models\groupsPart;
use App\Models\lessonsOrder;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\weekDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainReadController extends Controller
{
    public function getAllGroups (Request $request) {
        $queries = $request->query();

        $groups = DB::table('groups')
            ->join('departments', 'groups.department_id', '=', 'departments.id')
            ->select('groups.*', 'departments.name as department_name');

        if (isset($queries['department'])) {
            $groups = $groups->where('department_id', $queries['department']);
        }

        if (isset($queries['start'])) {
            $groups = $groups->where('start_year', 'like', "%".$queries['start']."%");
        }

        if (isset($queries['end'])) {
            $groups = $groups->where('end_year', 'like', "%".$queries['end']."%");
        }

        $groupsData = $groups->get();

        return response()->json($groupsData);
    }

    public function getAllDepartments(Request $request) {
        $departments = Department::orderBy('name')->get();
        return response()->json($departments);
    }

    public function getAllAudiences(AudienceFormRequest $request) {
        $audiences = Audience::orderBy('name')->get();
        return response()->json($audiences);
    }

    public function getAllWeeks(Request $request) {
        $weeks = weekDay::get();
        return response()->json($weeks);
    }

    public function getAllLessonOrders(Request $request) {
        $lessonsOrder = lessonsOrder::get();
        return response()->json($lessonsOrder);
    }

    public function getAllGroupParts(Request $request) {
        $groupsPart = groupsPart::get();
        return response()->json($groupsPart);
    }

    public function getUsers(Request $request) {
        $queries = $request->query();

        $roles = Role::all();
        $userModel = DB::table('users')->leftJoin('groups', 'users.group_id', '=', 'groups.id')
            ->select('users.name', 'users.role_id', 'users.login', 'groups.name as group_name', 'users.group_id')
            ->orderBy('users.login');

        if (isset($queries['login'])) {
            $userModel = $userModel->where('users.login', 'like', "%".$queries['login']."%");
        }

        if (isset($queries['role'])) {
            $userModel = $userModel->where('users.role_id', $queries['role']);
        }

        if (isset($queries['name'])) {
            $userModel = $userModel->where('users.name', 'like', "%".$queries['name']."%");
        }

        if (isset($queries['group'])) {
            $userModel = $userModel->where('groups.name', 'like', "%".$queries['group']."%");
        }

        $users = $userModel->get();

        foreach ($users as $user) {
            foreach ($roles as $role) {
                if ($role->id === $user->role_id) {
                    $user->role = $role;
                }
            }
            unset($user->role_id);
        }

        return response()->json($users);
    }

    public function getRoles(Request $request) {
        $roles = Role::all();
        $rolesData = [];
        foreach ($roles as $role) {
            $rolesData[$role->id] = $role->name;
        }
        return response()->json($rolesData);
    }

    public function getSchedules(Request $request) {
        $queries = $request->query();

        $scheduleModel = DB::table('schedules')
            ->join('week_days', 'schedules.week_day_id', '=', 'week_days.id')
            ->join('lessons_orders', 'schedules.lesson_order_id', '=', 'lessons_orders.id')
            ->join('departments', 'schedules.department_id', '=', 'departments.id')
            ->select('schedules.id', 'schedules.week_day_id', 'week_days.name as week_day_name',
                'schedules.lesson_order_id', 'lessons_orders.name as lesson_order_name',
                'schedules.department_id', 'departments.name as department_name',
                DB::raw('DATE_FORMAT(schedules.start_time,"%H:%i") as start_time'),
                DB::raw('DATE_FORMAT(schedules.end_time,"%H:%i") as end_time'),
                'schedules.break')
            ->orderBy('schedules.department_id')
            ->orderBy('schedules.week_day_id')
            ->orderBy('schedules.start_time');


        if(isset($queries['department'])) {
            $scheduleModel = $scheduleModel->where('schedules.department_id', $queries['department']);
        }

        if(isset($queries['week_day'])) {
            $scheduleModel = $scheduleModel->where('schedules.week_day_id', $queries['week_day']);
        }

        if(isset($queries['lesson'])) {
            $scheduleModel = $scheduleModel->where('schedules.lesson_order_id', $queries['lesson']);
        }

        $schedules = $scheduleModel->get();

        return response()->json($schedules);
    }

    public function getGroupBooking(GetBookingGroupRequest $request) {
        $queries = $request->validated();

        $db = DB::table('lessons_bookings')
            ->join('groups_bookings', 'lessons_bookings.id', '=', 'groups_bookings.booking_id')
            ->select('lessons_bookings.*', 'groups_bookings.group_id', 'groups_bookings.group_part_id');

        return $db->where('lessons_bookings.lesson_date', $queries['date'])
            ->where('lessons_bookings.lesson_order_id', $queries['lesson_order_id'])
            ->where('groups_bookings.group_id', $queries['group_id'])->first() ?? 'Группа свободна';
    }

    public function getTeacherBooking(GetBookingTeacherRequest $request) {
        $queries = $request->query();

        $db = DB::table('lessons_bookings');

        return $db->where('lesson_date', $queries['date'])
            ->where('lesson_order_id', $queries['lesson_order_id'])
            ->where('teacher_id', $queries['teacher_id'])->first() ?? 'Преподаватель свободен';
    }

    public function getAudienceBooking(GetBookingAudienceRequest $request) {
        $queries = $request->query();

        $db = DB::table('lessons_bookings');

        return $db->where('lesson_date', $queries['date'])
                ->where('lesson_order_id', $queries['lesson_order_id'])
                ->where('audience_id', $queries['audience_id'])->first() ?? 'Кабинет свободен';
    }
}
