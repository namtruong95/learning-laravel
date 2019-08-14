<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ClassRoom;
use App\StudentsSubjectClass;
use App\Student;

class StatisticController extends Controller
{
    public function statisticUsingSubquery()
    {
        $totalSubject = StudentsSubjectClass::whereHas('student', function ($query) {
                return $query->whereColumn('students.class_room_id', 'class_rooms.id');
            })->selectRaw('count(students_subject_classes.id)');

        $totalCredits = StudentsSubjectClass::selectRaw('sum(subjects.number_of_credits)')
            ->whereHas('student', function ($query) {
                return $query->whereColumn('students.class_room_id', '=', 'class_rooms.id');
            })
            ->leftJoin('subject_classes', 'subject_classes.id', '=', 'students_subject_classes.subject_class_id')
            ->leftJoin('subjects', 'subjects.id', '=', 'subject_classes.subject_id');

        $totalStudents = Student::selectRaw('count(students.id)')
            ->whereColumn('students.class_room_id', 'class_rooms.id');

        $data = ClassRoom::select('class_rooms.id', 'class_rooms.name')
            ->selectSub($totalSubject, 'total_subject')
            ->selectSub($totalCredits, 'total_credits')
            ->selectSub($totalStudents, 'total_students')
            ->groupBy('class_rooms.id')
            ->groupBy('class_rooms.name')
            ->orderBy('class_rooms.id')
            ->get();

        return response()->success([
            'data' => $data,
        ]);
    }

    public function statisticUsingJoin()
    {
        $data = ClassRoom::leftJoin('students', 'students.class_room_id', '=', 'class_rooms.id')
            ->leftJoin('students_subject_classes', 'students_subject_classes.student_id', '=', 'students.id')
            ->leftJoin('subject_classes', 'students_subject_classes.subject_class_id', '=', 'subject_classes.id')
            ->leftJoin('subjects', 'subjects.id', '=', 'subject_classes.subject_id')
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
