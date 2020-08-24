<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Responsible;


class ResponsibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Responsible::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $responsible = new Responsible();
        $responsible->nationalId = $request->nationalId;
        $responsible->firstName = $request->firstName;
        $responsible->lastName = $request->lastName;
        $responsible->middleName = $request->middleName;
        $responsible->dateOfBirth = $request->dateOfBirth;
        $responsible->gender = $request->gender;
        $responsible->nationality = $request->nationality;
        $responsible->countryOfBirth = $request->countryOfBirth;
        $responsible->regionOfBirth = $request->regionOfBirth;
        $responsible->cityOfBirth = $request->cityOfBirth;
        $responsible->countryOfResidency = $request->countryOfResidency;
        $responsible->regionOfResidency = $request->regionOfResidency;
        $responsible->cityOfResidency = $request->cityOfResidency;
        $responsible->address = $request->address;
        $responsible->postalCode = $request->postalCode;
        $responsible->homePhone = $request->homePhone;
        $responsible->workPhone = $request->workPhone;
        $responsible->email = $request->email;
        $responsible->save();

        return $responsible;
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
    public function update(Request $request, Responsible $responsible)
    {
        $responsible = Responsible::find($responsible->id);
        $responsible->nationalId = $request->nationalId;
        $responsible->firstName = $request->firstName;
        $responsible->lastName = $request->lastName;
        $responsible->middleName = $request->middleName;
        $responsible->dateOfBirth = $request->dateOfBirth;
        $responsible->gender = $request->gender;
        $responsible->nationality = $request->nationality;
        $responsible->countryOfBirth = $request->countryOfBirth;
        $responsible->regionOfBirth = $request->regionOfBirth;
        $responsible->cityOfBirth = $request->cityOfBirth;
        $responsible->countryOfResidency = $request->countryOfResidency;
        $responsible->regionOfResidency = $request->regionOfResidency;
        $responsible->cityOfResidency = $request->cityOfResidency;
        $responsible->address = $request->address;
        $responsible->postalCode = $request->postalCode;
        $responsible->homePhone = $request->homePhone;
        $responsible->workPhone = $request->workPhone;
        $responsible->email = $request->email;
        $responsible->save();    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Responsible $responsible)
    {
        $responsible->delete();
    }
}
