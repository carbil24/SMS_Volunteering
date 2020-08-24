<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    protected $guarded = [];

    public function schoolCandidates(){
        return $this->belongsToMany('App\SchoolCandidate');
    }
}
