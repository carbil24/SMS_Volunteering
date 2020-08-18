<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Employee;
use App\NotConfirmedUser;
use App\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->position = $request->position;
        $employee->save();

        $notConfirmedUser = new NotConfirmedUser();
        $notConfirmedUser->id = $employee->id;
        $notConfirmedUser->first_name = $employee->first_name;
        $notConfirmedUser->last_name = $employee->last_name;
        $notConfirmedUser->date_of_birth = $employee->date_of_birth;
        $notConfirmedUser->user_type = $request->position;
        $notConfirmedUser->save();

        return $employee;
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
    public function update(Request $request, Employee $employee)
    {
        $employee = Employee::find($employee->id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->position = $request->position;
        $employee->save();
    
        $notConfirmedUser = NotConfirmedUser::find($employee->id);
        $confirmedUser = User::find($employee->id);
        
        if($notConfirmedUser){
            $notConfirmedUser->first_name = $employee->first_name;
            $notConfirmedUser->last_name = $employee->last_name;
            $notConfirmedUser->date_of_birth = $employee->date_of_birth;
            $notConfirmedUser->user_type = $employee->position;
            $notConfirmedUser->save();
        }

        if($confirmedUser){
            $confirmedUser->first_name = $employee->first_name;
            $confirmedUser->last_name = $employee->last_name;
            $confirmedUser->date_of_birth = $employee->date_of_birth;
            $confirmedUser->user_type = $employee->position;  
            $confirmedUser->save();      
        }

        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        $notConfirmedUser = NotConfirmedUser::find($employee->id);
        $confirmedUser = User::find($employee->id);

        if($notConfirmedUser){
            $notConfirmedUser->delete();
        }

        if($confirmedUser){
            $confirmedUser->delete();    
        }
    }
}
