<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SchoolCandidate;
use App\Responsible;

use Illuminate\Support\Facades\DB;


class ResponsibleSchoolCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SchoolCandidate $schoolCandidate)
    {
        $junctions = DB::table('responsible_school_candidate')
        ->where('school_candidate_id', '=', $schoolCandidate->id)
        ->get(); 
        
        return $junctions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SchoolCandidate $schoolCandidate, Responsible $responsible)
    {
        $schoolCandidate = SchoolCandidate::find($schoolCandidate->id);
        $schoolCandidate->responsibles()->attach($responsible->id);
        
        $schoolCandidate->responsibles()->update([
            'relationship' => $request->relationship,
        ]);

        return $schoolCandidate;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
