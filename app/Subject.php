<?php

namespace App;

use App\SubjectClass;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'number_of_credits',
    ];

    public function subjectClasses()
    {
        return $this->hasMany(SubjectClass::class);
    }
}
