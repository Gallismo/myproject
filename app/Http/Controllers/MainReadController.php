<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Department;
use App\Models\Group;
use App\Models\lessonsOrder;
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
}
