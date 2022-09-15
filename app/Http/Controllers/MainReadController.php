<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudienceFormRequest;
use App\Models\Audience;
use App\Models\Department;
use App\Models\Group;
use App\Models\groupCaptain;
use App\Models\groupsPart;
use App\Models\lessonsOrder;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use App\Models\weekDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainReadController extends Controller
{
    public function getAllGroups (Request $request) {
        $queries = $request->query();

        $groups = Group::orderBy('name');

        if (isset($queries['department'])) {
            $department = Department::where('code', $queries['department'])->first();
            $groups = $groups->where('department_id', $department->id);
        }

        if (isset($queries['start'])) {
            $groups = $groups->where('start_year', 'like', "%".$queries['start']."%");
        }

        if (isset($queries['end'])) {
            $groups = $groups->where('end_year', 'like', "%".$queries['end']."%");
        }

        $groupsData = $groups->get();
        $departments = Department::all();

        foreach ($groupsData as $group) {

            foreach ($departments as $department) {
                if ($department->id === $group->department_id) {
                    $group->department_name = $department->name;
                }
            }

            if ($group->department_id == null) {
                $group->department_name = 'Не указано';
            }

            unset($group->department_id);
        }

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

    public function getAllPrepods(Request $request) {
        $queries = $request->query();

        $prepodsModel = DB::table('teachers')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->select('teachers.name', 'users.login as login', 'teachers.code')->orderBy('name');

        if (isset($queries['name'])) {
            $prepodsModel = $prepodsModel->where('name', 'like', "%".$queries['name']."%");
        }

        if (isset($queries['user'])) {
            $users = DB::table('users')
                ->where('login', 'like', "%".$queries['user']."%")->pluck('id');
            $prepodsModel = $prepodsModel->whereIn('user_id', $users);
        }

        $prepods = $prepodsModel->get();

        return response()->json($prepods);
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

//    public function getCaptains(Request $request) {
//        $captainModel = DB::table('group_captains')
//            ->join('users', 'group_captains.user_id', '=', 'users.id')
//            ->join('groups', 'group_captains.group_id', '=', 'groups.id')
//            ->select('group_captains.name', 'group_captains.user_id',
//                'users.login as user_name', 'groups.code as group_code', 'groups.name as group_name', 'group_captains.code')
//            ->orderBy('group_id');
//
//        $queries = $request->query();
//
//        if (isset($queries['group_name'])) {
//            $captainModel = $captainModel->where('groups.name', 'like', "%".$queries['group_name']."%");
//        }
//
//        if (isset($queries['name'])) {
//            $captainModel = $captainModel->where('group_captains.name', 'like', "%".$queries['name']."%");
//        }
//
//        if (isset($queries['user'])) {
//            $captainModel = $captainModel->where('users.login', 'like', "%".$queries['user']."%");
//        }
//
//        $captains = $captainModel->get();
//
//        return response()->json($captains);
//    }

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
            $department = Department::where('code', $queries['department'])->first();
            $scheduleModel = $scheduleModel->where('schedules.department_id', $department->id);
        }

        if(isset($queries['week_day'])) {
            $week_day = weekDay::where('code', $queries['week_day'])->first();
            $scheduleModel = $scheduleModel->where('schedules.week_day_id', $week_day->id);
        }

        if(isset($queries['lesson'])) {
            $lesson_order = lessonsOrder::where('code', $queries['lesson'])->first();
            $scheduleModel = $scheduleModel->where('schedules.lesson_order_id', $lesson_order->id);
        }

        $schedules = $scheduleModel->get();

        return response()->json($schedules);
    }
}
