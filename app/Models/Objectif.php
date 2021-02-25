<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objectif extends Model
{
    protected $table = 'objectifs';
    use SoftDeletes;
    protected $guarded = [];

    ############################## Start Relation
      public function secteur(){
          return $this->belongsTo(Secteur::class,'secteur_id','id');
      }
    ############################### End Relation
}
