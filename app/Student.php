<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'date_of_birth', 'class_room_id',
    ];

    public function classRoom()
    {
        return $this->belongsTo(\App\ClassRoom::class);
    }

    public function studentSubjectClasses()
    {
        return $this->hasMany(\App\StudentsSubjectClass::class);
    }
}
