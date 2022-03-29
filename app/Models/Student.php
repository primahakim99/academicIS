<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Student extends Model
{
    protected $table='student'; // Eloquent will create a student model to store records in the student table
    protected  $primaryKey = 'id_student'; // Calling DB contents with primary key
    /**
*	The attributes that are mass assignable.
     *
*	@var array
     */
    protected $guarded =['id_student'];

    // protected $fillable = [
    //     'Nim',
    //     'Name',
    //     'Class',
    //     'Major',
    //     'Address',
    //     'Dob',
    // ];

    public function search($query, array $searching)
    {
        $query->when($searching['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        });
    }
}
