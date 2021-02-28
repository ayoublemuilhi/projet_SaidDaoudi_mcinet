<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribution extends Model
{
    use SoftDeletes;
    protected $table = 'attributions';
    protected $guarded = [];

    ############################## Start Relation
    public function secteur(){
        return $this->belongsTo(Secteur::class,'secteur_id','id');
    }
    ############################### End Relation
}
