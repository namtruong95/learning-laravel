<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ClassRoom;

class StatisticController extends Controller
{
    public function statisticUsingQueryBuilder()
    {
        $data = DB::table('class_rooms')
            ->select(
                'class_rooms.id',
                'class_rooms.name',
                DB::raw('count(subjects.id) AS total_subject'),
                DB::raw('sum(subjects.number_of_credits) AS total_credits'),
                DB::raw('(SELECT count(id) FROM students WHERE students.class_room_id = class_rooms.id) AS total_students')
            )
            ->leftJoin('students', 'students.class_room_id', '=', 'class_rooms.id')
            ->leftJoin('students_subject_classes', 'students_subject_classes.student_id', '=', 'students.id')
            ->leftJoin('subject_classes', 'students_subject_classes.subject_class_id', '=', 'subject_classes.id')
            ->leftJoin('subjects', 'subjects.id', '=', 'subject_classes.subject_id')
            ->groupBy('class_rooms.id')
            ->groupBy('class_rooms.name')
            ->orderBy('class_rooms.id')
            ->get();

        return response()->success([
            'data' => $data,
        ]);
    }

    public function statisticUsingEloQuent()
    {
        $data = ClassRoom::leftJoin('students', function ($join) {
            $join->on('students.class_room_id', '=', 'class_rooms.id');
        })
        ->leftJoin('students_subject_classes', function ($join) {
            $join->on('students_subject_classes.student_id', '=', 'students.id');
        })
        ->leftJoin('subject_classes', function ($join) {
            $join->on('students_subject_classes.subject_class_id', '=', 'subject_classes.id');
        })
        ->leftJoin('subjects', function ($join) {
            $join->on('subjects.id', '=', 'subject_classes.subject_id');
        })
        ->select('class_rooms.id', 'class_rooms.name')
        ->selectRaw('count(subjects.id) AS total_subject')
        ->selectRaw('sum(subjects.number_of_credits) AS total_credits')
        ->selectRaw('(SELECT count(id) FROM students WHERE students.class_room_id = class_rooms.id) AS total_students')
        ->groupBy('class_rooms.id')
        ->groupBy('class_rooms.name')
        ->orderBy('class_rooms.id')
        ->get();

        // dd(DB::getQueryLog());

        return response()->success([
            'data' => $data,
        ]);
    }
}
