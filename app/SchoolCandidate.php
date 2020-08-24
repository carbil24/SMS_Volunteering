<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolCandidate extends Model
{
    protected $guarded = [];

    public function responsibles(){
        return $this->belongsToMany('App\Responsible');
    }

}
