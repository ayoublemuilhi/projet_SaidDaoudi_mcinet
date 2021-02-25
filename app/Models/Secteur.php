<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Secteur extends Model
{
    protected $table ='secteurs';
    use SoftDeletes;
    protected $guarded = [];

    ############################## Start Relation
    public function secteur(){
        return $this->hasMany(Objectif::class,'secteur_id','id');
    }
    ############################### End Relation
}
