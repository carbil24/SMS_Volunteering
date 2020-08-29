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
    public function index($id)
    {
        $junctions = DB::table('responsible_school_candidate')
        ->where('school_candidate_id', '=', $id)
        ->get(); 
        
        return $junctions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $schoolCandidate = SchoolCandidate::find($id);
        $schoolCandidate->responsibles()->attach($request->id);
        
        if($schoolCandidate->responsibleA == null){
            $schoolCandidate->responsibles()->where('id', $request->id)->update([
                'relationship' => $schoolCandidate->responsibleA,
            ]);
        }
        else{
            $schoolCandidate->responsibles()->where('id', $request->id)->update([
                'relationship' => $schoolCandidate->responsibleA,
            ]);
        }



        return $request;
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
