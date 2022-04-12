<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coursestudent =[
            [
                'student_id' => 1,
                'course_id' => 1,
                'value' => 'A'
            ],
            [
                'student_id' => 1,
                'course_id' => 2,
                'value' => 'A'
            ],
            [
                'student_id' => 1,
                'course_id' => 3,
                'value' => 'A'
            ],
            [
                'student_id' => 1,
                'course_id' => 4,
                'value' => 'A'
            ],
        ];
        DB::table('course_student')->insert($coursestudent);
    }
}
