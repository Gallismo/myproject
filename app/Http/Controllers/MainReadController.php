<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
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
                    unset($group->department_id);
                }
            }
        }
        return response()->json($groups);
    }

    public function getAllDepartments(Request $request) {
        $departments = Department::orderBy('name')->get();
        return response()->json($departments);
    }
}
