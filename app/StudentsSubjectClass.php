<?php

namespace App;

use App\Student;
use App\SubjectClass;
use Illuminate\Database\Eloquent\Model;

class StudentsSubjectClass extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'subject_class_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subjectClass()
    {
        return $this->belongsTo(SubjectClass::class);
    }
}
