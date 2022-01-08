<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Department;
use App\Models\Group;
use App\Models\weekDay;
use Illuminate\Http\Request;

class MainReadController extends Controller
{
    public function getAllGroups (Request $request) {
        $groups = Group::orderBy('name')->get();
        $departments = Department::all();
        foreach ($groups as $group) {

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
        return response()->json($groups);
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
}
