<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Department;
use App\Models\Group;
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

    public function getAllAudiences(Request $request) {
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

        $prepodsModel = Teacher::orderBy('surname');

        if (isset($queries['name'])) {
            $prepodsModel = $prepodsModel->where('name', 'like', "%".$queries['name']."%");
        }

        if (isset($queries['surname'])) {
            $prepodsModel = $prepodsModel->where('surname', 'like', "%".$queries['surname']."%");
        }

        if (isset($queries['middle_name'])) {
            $prepodsModel = $prepodsModel->where('middle_name', 'like', "%".$queries['middle_name']."%");
        }

        if (isset($queries['user_id'])) {
            $prepodsModel = $prepodsModel->where('user_id', $queries['user_id']);
        }

        $prepods = $prepodsModel->get();

        return response()->json($prepods);
    }

    public function getUsers(Request $request) {
        $queries = $request->query();

        $roles = Role::all();
        $userModel = User::orderBy('login');

        if (isset($queries['name'])) {
            $userModel = $userModel->where('name', 'like', "%".$queries['name']."%");
        }

        if (isset($queries['role'])) {
            $userModel = $userModel->where('role_id', $queries['role']);
        }

        if (isset($queries['login'])) {
            $userModel = $userModel->where('login', $queries['login']);
        }

        $users = $userModel->get();

        foreach ($users as $user) {
            switch ($user->role_id) {
                case 2:
                    $teacher = Teacher::where('user_id', $user->id)->first();
                    if (!is_null($teacher)) {
                        $user->name = $teacher->surname." ".$teacher->name." ".$teacher->middle_name;
                    }
                    break;
            }
            foreach ($roles as $role) {
                if ($role->id === $user->role_id) {
                    $user->role = $role;
                    unset($user->role_id);
                }
            }
        }

        return response()->json($users);
    }

    public function getRoles(Request $request) {
        $roles = Role::all();
        $rolesData = [];
        foreach ($roles as $role) {
            $rolesData[] = [$role->id => $role->name];
        }
        return response()->json($rolesData);
    }
}
