<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseStudent extends Model
{
    use HasFactory;
    protected $table= 'course_student';

    public function student(){
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id');
    }

    public function course(){
        return $this->belongsToMany(Course::class, 'course_student', 'course_id', 'student_id');
    }
}
