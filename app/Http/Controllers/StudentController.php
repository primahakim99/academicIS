<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $student = Student::all(); // Mengambil semua isi tabel
        // $paginate = Student::orderBy('id_student', 'asc')->simplePaginate(3)->withQueryString();
        // return view('student.Index', [
        //     'student' => $student,
        //     'paginate' => $paginate
        // ]);
        return view('student.index', [
            'student' => Student::orderBy('id_student', 'asc')->simplePaginate(3)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = ClassModel::all();
        return view('student.create', ['class' => $class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Name' => 'required',
            'Class' => 'required',
            'Major' => 'required',
        ]);

        $student = new Student;
        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        $student->major = $request->get('Major');
        $student->save();

        $class = new ClassModel;
        $class->id = $request->get('Class');

        // eloquent function to add data
        // Student::create($request->all());
        $student->class()->associate($class);
        $student->save();

        // if the data is added successfully, will return to the main page
        return redirect()->route('student.index')
            ->with('success', 'Student Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        // displays detailed data by finding / by Student Nim
        // $Student = Student::where('nim', $nim)->first();
        $Student = Student::with('class')->where('nim', $nim)->first();
        return view('student.detail', compact('Student'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        // displays detail data by finding based on Student Nim for editing
        // $Student = Student::where('nim', $nim)->first();
        $Student = Student::with('class')->where('nim', $nim)->first();
        $class = ClassModel::all();
        return view('student.edit', compact('Student', 'class'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //validate the data
        $request->validate([
            'Nim' => 'required',
            'Name' => 'required',
            'Class' => 'required',
            'Major' => 'required',
        ]);

 //Eloquent function to update the data
        Student::with('class')->where('nim', $nim)->first();

        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        $student->major = $request->get('Major');
        $student->save();

        $class = new ClassModel;
        $class->id = $request->get('Class');
//
        $student->class()->associate($class);
        $student->save();
        // Student::where('nim', $nim)
        //     ->update([
        //         'nim'=>$request->Nim,
        //         'name'=>$request->Name,
        //         'class'=>$request->Class,
        //         'major'=>$request->Major,
        //         'adress'=>$request->Address,
        //         'dob'=>$request->Dob,
        //     ]);

//if the data successfully updated, will return to main page
        return redirect()->route('student.index')
            ->with('success', 'Student Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //Eloquent function to delete the data
        Student::where('nim', $nim)->delete();
        return redirect()->route('student.index')
            -> with('success', 'Student Successfully Deleted');

    }
}
