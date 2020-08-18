<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Teacher;
use App\NotConfirmedUser;
use App\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Teacher::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->class = $request->class;
        $teacher->save();

        $notConfirmedUser = new NotConfirmedUser();
        $notConfirmedUser->id = $teacher->id;
        $notConfirmedUser->first_name = $teacher->first_name;
        $notConfirmedUser->last_name = $teacher->last_name;
        $notConfirmedUser->date_of_birth = $teacher->date_of_birth;
        $notConfirmedUser->user_type = "Teacher";
        $notConfirmedUser->save();

        return $teacher;
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
    public function update(Request $request, Teacher $teacher)
    {
        $teacher = Teacher::find($teacher->id);
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->class = $request->class;
        $teacher->save();

        $notConfirmedUser = NotConfirmedUser::find($teacher->id);
        $confirmedUser = User::find($teacher->id);

        if($notConfirmedUser){
            $notConfirmedUser->first_name = $teacher->first_name;
            $notConfirmedUser->last_name = $teacher->last_name;
            $notConfirmedUser->date_of_birth = $teacher->date_of_birth;
            $notConfirmedUser->save();
        }

        if($confirmedUser){
            $confirmedUser->first_name = $teacher->first_name;
            $confirmedUser->last_name = $teacher->last_name;
            $confirmedUser->date_of_birth = $teacher->date_of_birth;  
            $confirmedUser->save();      
        }

        return $teacher;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        $notConfirmedUser = NotConfirmedUser::find($teacher->id);
        $confirmedUser = User::find($teacher->id);

        if($notConfirmedUser){
            $notConfirmedUser->delete();
        }

        if($confirmedUser){
            $confirmedUser->delete();    
        }

    }
}
