<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $table= 'course';

    public function student(){
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id')
        ->withPivot('value');
    }
}
