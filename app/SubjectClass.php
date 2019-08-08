<?php

namespace App;

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
        return $this->hasMany(\App\StudentsSubjectClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(\App\Subject::class);
    }
}
