<?php

namespace App;

use App\Student;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
