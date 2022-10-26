<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AudienceFormRequest;
use App\Http\Requests\Admin\GetRequests\GetBookingAudienceRequest;
use App\Http\Requests\Admin\GetRequests\GetBookingGroupRequest;
use App\Http\Requests\Admin\GetRequests\GetBookingTeacherRequest;
use App\Http\Requests\Admin\GetRequests\GetLessonsRequest;
use App\Http\Requests\LessonsRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Audience;
use App\Models\Department;
use App\Models\groupCaptain;
use App\Models\groupsPart;
use App\Models\lessonsOrder;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\weekDay;
use Illuminate\Database\Query\JoinClause;
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

    public function getAllSubject(Request $request) {
        $subjects = Subject::get();
        return response()->json($subjects);
    }

    public function getUsers(Request $request) {
        $queries = $request->query();

        $roles = Role::all();
        $userModel = DB::table('users')->leftJoin('groups', 'users.group_id', '=', 'groups.id')
            ->select('users.id', 'users.name', 'users.login', 'users.role_id', 'users.group_id', 'groups.name as group_name')
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
        $queries = $request->validated();

        $db = DB::table('lessons_bookings');

        return $db->where('lesson_date', $queries['date'])
            ->where('lesson_order_id', $queries['lesson_order_id'])
            ->where('teacher_id', $queries['teacher_id'])->first() ?? 'Преподаватель свободен';
    }

    public function getAudienceBooking(GetBookingAudienceRequest $request) {
        $queries = $request->validated();

        $db = DB::table('lessons_bookings');

        return $db->where('lesson_date', $queries['date'])
                ->where('lesson_order_id', $queries['lesson_order_id'])
                ->where('audience_id', $queries['audience_id'])->first() ?? 'Кабинет свободен';
    }

    public function getBookings(GetLessonsRequest $request) {
        $queries = $request->validated();

        $now = date('Y-m-d');
        $days = DB::table('lessons_bookings')->select(DB::raw('DATE_FORMAT(lesson_date, "%d-%m-%Y") as date'))
            ->where('lesson_date', '>=', $now)
            ->groupBy('lesson_date')->get();
        $departments = DB::table('departments')->select('name as department_name', 'id as department_id')->get();
        $groups = DB::table('groups')->select('name as group_name')->groupBy('name')->get();

        $db = DB::table('lessons_bookings')
            ->join('lessons_orders', 'lessons_bookings.lesson_order_id', '=', 'lessons_orders.id')
            ->join('audiences', 'lessons_bookings.audience_id', '=', 'audiences.id')
            ->join('subjects', 'lessons_bookings.subject_id', '=', 'subjects.id')
            ->join('groups', 'lessons_bookings.group_id', '=', 'groups.id')
            ->join('groups_parts', 'lessons_bookings.group_part_id', '=', 'groups_parts.id')
            ->join('users', 'lessons_bookings.teacher_id', '=', 'users.id')
            ->join('departments', 'groups.department_id', '=', 'departments.id')
            ->join('week_days', function (JoinClause $join) {
                $join->on(DB::raw('DAYOFWEEK(lesson_date)'), '=', 'week_days.index');
            })
            ->join('schedules', function (JoinClause $join) {
                $join->on('lessons_bookings.lesson_order_id', '=', 'schedules.lesson_order_id');
                $join->on('departments.id', '=', 'schedules.department_id');
                $join->on('week_days.id', '=', 'schedules.week_day_id');
            })
            ->select('lessons_bookings.*',
                DB::raw('DATE_FORMAT(lesson_date, "%d-%m-%Y") as lesson_date'),
                'audiences.name as audience_name', 'subjects.name as subject_name',
                'users.name as teacher_name', 'groups.name as group_name', 'groups_parts.name as group_part_name',
                'departments.name as department_name', 'departments.id as department_id', 'lessons_orders.name as lesson_order_name')
            ->where('lessons_bookings.lesson_date', '>=', $now)
            ->orderBy('groups.department_id')->orderBy('lessons_bookings.lesson_date')
            ->orderBy('lessons_bookings.group_id')->orderBy('schedules.start_time');

        if(isset($queries['dep_filter'])) {
            $db = $db->where('groups.department_id', $queries['dep_filter']);
        }

        if(isset($queries['aud_filter'])) {
            $db = $db->where('lessons_bookings.audience_id', $queries['aud_filter']);
        }

        if(isset($queries['teacher_filter'])) {
            $db = $db->where('lessons_bookings.teacher_id', $queries['teacher_filter']);
        }

        if(isset($queries['les_filter'])) {
            $db = $db->where('lessons_bookings.lesson_order_id', $queries['les_filter']);
        }

        if(isset($queries['date_filter'])) {
            $db = $db->where('lessons_bookings.lesson_date', $queries['date_filter']);
        }


        $db = $db->get();

        $result = [
            'raw_bookings' => $db,
            'formatted_bookings' => []
        ];
        foreach ($departments as $keyDep => $department) {
            $depDays = [
                'department_name' => $department->department_name,
                'department_id' => $department->department_id,
                'days' => []
            ];
            foreach ($days as $keyDay => $day) {
                $dayGroups = [
                    'date' => $day->date,
                    'groups' => []
                ];
                foreach ($groups as $keyGroup => $group) {
                    $groupBookings = [
                        'group_name' => $group->group_name,
                        'bookings' => []
                    ];
                    foreach ($db as $booking) {
                        if ($day->date === $booking->lesson_date &&
                            $group->group_name === $booking->group_name &&
                            $department->department_name === $booking->department_name) {
                            $groupBookings['bookings'][] = $booking;
                        }
                    }
                    if (!empty($groupBookings['bookings'])) {
                        $dayGroups['groups'][] = $groupBookings;
                    }
                }
                if (!empty($dayGroups['groups'])) {
                    $depDays['days'][] = $dayGroups;
                }
            }
            if (!empty($depDays['days'])) {
                $result['formatted_bookings'][] = $depDays;
            }
        }

        return response()->json($result);
    }


    public function search(SearchRequest $request) {
        $request = $request->validated();
        $db = null;

        switch ($request['entity']) {
            case 'group':
                $db = DB::table('groups');
                break;
            case 'teacher':
                $db = DB::table('users')->where('role_id', '=', 2);
                break;
            case 'audience':
                $db = DB::table('audiences');
                break;
        }

        $result = $db->select('name', 'id')->where('name', 'like', '%'.$request['name'].'%')
            ->limit(10)->orderBy('name', 'desc')->get();

        return response()->json($result);
    }

    public function getLessons(LessonsRequest $request) {
        $request = $request->validated();

        $db = DB::table('lessons_bookings')
            ->join('lessons_orders', 'lessons_bookings.lesson_order_id', '=', 'lessons_orders.id')
            ->join('audiences', 'lessons_bookings.audience_id', '=', 'audiences.id')
            ->join('subjects', 'lessons_bookings.subject_id', '=', 'subjects.id')
            ->join('groups', 'lessons_bookings.group_id', '=', 'groups.id')
            ->join('groups_parts', 'lessons_bookings.group_part_id', '=', 'groups_parts.id')
            ->join('users', 'lessons_bookings.teacher_id', '=', 'users.id')
            ->join('departments', 'groups.department_id', '=', 'departments.id')
            ->join('week_days', function (JoinClause $join) {
                $join->on(DB::raw('DAYOFWEEK(lesson_date)'), '=', 'week_days.index');
            })
            ->join('schedules', function (JoinClause $join) {
                $join->on('lessons_bookings.lesson_order_id', '=', 'schedules.lesson_order_id');
                $join->on('departments.id', '=', 'schedules.department_id');
                $join->on('week_days.id', '=', 'schedules.week_day_id');
            })
            ->select('lessons_bookings.*',
                'audiences.name as audience_name', 'subjects.name as subject_name',
                'users.name as teacher_name', 'groups.name as group_name', 'groups_parts.name as group_part_name',
                DB::raw("TIME_FORMAT(start_time, '%H:%i') as start_time"),
                DB::raw("TIME_FORMAT(end_time, '%H:%i') as end_time"), 'schedules.break',
                'lessons_orders.name as lesson_order_name')
            ->where('lessons_bookings.lesson_date', $request['date'])->orderBy('schedules.start_time');

        if (isset($request['group_id'])) {
            $db = $db->where('lessons_bookings.group_id', $request['group_id']);
        }

        if (isset($request['teacher_id'])) {
            $db = $db->where('lessons_bookings.teacher_id', $request['teacher_id']);
        }

        if (isset($request['audience_id'])) {
            $db = $db->where('lessons_bookings.audience_id', $request['audience_id']);
        }

        $result = $db->get();

        return response()->json($result);
    }
}
