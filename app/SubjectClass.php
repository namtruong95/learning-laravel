<?php

namespace App;

use App\Subject;
use App\StudentsSubjectClass;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'subject_id',
    ];

    public function studentSubjectClasses()
    {
        return $this->hasMany(StudentsSubjectClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
