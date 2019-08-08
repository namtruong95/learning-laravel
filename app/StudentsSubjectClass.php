<?php

namespace App;

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
        return $this->belongsTo(\App\Student::class);
    }

    public function subjectClass()
    {
        return $this->belongsTo(\App\SubjectClass::class);
    }
}
