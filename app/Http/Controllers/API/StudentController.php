<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Student;
use App\NotConfirmedUser;
use App\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return Student::all();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->date_of_birth = $request->date_of_birth;
        $student->class = $request->class;
        $student->save();

        $notConfirmedUser = new NotConfirmedUser();
        $notConfirmedUser->id = $student->id;
        $notConfirmedUser->first_name = $student->first_name;
        $notConfirmedUser->last_name = $student->last_name;
        $notConfirmedUser->date_of_birth = $student->date_of_birth;
        $notConfirmedUser->user_type = "Student";
        $notConfirmedUser->save();

        return $student;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student = Student::find($student->id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->date_of_birth = $request->date_of_birth;
        $student->class = $request->class;
        $student->save();

        $notConfirmedUser = NotConfirmedUser::find($student->id);
        $confirmedUser = User::find($student->id);


        if($notConfirmedUser){
            $notConfirmedUser->first_name = $student->first_name;
            $notConfirmedUser->last_name = $student->last_name;
            $notConfirmedUser->date_of_birth = $student->date_of_birth;
            $notConfirmedUser->save();
        }

        if($confirmedUser){
            $confirmedUser->first_name = $student->first_name;
            $confirmedUser->last_name = $student->last_name;
            $confirmedUser->date_of_birth = $student->date_of_birth;    
            $confirmedUser->save();    
        }

        return $student;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        $notConfirmedUser = NotConfirmedUser::find($student->id);
        $confirmedUser = User::find($student->id);

        if($notConfirmedUser){
            $notConfirmedUser->delete();
        }

        if($confirmedUser){
            $confirmedUser->delete();    
        }
    }
}
